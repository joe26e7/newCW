<?php


$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "blog";


$connection = new mysqli($server_name, $username, $password);

if ($connection->connect_error)
{
    die("Connection Failed: " . $connection->connect_error);
}



$sql = "CREATE DATABASE IF NOT EXISTS $db_name";

if ($connection->query($sql) === TRUE) 
{
    echo("Database created or it already exits");
}
else 
{
    echo("Error creating database: " . $connection->error . "<br>");
}


$connection->select_db($db_name);





$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(100) NOT NULL UNIQUE, 
    email VARCHAR(100) NOT NULL,
    userpassword VARCHAR(100) NOT NULL
)";

if ($connection->query($sql) === TRUE) 
{
    echo("Table created or it already exits");
}
else 
{
    echo("Error creating table: " . $connection->error . "<br>");
}





$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE

)"; 
 
if($connection->query($sql) === TRUE) 
{
    echo("table created or already exists");
}
else
{
echo("error creating the table " .$connection->error . "<br>");
}





?>