<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/styles.css"/>
    <title>Sizzle and Savor</title>
</head>
      <body>
        <header>
            <img class="hero" src="images/heroimage3.jpg" alt="Hero image"></img>
            <div class="overlay">
                <h1>Sizzle</h1>
                <h1 class="and">and</h1>
                <h1>Savor</h1>
            </div>
            <div class="subtitle">
                <h2>Savor the Flavors of Home Cooking</h2>
            </div>
        </header>
        <div class="search">
            <button class="searchbutton">Search</button>
            <input type="text" placeholder="Search for recipes..">
        </div>
        <div class="layout">
            <div class="recipefilters">
                <h2 class="filtertext">Protein</h2>
                <div class="filter">
                    <input type="checkbox" name="all" value="all"> <label for="all">All</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="beef" value="beef"> <label for="beef">Beef</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="chicken" value="chicken"> <label for="chicken">Chicken</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="pork" value="pork"> <label for="pork">Pork</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="fish" value="fish"> <label for="fish">Fish</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="steak" value="steak"> <label for="steak">Steak</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="turkey" value="turkey"> <label for="turkey">Turkey</label>
                 </div>
                 <div class="filter">
                    <input type="checkbox" name="vegetarian" value="vegetarian"> <label for="vegetarian">Vegetarian</label>
                 </div>
            </div>
            <div class="recipes37">
            <?php
            require_once './includes/fun.php';
            consoleMsg("PHP to JS is not it");
            require_once './env.php';
            require_once './includes/database.php';
            ?>
            <?php
            // Get all the recipes from "recipes" table in the "idm232" database
            consoleMsg("results is ; $results");
            $query = "SELECT * FROM recipes";
            $results = mysqli_query($db_connection, $query);
            // consoleMsg("results is ; $results");
            if ($results && mysqli_num_rows($results) > 0) {
            consoleMsg("Query successful! number of rows: $results->num_rows");
            while ($recipe = mysqli_fetch_array($results)) {

            echo '<div class="single">';
            echo '<img src="./images/' . ($recipe['Main IMG']) . '" alt="Dish Image">';
            echo '<div class="recipetitles">';
            echo '<h3>'  . ($recipe['Title']) . '</h3>';
            echo '<h4>'  . ($recipe['Subtitle']) . '</h4>';
            echo '</div>';
            echo '</div>';
        }

      } else {
        echo '<p>No recipes found</p>';
        consoleMsg("QUERY ERROR");
      }

    ?>
            </div>
        </div>
        <footer>
            <p class="footer">&copy; 2023 Sizzle and Savor</p>
        </footer>
      </body>
</html>