<?php
include('dbsetup.php');

//varibles for use outside the if/else struvture - can be used later on down the page 
    $search_term = "";
    $result = null;
   

    if(isset($_GET['search']))// handle the form if the search parameter is set (search form was used )
    {
        $search_term = trim($_GET['search']);

        //prepare the SQL query to search for the search term in the title and content fields in the DB
        $sql = "SELECT * FROM posts WHERE title LIKE ?  OR content LIKE ? ORDER BY created_at DESC";

        $stmt = $connection->prepare($sql);
        $search_param = "%" . $search_term . "%";
        $stmt->bind_param("ss", $search_param,$search_param);
        $stmt->execute();

        $result = $stmt->get_result();
    }
    else // handle the request for this page with no parameter snet along with the request
    {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC"; // sql to select all recorss from the database in descending order from the date stamp date 
    $result = $connection->query($sql); // assigning all records retreived from the database to the $results area 
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
            <h1>Recipies</h1>



        </header>

        <nav>
            <a href="index.php">Home</a>
            <a href="recipe.php">recipie</a>
            <a href="About.php">About</a>
            <a href="contact.php">Contacts</a>
            <a href="post.php">Post</a>

        </nav>

        <main>

            <h1>Search different recipes from our students at serc and find one that suits you</h1>
            <!--search form sends a GET request to the server for blog.php and it sends the search value -->
            <form method="GET" action="blog.php">
                <input type="text" name="search" placeholder="Search recipes...">
                <button type="submit">Search!</button>

            </form>


            <?php
            // cdreate a loop to iterate over the records retreived from the db and build a div for each post 
            while ($row = $result->fetch_assoc())//$row takes on each point in the db in turn 
             {
                $post_title = htmlspecialchars($row['title']);
                $post_content = htmlspecialchars($row['content']);

                echo ("<div class= 'post'>");
                echo("<h2>" . $post_title . "</h2>");
                echo("<p class='timestamp'>" . $row["created_at"] . "</p>");
                echo("<p>" . $post_content . "</p>");
                echo("</div>");
             }
            


            ?>
             <p>
                <a href="index.php">Back Home !</a>

            </p>



            
            <!--<div class="post">
                <h2>This is post title!</h2>
                <p class= "timestamp">13/03/25 11:49</p>
                <p>This is the post content</p>


            </div>-->

        </main>

        <footer>
            <span>&copy: SERC
        </footer>


    </body>

</html>