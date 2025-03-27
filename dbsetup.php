<?php

/*create string varaibles to use in the db connection */
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "blog";

//*create a connection to the database server*//
$connection = new mysqli($server_name, $username, $password);

//check the connection is good 
if ($connection->connect_error)
{
    die("Connection Failed: " . $connection->connect_error);
}
/*create the database if it does not already exist*/

//prepare the sql
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";

if ($connection->query($sql) === TRUE) 
{
    echo("Database created or it already exits");
}
else 
{
    echo("Error creating database: " . $connection->error . "<br>");
}

//select a database for use 
$connection->select_db($db_name);

/* create the table if it does not already exist*/

//prepare the sql
$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)"; 
//EXECUTE THE SQL TO CREATE THE TABLE 
if($connection->query($sql) === TRUE) 
{
    echo("table created or already exists");
}
else
{
echo("error creating the table " .$connection->error . "<br>");
}


?>