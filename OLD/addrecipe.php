
<?php
$localhost="127.0.0.1";
$username = "root";
$password = "";
$dbname = "reciperealm";
$conn = new mysqli($localhost, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipename = $_POST["recipename"];
    $ingredients = $_POST["ingredients"];
    $instruction = $_POST["instruction"];
    $author = $_POST["author"];

    // To protect from SQL injection
    $recipename = mysqli_real_escape_string($conn, $recipename);
    $ingredients = mysqli_real_escape_string($conn, $ingredients);
    $instruction = mysqli_real_escape_string($conn, $instruction);
    $author = mysqli_real_escape_string($conn, $author);

    // Insert data into the database
    $sql = "INSERT INTO addrecipe (recipename, ingredients, instruction, author) VALUES ('$recipename', '$ingredients', '$instruction', '$author')";

    if ($conn->query($sql) === TRUE) {
        echo "Recipe added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>