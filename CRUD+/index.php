<?php
Session_start();
if(!isset($_SESSION['authenticated'])){
    header('location: login.php');
}

$auth = $_SESSION['auth'];

$connection = new mysqli('localhost', 'root', '', 'techbillionaires');

$query = " SELECT * FROM billionaires ";
$result = $connection->query($query);
$b_datas = $result->fetch_all(MYSQLI_ASSOC);



// var_dump($data);
// exit;

// We have a table of TECH Billionaires.
// List all of the billionaires from DB. 
// Update / edit billionaires 
// Deleting billionaires data
// Upload file of billionaires

// Fields: ID, Name, Business, Date, Image
?>

<style>
    
    td img {
        width: 100px;
    }

</style>

<p>
    Welcome, <strong> <?php echo $auth['name'] ?> </strong>
</p>
<p>
    <a href="login_controller.php?logout=true">Logout</a>
</p>

<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Business</th>
            <th>Date</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php 
            $i = 1;
            foreach($b_datas as $data) {
                echo    "<tr>
                            <td>". $i++ ."</td>
                            <td>". $data['name'] ."</td>
                            <td>". $data['business'] ."</td>
                            <td>". ( $data['date'] ? $data['date'] : '<i>No date</i>' ) ."</td>
                            <td>
                                <img src='Storage/{$data['image']}' />
                            </td>
                            <td>
                                <a href='index.php?edit_id={$data['id']}'>Edit</a>

                                <a href='Billionaires_data.php?delete_id={$data['id']}'>Delete</a>
                            </td>
                        </tr>";
            } 
        ?>
    </tbody>
</table>

<br>
<br>
<br>

<?php
    $edit_billionaires = null;

    if(isset($_GET['edit_id'])){
        $id = $_GET['edit_id'];

        $billionaires_query = " SELECT * FROM billionaires WHERE id=${id} ";

        $billionaires_result = $connection->query($billionaires_query);

        $edit_billionaires = $billionaires_result->fetch_assoc();
        
    }

?>

<form action="Billionaires_data.php" method="post" enctype="multipart/form-data">
    
    <input type="hidden" name="id" value="<?php echo ($edit_billionaires) ? $edit_billionaires['id'] : '' ?>">

    <table>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" value="<?php echo ($edit_billionaires) ? $edit_billionaires['name'] : '' ?>">
            </td>
        </tr>
        <tr>
            <td>Business</td>
            <td>
                <input type="text" name="business" value="<?php echo ($edit_billionaires) ? $edit_billionaires['business'] : '' ?>">
            </td>
        </tr>
        <tr>
            <td>Date</td>
            <td>
                <input type="date" name="date" value="<?php echo ($edit_billionaires) ? $edit_billionaires['date'] : '' ?>">
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td>
                <input type="file" name="image">
                <?php if($edit_billionaires) { ?>
                    <br>
                    <img src="Storage/<?php echo $edit_billionaires['image'] ?>" alt="">

                <?php } ?>
            </td>
        </tr>

        <tr>
            <td>
            <button type="submit" name="<?php echo ($edit_billionaires) ? 'update_billionaires' : 'insert_billionaires' ?>">Save</button>

            <a href="index.php">Cancel</a>
            </td>
        </tr>
        
    </table>
</form>
