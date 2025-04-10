<?php

session_start();

include ("dbsetup.php");

function hash_password($plaintext)
{
    return password_hash($plaintext, PASSWORD_DEFAULT);
}

function create_user($username, $email, $password, $connection)
{
    if ($connection->connect_error)
    {
        die("Connection failed: " . $connection->connect_error); 
    }


    $sql = "SELECT * FROM users WHERE username = ?";
    $check = $connection->prepare($sql);
    $check->bind_param("s", $username);
    $check->execute();
   

    $result = $check->get_result();

    if ($result->num_rows == 0) 
    {
        $hashed_password = hash_password($password);

        $sql = "INSERT INTO users (username, email, userpassword) VALUES (?, ?, ?)";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        echo("That username is already taken.");
    }

}

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

   
    if (create_user($username, $email, $password, $connection))
    {
        header("Location: index.php");
        exit();
    }
    else
    {
        echo("error create user");
    }
}

?>

<!DOCTYPE html> 
<html>



    <head>
        <title>Register new account</title> 
        <link rel="stylesheet" type="text/css" href="styles.css">
    <head>


    <body>

        <main>
            <h1>REGISTER NEW USER ACCOUNT !</H1>

            <form method="post" action="register.php">
                <label for="username">Username</label>
                <input type="text" name="username"><br>

                <label for="password">Password</label>
                <input type="text" name="password"></br>

                <label for="email">Email</label>
                <input type="text" name="email"><br>

                <input type="submit" value="Register">

            </form>

        </main>


    </body>
 </html>
