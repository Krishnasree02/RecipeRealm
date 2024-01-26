<?php
$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "reciperealm";

// Create connection
$conn = new mysqli($localhost, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            background-color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 15px 0;
            text-align: center;
            width: 100%;
            display: block;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            text-align: center;
            color: #333;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .login-info,
        .recipe-info,
        .count-info, 
        {
            display: none;
        }

        .icon-container {
            display: flex;
            flex-direction: column;
        }

        .icon {
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .icon:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="dashboard">
        <div class="sidebar">
            <div class="icon-container">
                <div class="icon" onclick="showLoginInfo()"><i class="fas fa-lock"></i> Login Information</div>
                <div class="icon" onclick="showRecipeInfo()"><i class="fas fa-book"></i> Recipe Information</div>
                <div class="icon" onclick="showcount()"><i class="fas fa-book"></i> count information</div>
            </div>
        </div>

        <div class="main-content">
            <div class="header">ADMIN DASHBOARD</div>

            <div class="login-info">
                <?php
                $sql = "SELECT * FROM recipe";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                ?>
                    <h2>User Information</h2>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Email ID</th>
                            <th>Password</th>
                        </tr>

                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            echo $row["username"];
                            echo '</td>';
                            echo '<td>';
                            echo $row["emailid"];
                            echo '</td>';
                            echo '<td>';
                            echo $row["password"];
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                <?php
                }
                ?>
            </div>

            <div class="recipe-info">
                <?php
                $sql = "SELECT * FROM addrecipe";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                ?>
                    <h2>Recipe Information</h2>
                    <table>
                        <tr>
                            <th>Recipe name</th>
                            <th>Author</th>
                        </tr>

                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            echo $row["recipename"];
                            echo '</td>';
                            echo '<td>';
                            echo $row["author"];
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                <?php
                }
                ?>
            </div>
            <div class="count-info">
            <div class="count-info">
    <?php
    
    $recipeCountSql = "SELECT COUNT(*) AS recipeCount FROM addrecipe"; 
    $recipeCountResult = $conn->query($recipeCountSql);
    $recipeCount = $recipeCountResult->fetch_assoc()['recipeCount'];


    $userCountSql = "SELECT COUNT(*) AS userCount FROM recipe"; 
    $userCountResult = $conn->query($userCountSql);
    $userCount = $userCountResult->fetch_assoc()['userCount'];
    ?>
    <h2>Count Information</h2>
    <table>
        <tr>
            <th>Recipe Count</th>
            <th>User Count</th>
        </tr>
        <tr>
            <td><?php echo $recipeCount; ?></td>
            <td><?php echo $userCount; ?></td>
        </tr>
    </table>
</div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        function showLoginInfo() {
            document.querySelector('.login-info').style.display = 'block';
            document.querySelector('.recipe-info').style.display = 'none';
            document.querySelector('.count-info').style.display = 'none';
        }

        function showRecipeInfo() {
            document.querySelector('.login-info').style.display = 'none';
            document.querySelector('.recipe-info').style.display = 'block';
            document.querySelector('.count-info').style.display = 'none'   

        }
        function showcount(){
            document.querySelector('.count-info').style.display = 'block';
                document.querySelector('.login-info').style.display = 'none';
            document.querySelector('.recipe-info').style.display = 'none';
        } 
    </script>

</body>

</html>
<?php
// Close the database connection
$conn->close();
?>
