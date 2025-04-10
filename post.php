<?php



session_start();



    include("dbsetup.php");

    

    if ($_SERVER['REQUEST_METHOD'] == "POST")  
    {
        
        $title = $_POST["title"];
        $servings = $_POST["servings"];
        $ingrediants = $_POST["ingrediants"];
        $instructions = $_POST["instructions"];

        
        $sql = "INSERT INTO recipes (title, servings, ingrediants, instructions) VALUES (?, ?, ?, ?)"; 
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("siss", $title, $servings, $ingrediants, $instructions);  

        if ($stmt->execute() == TRUE ) 
        {
            header("location: recipe.php");  

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

        <h1>Make your creations here and upload them to the recipe page for everyone to see !</h1>
        <form action="post.php" method="POST">

            <label for ="title">Post Title:</label><br>
            <input type="text" name="title" required><br><br>

            <label for="servings">Servings:</label><br>
            <textarea name="servings" rows ="1" cols="5"></textarea><br>

            <label for="ingrediants">Ingrediants:</label><br>
            <textarea name="ingrediants" rows ="5" cols="50"></textarea><br>

            <label for="instructions">Instructions:</label><br>
            <textarea name="instructions" rows ="10" cols="50"></textarea><br>

            <input type="submit" value="Create recipe">

        </form>
           
        </main>

        

        <a href="recipe.php">View recipes</a>

        

       
        <footer>
            <p>&copy; SERC</p>
        </footer>
    

    </body>

</html>