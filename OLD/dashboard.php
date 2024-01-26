
<!DOCTYPE html>
<html lang="en">
    <?php
    include 'connection.php'
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        header a {
            text-decoration: none;
            color: #fff;
            margin: 0 20px;
        }
        main {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
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
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="admin-dashboard.html">Home</a>
        </nav>
    </header>
    <?php
    $sql="select * from recipe";
    $result=$connect->query($sql);
    if($result->num_rows>0)
    {
       ?>
    <main>
        <h2>User Information</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Email ID</th>
                <th>Password</th>
            </tr>
            <?php
            while($row=$result->fetch_assoc())
                {
                    echo'<tr>';
                    echo'<td>';
                    echo $row["username"];
                    echo'</td>';
                    echo'<td>';
                    echo $row["emailid"];
                    echo'</td>';
                    echo'<td>';
                    echo $row["password"];
                    echo'</td>';
                }
    }       
    ?>
        </table>
    </main>
</body>
</html>
