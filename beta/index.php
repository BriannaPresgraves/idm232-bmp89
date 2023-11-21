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
        </header>
        <div class="back">
            <a href="home.php" class="back_button"><  Back to Recipes</a>
        </div>
        <main>
            <?php
            require_once './includes/fun.php';
            consoleMsg("fun.php is loaded");

            // Include env.php that holds global vars with secret info
            require_once './env.php';

            // Include the database connection code
            require_once './includes/database.php';
            ?>

<?php
      $query = "SELECT * FROM recipes WHERE id=1";
      $results = mysqli_query($db_connection, $query);
      if ($results->num_rows > 0) {
        consoleMsg("Query successful! number of rows: $results->num_rows");
        while ($oneRecipe = mysqli_fetch_array($results)) {
        
            echo '<div class="recipeheading">';
            // Recipe Info
            echo '<div class="main_info">';
            echo '<figure class="heading">';
                    echo '<img src="images/' .$oneRecipe['Main IMG']. '" alt="Dish Image">';
                echo '<div class="headinginfo">';
                    echo '<div class="title">';
                    echo '<figcaption>' .$oneRecipe['Title']. '</figcaption>';
                    echo '</div>';
                    echo '<div>';
                    echo '<figcaption class="with">' .$oneRecipe['Subtitle']. '</figcaption>';
                    echo '</div>';
                    echo '<div>';
                    echo '<figcaption class="info">' .$oneRecipe['Cook Time']. '</figcaption>';
                    echo '</div>';
                    echo '<div>';
                    echo '<figcaption class="info">' .$oneRecipe['Servings']. ' servings</figcaption>';
                    echo '</div>';
                    echo '<div>';
                    echo '<figcaption class="info">' .$oneRecipe['Cal/Serving']. ' cal/serving</figcaption>';
                    echo '</div>';
                    echo '<div>';
                    echo '<p class="description">' .$oneRecipe['Description']. '</p>';
                    echo '</div>';
                echo '</div>';
            echo '</figure>';
            echo '</div>';
            echo '</div>';

            // Ingredients Img and List
        $ingredients = explode('*', $oneRecipe['All Ingredients']);

        function wrapNumbersWithSpan($string) {
            return preg_replace('/(\d+\/\d+|\d+)/', '<span class="number">$1</span>', $string);
        }
            echo '<div class="ingredients">';
                echo '<div>';
                    echo '<figure class="ing">';
                        echo '<img src="images/' .$oneRecipe['Ingredients IMG']. '" alt="Ingredients">';
                    echo '<div class="text">';
                        echo '<div class="ingList">';
                            echo '<figcaption class="stepName">Ingredients</figcaption>';
                            echo '<figcaption class="ingList">';
                                echo '<ul>';
                                foreach ($ingredients as $ingredient):
                                echo '<li>' .wrapNumbersWithSpan(trim($ingredient)). '</li>';
                                endforeach;
                                echo '</ul>';
                            echo '</figcaption>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                    echo '</figure>';
            echo '</div>';

            // Instructions
            echo '<div class="recipesteps">';
            echo '<div class="steps">';
            echo '<figure class="step">';

        $imageUrls = explode('*', $oneRecipe['Step IMGs']);

        for ($i = 1; $i <= 6; $i++) {
            $stepTitleKey = 'Step Title #' . $i;
            $stepDescKey = 'Step Desc #' . $i;
        
            if (!empty($oneRecipe[$stepTitleKey]) && !empty($oneRecipe[$stepDescKey])) {
                $stepName = preg_replace('/^\d+\s*/', '', $oneRecipe[$stepTitleKey]);
                
                // Echo the step number if title and description exist
                echo '<figcaption class="stepName">Step ' . $i . '</figcaption>';
                
                // Echo the modified step title (without the number) and description
                echo '<figcaption class="stepName">' . $stepName . '</figcaption>';
                echo '<figcaption class="stepDesc">' . $oneRecipe[$stepDescKey] . '</figcaption>';
            
                // Step IMG
                if (isset($imageUrls[$i - 1])) {
                    echo '<img src="images/' . $imageUrls[$i - 1] . '"/>';
                }
            }
        }

            echo '</figure>';
            echo '</div>';
            echo '</div>';
        }

      } else {
        consoleMsg("QUERY ERROR");
      }
    ?>
        </main>

        <footer>
            <p class="footer">&copy; 2023 Sizzle and Savor</p>
        </footer>

      </body>
</html>