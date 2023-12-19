<?php
  require_once './includes/fun.php';
  consoleMsg("yehhhh");

  // Include env.php that holds global vars with secret info
  require_once './env.php';


  // Include the database connection code
  require_once './includes/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sizzle and Savor</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="hero-img">
        <picture>
            <source media="(min-width: 700px)" srcset="assets/herobanner_desktop2.png">
            <img src="assets/herobanner_desktop.png" alt="Hero Banner">
        </picture>
        <div class="site-logo">
            <h2><a href="index.php">Sizzle and Savor</a></h2>
        </div>
        <div class="overlay-text">
            <h1>Sizzle and Savor</h1>
            <h4>Savor the Flavors of Home Cooking</h4>
        </div>
    </div>
    <div class="search-container">
        <form action="index.php" method="POST">
        <input id="search" name="search" value="<?php echoSearchValue(); ?>" type="search" placeholder="Search for recipes">
        <button type="submit" name="submit" value="submit" class="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        </form>
    </div>
    <div class="recipe-container">
    <div class="filter">
        <div>
        <div class="filter-text">
            <h3>Protein</h3>
        </div>
        <div class="protein-filter">
        <button class="filter-button" data-filter="beef" onclick="toggleFilter('beef', this)">Beef</button>
        <button class="filter-button" data-filter="chicken" onclick="toggleFilter('chicken', this)">Chicken</button>
        <button class="filter-button" data-filter="fish" onclick="toggleFilter('fish', this)">Fish</button>
        <button class="filter-button" data-filter="pork" onclick="toggleFilter('pork', this)">Pork</button>
        <button class="filter-button" data-filter="steak" onclick="toggleFilter('steak', this)">Steak</button>
        <button class="filter-button" data-filter="turkey" onclick="toggleFilter('turkey', this)">Turkey</button>
        <button class="filter-button" data-filter="vegitarian" onclick="toggleFilter('vegitarian', this)">Vegetarian</button>
        <button class="filter-button clear-btn" type="button" onclick="clearFilters()">Clear All</button>
        </div>
        </div>
    </div>

    <div class="recipes">
    <?php

      // STEP 05 Build Search Query
      $search = $_POST['search'];
      consoleMsg("Search is: $search");

      // STEP 06 Build Filter Query
      // Get filter info if passed in URL
      $filter = $_GET['filter'];
      consoleMsg("Filter is: $filter");

    if (!empty($search)) {
        consoleMsg("Doing a SEARCH");
        // $query = "select * FROM recipes WHERE title LIKE '%{$search}%'";
        $query = "select * FROM recipes WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
        // $result = mysqli_query($connection, $query);
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

    if ($results && mysqli_num_rows($results) > 0) {
        while ($oneRecipe = mysqli_fetch_assoc($results)) {
            
            $id = $oneRecipe['id'];

            echo '<a href="./detail.php?recID='. $id .'">';
            echo '<div class="recipe-card">';
            echo '<img src="images/' . ($oneRecipe['Main IMG']) . '" alt="' . ($oneRecipe['Title']) . '">';
            echo '<h2>' . ($oneRecipe['Title']) . '</h2>';
            echo '<h3>' . ($oneRecipe['Subtitle']) . '</h3>';
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
    <footer class="footer">
        <p>&copy; 2023 Sizzle and Savor</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>