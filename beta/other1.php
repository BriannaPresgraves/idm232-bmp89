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

      <?php
            require_once './includes/fun.php';
            consoleMsg("fun.php is loaded");
            
            // Include env.php that holds global vars with secret info
            require_once './env.php';
            
            // Include the database connection code
            require_once './includes/database.php';
        ?>

        <header>
            <img class="hero" src="images/heroimage3.jpg" alt="Hero image"></img>
            <div class="overlay">
                <h1>Sizzle</h1>
                <h1 class="and">and</h1>
                <h1>Savor</h1>
            </div>
        </header>
        <div class="back">
            <a href="home.html" class="back_button"><  Back to Recipes</a>
        </div>
        <main>
            <?php
            $recipeId = 1; // Replace this with the actual recipe ID

            // Fetch the recipe information from the database
            $query = "SELECT * FROM recipes WHERE id = $recipeId";
            $results = mysqli_query($db_connection, $query);
                            
            // Check if the query was successful
            if ($results) {
            // Assuming you only expect one row for the given recipe ID
            $oneRecipe = mysqli_fetch_assoc($results);

            echo '<div class="recipeheading">';
                echo '<div class="main_info">';
                    echo '<figure class="heading">';
                            echo '<img src="./images/' . $oneRecipe['Main IMG'] . '" alt="Recipe Image">';
                        
                        echo '<div class="headinginfo">';
                        echo '<div class="title"><figcaption>' . $oneRecipe['Title'] . '</figcaption></div>';
                        echo '<div><figcaption class="with">' . $oneRecipe['Subtitle'] . '</figcaption></div>';
                        echo '<div><figcaption class="info">' . $oneRecipe['Cook Time'] . '</figcaption></div>';
                        echo '<div><figcaption class="info">' . $oneRecipe['Servings'] . '</figcaption></div>';
                        echo '<div><figcaption class="info">' . $oneRecipe['Cal/Serving'] . '</figcaption></div>';
                        echo '<div><p class="description">' . $oneRecipe['Description'] . '</p></div>';
                    echo '</figure>';
                echo '</div>';
            echo '</div>';
    
            echo '<div class="ingredients">';
                echo '<div>';
                    echo '<figure class="ing">'
                        echo '<img src="./images/' . $oneRecipe['Ingredients IMG'] . '" alt="Ingredients Image">';
                    echo '<div class="text">';
                        echo '<div class="ingList">';
                            echo '<figcaption class="stepName">Ingredients</figcaption>';
                            echo '<figcaption class="ingList">';
                                $ingredientsArray = explode("*", $oneRecipe['All Ingredients']);
                                echo '<ul>';
                                foreach ($ingredientsArray as $ingredient) {
                                echo '<li>' . $ingredient . '</li>';
                                }
                                echo '</ul>';
                            echo '</figcaption>';
                        echo '</div>';
                    echo '</div>'; 
                echo '</div>';
                    echo '</figure>';
            echo '</div>';   

            echo '<div class="recipesteps">';
                $stepTextArray = explode("*", $oneRecipe['All Steps']);
                // echo '<p> Number of Step Text: ' . count($stepTextArray) . '</p>';

                $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);
                // echo '<p> Number of Step Images: ' . count($stepImagesArray) . '</p>';

                for ($lp = 0; $lp < count($stepTextArray); $lp++) {
                // If step starts with a number, get number minus one for image name
                $firstChar = substr($stepTextArray[$lp], 0, 1);

                if (is_numeric($firstChar)) {
                    consoleMsg("First Char is: $firstChar");
                    echo '<img class="stepimg" src="./images/' . $stepImagesArray[$firstChar - 1] . '" alt="Step Image">';
                }

                echo '<div class="steps">';
                echo '<figure class="step">';
                echo '<figcaption class="stepName">' . ($lp + 1) . ':</figcaption>';
                echo '<figcaption class="stepDesc">' . $stepTextArray[$lp] . '</figcaption>';
                echo '</figure>';
                echo '</div>';
            }
            echo '</div>';

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