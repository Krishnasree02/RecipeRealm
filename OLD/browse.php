<?php
// Assuming you have a database connection here

$localhost="127.0.0.1";
$username = "root";
$password = "";
$dbname = "reciperealm";
$conn = new mysqli($localhost, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Sample query to fetch recipe data
$sql = "SELECT recipename, ingredients, instruction,author FROM addrecipe";
$result = $conn->query($sql);
$recipes = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Recipes</title>
   
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        /* Set the background image */
        background-image: url('bg3.jpeg');
        background-size: cover; /* Adjust the background size */
        background-position: center; /* Center the background */
    }
    /* Rest of your CSS styles... */
</style>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        /* Set the background image */
        background-image: url('bg3.jpeg');
        background-size: cover; /* Adjust the background size */
        background-position: center; /* Center the background */
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    main {
        text-align: center;
    /* Semi-transparent white background for better readability */
        border-radius: 10px;
        margin: 20px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap; /* Allow items to wrap to the next line */
        justify-content: space-evenly; /* Spread items evenly */
        gap: 20px; /* Space between items */
    }
    .recipe-pair {
        display: flex;
        justify-content: space-between;
        width: calc(50% - 10px); /* Adjust the width of each recipe pair */
        margin-bottom: 20px;
    }
    .recipe-list-item {
        background-color: #f9f9f9; /* Light gray background */
        border-radius: 10px;
        padding: 20px;
        text-align: left;
        width: 48%; /* Each recipe takes up almost half of the width in a pair */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transition */
    }
    .recipe-list-item:hover {
        transform: translateY(-5px); /* Move the card slightly up on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Adjusted shadow on hover */
    }
    .recipe-list-item h2 {
        color: #333;
        margin-top: 0;
    }
    .recipe-list-item p {
        color: #666;
        margin-bottom: 10px; /* Space between paragraphs */
    }
    .search-bar {
        margin: 20px;
        text-align: center;
    }
    .search-input {
        width: 300px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

</head>
<body>
    <main>
        <div class="search-bar">
            <input class="search-input" type="text" placeholder="Search for recipes" id="searchInput">
            <button onclick="searchRecipe()">Search</button>
        </div>
        <ol class="recipe-list" id="recipeList">
            <?php foreach ($recipes as $recipe): ?>
                <li class="recipe-list-item">
                    <h2><?= $recipe['recipename']; ?></h2>
                    <p>Ingredients: <?= $recipe['ingredients']; ?></p>
                    <p>Instructions: <?= $recipe['instruction']; ?></p>
                    <p>author: <?= $recipe['author']; ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </main>

    <script>
        function searchRecipe() {
            var searchInput = document.getElementById("searchInput").value.toLowerCase();
            var recipeList = document.getElementById("recipeList");

            for (var i = 0; i < recipeList.children.length; i++) {
                var recipe = recipeList.children[i];
                var recipeName = recipe.getElementsByTagName("h2")[0].textContent.toLowerCase();

                if (recipeName.includes(searchInput)) {
                    recipe.style.display = "block";
                } else {
                    recipe.style.display = "none";
                }
            }
        }
    </script>
</body>
</html>