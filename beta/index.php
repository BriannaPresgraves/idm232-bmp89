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
            <a href="home.html" class="back_button"><  Back to Recipes</a>
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
            <div class="recipeheading">
                <?php
                $query = "SELECT * FROM `recipes` WHERE `id` = 1";
                $results = mysqli_query($db_connection, $query);
                $recipe = array();

                if ($results->num_rows > 0) {
                    $recipe = mysqli_fetch_assoc($results);
                } else {
                    echo '<p>No recipes found.</p>';
                }
                ?>
    
                <div class="main_info">
                    <figure class="heading">
    
                            <img src="images/<?php echo ($recipe['Main IMG']); ?>" alt="Ancho-Orange Chicken">
                        
                    <div class="headinginfo">
                        <div class="title">
                            <figcaption><?php echo ($recipe['Title']); ?></figcaption>
                        </div>
    
                        <div>
                            <figcaption class="with"><?php echo ($recipe['Subtitle']); ?></figcaption>
                        </div>
    
                        <div>
                            <figcaption class="info"><?php echo ($recipe['Cook Time']); ?></figcaption>
                        </div>
    
                        <div>
                            <figcaption class="info"><?php echo ($recipe['Servings']); ?> servings</figcaption>
                        </div>

                        <div>
                            <figcaption class="info"><?php echo ($recipe['Cal/Serving']); ?> cal/serving </figcaption>
                        </div>
    
                        <div>
                            <p class="description"><?php echo ($recipe['Description']); ?></p>
                        </div>
    
                    </div>
    
                      </figure>
                </div>
        
            </div>

            <?php
            $ingredients = explode('*', $recipe['All Ingredients']);

            function wrapNumbersWithSpan($string) {
                return preg_replace('/(\d+\/\d+|\d+)/', '<span class="number">$1</span>', $string);
            }
            ?>
    
            <div class="ingredients">
                <div>
                    <figure class="ing">
    
                            <img src="images/<?php echo ($recipe['Ingredients IMG']);?>" alt="Ancho-Orange Chicken">
                        
                    <div class="text">
                        <div class="ingList">
                            <figcaption class="stepName">Ingredients</figcaption>
                            <figcaption class="ingList">
                            <ul>
                                <?php foreach ($ingredients as $ingredient): ?>
                                <li><?php echo (wrapNumbersWithSpan(trim($ingredient))); ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </figcaption>
                        </div>
                    </div>
                </div>
                     </figure>
            </div>
    
            <div class="recipesteps">
            <div class="steps">
                <figure class="step">
                    <img src="images/anchochickenstep1.jpg" alt="step 1">
                    <figcaption class="stepName">Step 1. Cook the rice:</figcaption>
                    <figcaption class="stepDesc">Place an oven rack in the center of the oven, then preheat to 450°F. 
                        In a medium pot, combine the rice, a big pinch of salt, and 1 1/2 cups of water. Heat to boiling on high. Once boiling, 
                        cover and reduce the heat to low. Cook 12 to 14 minutes, or until the water has been absorbed and the rice is tender. 
                        Turn off the heat and fluff with a fork. Cover to keep warm.</figcaption>
                  </figure>
    
                  <figure class="step">
                    <img src="images/anchochickenstep2.jpg" alt="step 2">
                    <figcaption class="stepName">Step 2. Prepare the ingredients & make the glaze:</figcaption>
                    <figcaption class="stepDesc">While the rice cooks, wash and dry the fresh produce. Peel the carrots; quarter lengthwise, 
                        then halve crosswise. Peel and roughly chop the garlic. Remove and discard the stems of the kale; finely chop the leaves. 
                        Using a peeler, remove the lime rind, avoiding the white pith; mince to get 2 teaspoons of zest (or use a zester). 
                        Halve the lime crosswise. Halve the orange; squeeze the juice into a bowl, 
                        straining out any seeds. Whisk in the chile paste and 2 tablespoons of water until smooth.</figcaption>
                  </figure>
    
                  <figure class="step">
                    <img src="images/anchochickenstep3.jpg" alt="step 3">
                    <figcaption class="stepName">Step 3. Roast the carrots:</figcaption>
                    <figcaption class="stepDesc">Place the sliced carrots on a sheet pan. Drizzle with olive oil and season with salt and pepper; 
                        toss to coat. Arrange in an even layer. 
                        Roast 15 to 17 minutes, or until tender when pierced with a fork. Remove from the oven.</figcaption>
                  </figure>
    
                  <figure class="step">
                    <img src="images/anchochickenstep4.jpg" alt="step 4">
                    <figcaption class="stepName">Step 4. Cook the kale:</figcaption>
                    <figcaption class="stepDesc">While the carrots roast, in a large pan (nonstick, if you have one), heat 2 teaspoons of olive oil on medium-high until hot. 
                        Add the chopped garlic and cook, stirring constantly, 30 seconds to 1 minute, or until fragrant. Add the chopped kale; 
                        season with salt and pepper. Cook, stirring occasionally, 3 to 4 minutes, or until slightly wilted. Add 1/3 cup of water; 
                        season with salt and pepper. Cook, stirring occasionally, 3 to 4 minutes, or until the kale has wilted and the water has 
                        cooked off. Transfer to the pot of cooked rice. Stir to combine; 
                        season with salt and pepper to taste. Cover to keep warm. Wipe out the pan.</figcaption>
                  </figure>
    
                  <figure class="step">
                    <img src="images/anchochickenstep5.jpg" alt="step 5">
                    <figcaption class="stepName">Step 5. Cook & glaze the chicken:</figcaption>
                    <figcaption class="stepDesc">While the carrots continue to roast, pat the chicken dry with paper towels; season with salt and pepper on both sides. 
                        In the same pan, heat 2 teaspoons of olive oil on medium-high until hot. Add the seasoned chicken and cook 4 to 6 minutes on the first side, or until browned. 
                        Flip and cook 2 to 3 minutes, or until lightly browned. Add the glaze and cook, frequently spooning the glaze over the chicken, 2 to 3 minutes, or until the chicken is coated and cooked through. 
                        Turn off the heat; stir the butter and the juice of 1 lime half into the glaze until the butter has melted. 
                        Season with salt and pepper to taste.</figcaption>
                  </figure>
    
                  <figure class="step">
                    <img src="images/anchochickenstep6.jpg" alt="step 6">
                    <figcaption class="stepName">Step 6. Finish the rice & serve your dish:</figcaption>
                    <figcaption class="stepDesc">To the pot of cooked rice and kale, add the lime zest, crème fraîche, raisins, and the juice of the remaining lime half. 
                        Stir to combine; season with salt and pepper to taste. Serve the glazed chicken with the finished rice and roasted carrots. 
                        Top the chicken with the remaining glaze from the pan. Enjoy! </figcaption>
                  </figure>
    
            </div>    
            </div>
    
        </main>

        <footer>
            <p class="footer">&copy; 2023 Sizzle and Savor</p>
        </footer>

      </body>
</html>