<?php

    include("dbsetup.php");

    //handle the form submission 

    if ($_SERVER['REQUEST_METHOD'] == "POST") // If the user has subbmitted the form 
    {
        //pull the data out of the post request 
        $title = $_POST["title"];
        $content =$_POST["content"];

        //enter title and content as a new record in our blog database tabvle 
        $sql = "INSERT INTO posts (title, content) VALUES (?, ?)"; //parameterised query to prevent sql injection attacks 
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute() == TRUE ) // if the execution was successful 
        {
            header("location: recipe.php"); //redirects user to blog.php page 

        }
        else
        {
            echo("Error: " . $stmt->error . "<br>");
        }

        
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Catering and hospitality for student companies at SERC</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
     
    </head>

    <body>

        <header>
        <h1>Catering and hospitality for SERC</h1>

        </header>

        <nav>
            <ul>
            <a href="index.php">Home</a>
            <a href="recipe.php">Recipes</a>
            <a href="About.php">About</a>
            <a href="contact.php">Contacts</a>
            <a href="post.php">Post</a>
            </ul>
        </nav>
        


        <main>
        <form action="post.php" method="POST">
            <label for ="title">Post Title:</label><br>
            <input type="text" name="title" required><br><br>

            <label for="content">Post Content:</label><br>
            <textarea name="content" rows ="10" cols="50"></textarea><br>

            <input type="submit" value="Create recipe">

        </form>
           
        </main>

        

        <a href="recipe.php">View recipes</a>

        

       
        <footer>
            <p>&copy; SERC</p>
        </footer>
    

    </body>

</html>