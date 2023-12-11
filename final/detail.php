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
            <a href="index.php" class="back_button"><  Back to Recipes</a>
        </div>
            <?php
            require_once './includes/fun.php';
            consoleMsg("fun.php is loaded");

            // Include env.php that holds global vars with secret info
            require_once './env.php';

            // Include the database connection code
            require_once './includes/database.php';
            ?>
    <main>
      <?php
      //$query = "SELECT * FROM recipes WHERE id=1";
      
      //Capture passed in RecID number
      $recID = $_GET['recID'];
      consoleMsg("recID.. is $recID");

      $query = "SELECT * FROM recipes WHERE id=$recID";

      $results = mysqli_query($db_connection, $query);
      
      if ($results->num_rows > 0) {
        consoleMsg("Query successful! number of rows: $results->num_rows");
        while ($oneRecipe = mysqli_fetch_array($results)) {
        
            echo '<div class="recipeheading">';
            // Recipe Heading Info
            echo '<div class="main_info">';
            echo '<figure class="heading">';
                    echo '<img src="images/' .$oneRecipe['Main IMG']. '" alt="Dish Image">';
                echo '<div class="headinginfo">';
                    echo '<div class="title">';
                    echo '<figcaption>' .$oneRecipe['Title']. '</figcaption>';
                    echo '</div>';
                    
                    echo '<figcaption class="with">' .$oneRecipe['Subtitle']. '</figcaption>';
                    
                    echo '<figcaption class="info">' .$oneRecipe['Cook Time']. '</figcaption>';
                    
                    echo '<figcaption class="info">' .$oneRecipe['Servings']. ' servings</figcaption>';
                  
                    echo '<figcaption class="info">' .$oneRecipe['Cal/Serving']. ' cal/serving</figcaption>';
                    
                    echo '<p class="description">' .$oneRecipe['Description']. '</p>';
                    
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
                        echo '<img src="./images/ing/' .$oneRecipe['Ingredients IMG']. '" alt="Ingredients">';
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
        
            // Recipe steps and Images
            echo '<div class="recipesteps">';
            echo '<div class="steps">';
                        $stepTextArray = explode('*', $oneRecipe['All Steps']);
                        $stepImagesArray = explode("*", $oneRecipe['Step IMGs']);
                            
                        for($lp = 0; $lp < count($stepTextArray); $lp++) {
                            //If step starts with a number, get number minus one for image name
                            $firstChar = substr($stepTextArray[$lp],0,1);
                        
                            if (is_numeric($firstChar)) {
                                echo '<figure class="step">';
                                echo '<img src="./images/steps/' . $stepImagesArray[$firstChar-1] . '" alt="Dish image">';
                                echo '<figcaption class="stepName"> Step ' . $stepTextArray[$lp] . '</figcaption>';
                                echo '<figcaption class="stepDesc">' . $stepTextArray[$lp+1] . '</figcaption>';  
                                echo '</figure>';
                            }

                        }
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