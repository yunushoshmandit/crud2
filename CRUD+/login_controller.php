<?php
session_start;
$connection = new mysqli('localhost', 'root', '', 'techbillionaires');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation_flag = false;

    if(strlen($email) <10){
        $validation_flag = true;
        echo "<p>Email should be 10 characters long</p>";
    }

    if(strlen($password) < 6){
        $validation_flag = true;
        echo "<p>Password should be 6 characters long</p>";
    }

    if(!$validation_flag){
        // I do login
        $password = md5($password);
        $query = " SELECT * FROM users WHERE email='$email' AND password='$password' ";
        echo $query;
        exit;
        $result = $connection->query($query);

        $user = $result->fetch_assoc();

        if($user){
            // Login the user
            $_SESSION['auth'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
            ];
            $_SESSION['authenticted'] = true;


            header('Location: index.php');

        }else {
            echo "<p>Incorrect user credentials! </p>";
            echo "<p>
                <a href='login.php'>Login</a>
            </p>";
        }

    }
}


if(isset($_GET['logout'])){
    session_destroy();
    header('location: login.php');
}