<?php

$connection = new mysqli('localhost', 'root', '', 'techbillionaires');
if($connection->connect_error){
    die('No DB Connection');
}

// var_dump($connection);


if(isset($_POST['insert_data'])){

    
    $name = $_POST['name']; 
    $business = $_POST['business'];
    $date = $_POST['date'];

    $image_file = $_FILES['image'];
    $tmp_name = $image_file['tmp_name'];
    $image_name = $image_file['name'];

    move_uploaded_file($tmp_name, 'Storage/'. $image_name);

    $query = " INSERT INTO billionaires (name, business, date, image) VALUES ('$name', '$business' ";

    if($date){
       $query .= " '$date' "; 
    } else {
        $query .= " NULL ";
    }

    $query .= ", '$image_name')";

    // echo $query;
    $connection->query($query);

    // var_dump($connection);

    header('location: index.php');
}

else if(isset($_POST['update_billionaires'])) {

    $id = $_POST['id'];

    $name = $_POST['name'];
    $business = $_POST['business']; 
    $date = $_POST['date'];

    $image_query = "SELECT image FROM billionaires WHERE id=$id";
    $result = $connection->query($image_query);
    $billionaire_data = $result->fetch_assoc();

    $image_name = $billionaire_data['image'];

    If(isset($_FILES['image'])){

        unlink('Storage/'. $image_name);

        $image_file = $_FILES['image'];
        $tmp_name = $image_file['tmp_name'];

        $image_name = $image_file['name'];
        
        move_uploaded_file($tmp_name, 'Storage/'. $image_name);
    }

    $query = " UPDATE billionaires SET name='$name', 'business=$business', date='$date', image='$image_name', WHERE id=$id ";

    //echo $query; 
    $connection->query($query);

    header('location: index.php');
}

else if(isset($_GET['delete_id'])){

    $id = $_GET['delete_id'];

    $image_query = "SELECT image FROM billionaires WHERE id=$id";
    $result = $connection->query($image_query);
    $billionaire_data = $result->fetch_assoc();

    unlink('Storage/'. $billionaire_data['image']);

    $query = " DELETE FROM billionaires WHERE id=$id ";

    $connection->query($query);

    // something

    if($connection->error){
        echo $connection->error;
    }else{
        header('Location: index.php');
    }

}
 