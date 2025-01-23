<?php 
session_start();
$id= $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Help Desk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }
        h1 {
            background-color: #FF69B4; /
    color: white;
    padding: 10px;
    font-size: 24px; 
        }
        p {
            font-size: 18px;
        }
        a {
            text-decoration: none;
            color: #FF69B4;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            margin: 20px auto;
            width: 80%;
            max-width: 300px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h1>Help Desk</h1>
    <div class="container">
        <div class="section">
            <p>Account related help</p>
            <a href="help.php">Help</a>
        </div>

        <div class="section">
            <p>Terms and Conditions of our website</p>
            <a href="terms.php">Terms</a>
        </div>

        <div class="section">
            <p>Reported profiles and problems</p>
            <a href="report.php">Reports</a>
        </div>

        <div class="section">
            <p>Contact with us for any question</p>
            <a href="contact.php">Contact Us</a>
        </div>

        <div class="section">
            <p>Back to your profile</p>
            <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>.
        </div>
    </div>
</body>
</html>
