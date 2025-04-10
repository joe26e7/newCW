<?php

session_start();

include("dbsetup.php");
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

            <?php

                if (isset($_SESSION["user_name"]) == TRUE) 
                    {
                        echo("<a href='LOGOUT.PHP'>log out</a>");
                    }
                    else  
                    {
                        echo("<a href='register.php'>Register</a>");
                        echo("<a href='login.php'>Log in</a>");
                    }

            ?>


            </ul>
        </nav>

        <main>
            <p>Welcome to our catering and hospility website for our students at SERC !</p>
            <P>Our catering and hospitality love creating nutritious and healthy meals that are available for everyone. This web page showcases their recipe ideas to cook on a budget throughout the year  </P>
            <p>join us in celebrating our students talents and enjoy your journey to low budget cooking !</p>

            <?php
                echo($_SESSION["user_name"]);
                echo($_SESSION["user_id"]);

            ?>

        </main>
    
        
 

        <footer>
            <p>&copy; SERC</p>
        </footer>

    </body>


   
    
    

</html>