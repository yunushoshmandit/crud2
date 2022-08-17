
<!-- We have a table of products

// List all of the products from DB
// Edit / Update products
// Deleting products
// Upload files 

// Fields = ID, Billionaire_Name, TECH_Business, Development_Date, Billionaire_Image -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to create MySQL table?</title>
</head>
<body>
    <?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'TechBillionaires';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s<br />", $mysqli->connect_error);
        exit();
    }
    printf('Connected successfully.<br />');

    $sql = "Create Table TechBillionaires_tbl( ". 
            "ID INT NOT NULL AUTO_INCREMENT, ".
            "Billionaire_Name VARCHAR(64) NOT NULL, ".
            "TECH_Business VARCHAR(64) NOT NULL, ".
            "Development_Date DATE, ".
            "Billionaire_Image VARCHAR(256) NULL, ".
            "PRIMARY KEY (ID)); ";
            if ($mysqli->query($sql)) {
                printf("Table TechBillionaires_tbl created successfully.<br />");
            }
            if ($mysqli->errno) {
                printf("Could not create table: %s<br /> ", $mysqli->error);
            }
            $mysqli->close();
            ?>
</body>
</html>


