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
                <button class="filter" id="beef" value="beef" onclick="handleFilterClick(this)"><a href="index.php?filter=beef" class="btnText">Beef</a></button>
                <button class="filter" id="steak" value="steak" onclick="handleFilterClick(this)"><a href="index.php?filter=steak" class="btnText">Steak</a></button>
                <button class="filter" id="turkey" value="turkey" onclick="handleFilterClick(this)"><a href="index.php?filter=turkey" class="btnText">Turkey</a></button>
                <button class="filter" id="chicken" value="chicken" onclick="handleFilterClick(this)"><a href="index.php?filter=chicken" class="btnText">Chicken</a></button>
                <button class="filter" id="pork" value="pork" onclick="handleFilterClick(this)"><a href="index.php?filter=pork" class="btnText">Pork</a></button>
                <button class="filter" id="fish" value="fish" onclick="handleFilterClick(this)"> <a href="index.php?filter=fish" class="btnText">Fish</a></button>
                <button class="filter" id="vegitarian" value="vegitarian" onclick="handleFilterClick(this)"><a href="index.php?filter=vegitarian" class="btnText">Vegetarian</a></button>
                <button class="filter" onclick="clearFilters()">Clear</button>
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
        echo '<div class="noResults">';
        echo '<h1 class="NoResultsMsg"> ' . 'No results found for: "' . $search . '"</h1>';
        echo '</div>';
      }

    ?>
            </div>
        </div>
        <footer>
            <p class="footer">&copy; 2023 Sizzle and Savor</p>
        </footer>

        <script src="./scripts/main.js"></script>

      </body>
</html>