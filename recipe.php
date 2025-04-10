<?php
include('dbsetup.php');



session_start();



 
    $search_term = "";
    $result = null;
   

    if(isset($_GET['search']))
    {
        $search_term = trim($_GET['search']);

       
        $sql = "SELECT * FROM recipes WHERE title LIKE ?  OR content LIKE ? ORDER BY created_at DESC";

        $stmt = $connection->prepare($sql);
        $search_param = "%" . $search_term . "%";
        $stmt->bind_param("siss", $search_param,$search_param);
        $stmt->execute();

        $result = $stmt->get_result();
    }
    else 
    {
        $sql = "SELECT * FROM recipes ORDER BY created_at DESC"; 
    $result = $connection->query($sql); 
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
            <h1>Recipes</h1>



        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="recipe.php">Recipes</a>
            <a href="About.php">About</a>
            <a href="contact.php">Contacts</a>
            <a href="post.php">Post</a>

        </nav>

        <main>

            <h1>Search different recipes from our students at serc and find one that suits you</h1>
          
            <form method="GET" action="blog.php">
                <input type="text" name="search" placeholder="Search recipes...">
                <button type="submit">Search!</button>

            </form>


            <?php
            
            while ($row = $result->fetch_assoc())
             {
                $post_title = htmlspecialchars($row['title']);
                $post_servings = htmlspecialchars($row['servings']);
                $post_ingredients = htmlspecialchars($row['ingrediants']);
                $post_instructions = htmlspecialchars($row['instructions']);


                echo ("<div class= 'post'>");
                echo("<h2>" . $post_title . "</h2>");
                echo("<p class='timestamp'>" . $row["created_at"] . "</p>");
                echo("<p>Servings: " . $post_servings . "</p>");
                echo("<p>Ingredients: " . $post_ingredients . "</p>");
                echo("<p>Instructions: " . $post_instructions . "</p>");
                echo("</div>");
             }
            


            ?>
           



            
            <!--<div class="post">
                <h2>This is post title!</h2>
                <p class= "timestamp">13/03/25 11:49</p>
                <p>This is the post content</p>


            </div>-->
 
        </main>
        <p>
                <a href="index.php">Back Home !</a>

            </p>

        <footer>
            <span>&copy: SERC
        </footer>


    </body>

</html>