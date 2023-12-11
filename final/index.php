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
            <form action="index.php" method="POST">
                <input type="search" id="search" name="search" value="<?php echoSearchValue(); ?>" placeholder="Search for recipes..">
                <button type="submit" name="submit" id="submit" class="searchbutton">Search</button>
            </form>
        </div>
        <div class="layout">
            <div class="recipefilters">
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
                 <div class="filter">
                    <input type="checkbox" name="clearall" value="clearall"> <label for="clearall">Clear All</label>
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

            $search = $_POST['search'];
            consoleMsg("Search string is $search");

            $filter = $_GET['filter'];
            consoleMsg("Filter is: $filter");
      
            if (!empty($search)) {
              consoleMsg("Doing a SEARCH");
              // $query = "select * FROM recipes WHERE title LIKE '%{$search}%'";
              $query = "select * FROM recipes WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
              $result = mysqli_query($connection, $query);
            } elseif (!empty($filter)) {
              consoleMsg("Doing a FILTER");
              $query = "select * FROM recipes WHERE proteine LIKE '%{$filter}%'";
            } else {
              consoleMsg("Loading ALL RECIPES");
              $query = "SELECT * FROM recipes";
            }

            $filterString = $_GET['filters'] ?? '';
            $filters = explode(',', $filterString);
            $filters = array_filter($filters);
        
            $filterQueryParts = [];
            foreach ($filters as $filter) {
                $filterQueryParts[] = "proteine LIKE '%{$filter}%'";
            }
            $filterQuery = implode(" OR ", $filterQueryParts);
        
            if (!empty($search)) {
            
            } elseif (!empty($filterQuery)) {
                $query = "SELECT * FROM recipes WHERE " . $filterQuery;
            } else {
                $query = "SELECT * FROM recipes";
            }

            $results = mysqli_query($db_connection, $query);
            // consoleMsg("results is ; $results");
            if ($results && mysqli_num_rows($results) > 0) {
            consoleMsg("Query successful! number of rows: $results->num_rows");
            while ($recipe = mysqli_fetch_array($results)) {
            $id = $oneRecipe['id'];

            echo '<a href="./detail.php?recID='. $id .'">';

            echo '<div class="single">';
            echo '<img src="./images/' . ($recipe['Main IMG']) . '" alt="Dish Image">';
            echo '<div class="recipetitles">';
            echo '<h3>'  . ($recipe['Title']) . '</h3>';
            echo '<h4>'  . ($recipe['Subtitle']) . '</h4>';
            echo '</div>';
            echo '</div>';

            echo '</a>';
        }

      } else {
        echo '<div class="no-recipes-msg">';
        echo '<h2>' . 'No recipes found for "' . $search . '." Try another keyword.</h2>';
        echo '</div>';
      }

    ?>
            </div>
        </div>
        <footer>
            <p class="footer">&copy; 2023 Sizzle and Savor</p>
        </footer>
      </body>
</html>