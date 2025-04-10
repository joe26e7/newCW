<?php
session_start();

include("dbsetup.php");
 
function authenticate_user($username, $password, $connection)
{
   
    $sql = "SELECT * FROM users WHERE username = ?";
 
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1)
    {
        $user = $result->fetch_assoc(); 

        $hashed_password = $user["userpassword"];

        if (password_verify($password, $hashed_password))
        {
            return $user; 
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = authenticate_user($username, $password, $connection);

    if ($user) 
    {
        
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["username"];

        header("Location: index.php");
        exit();
    }
    else 
    {
        echo("Login process failed.");
    }
}
?>


<!DOCTYPE html>
<html>

<html>

    <head>
        <title>Catering and hospitality for student companies at SERC</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    <head>


    <body>

        <main>
            <h1>Login</h1>

            
            <form method="post" action="login.php">
                <label for="username">Username</label>
                <input type="text" name="username"><br>

                <label for="password">Password</label>
                <input type="text" name="password"></br>


                <input type="submit" value="Login!">

            </form>

        </main>


    </body>