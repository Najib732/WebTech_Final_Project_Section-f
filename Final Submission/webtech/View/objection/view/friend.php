<?php
require_once('../model/sql.php');

$userId = $_SESSION['userid'];
$con = getConnection();

$sql = "SELECT friendid, friendname FROM friendlist WHERE userid='$userId'";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f8f8f8;
            color: #555;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color:rgb(162, 51, 110);
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color:pink;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-back:hover {
            background-color: pink;
        }
        .no-data {
            text-align: center;
            color: #888;
            font-size: 16px;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Friend List</h1>
        <table>
            <tr>
            
                <th>Friend Name</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    
                    echo "<td>{$row['friendname']}</td>";
                    echo "<td>
                            <form method='POST' action='../controller/friendCheck.php' style='display:inline;'>
    <input type='hidden' name='friendid' value='{$row['friendid']}'>
    <button type='submit' style='background-color: #ff6b6b; color: #fff; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;'>Delete</button>
</form>

                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td>No friends found.</td></tr>";
            }
            ?>
        </table>
        <a href="userprofile.php" class="btn-back">Go Back to Profile</a>
    </div>
</body>
</html>
