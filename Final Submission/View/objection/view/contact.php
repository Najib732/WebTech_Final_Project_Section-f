
<?php 
session_start();
$id= $_SESSION['userid'];
?>

<html >
<head>
  
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    <p>If you have any questions, feel free to contact us by filling out the form below.</p>

    <form >
       
        Name <input type="text" text="name" name="name"  required><br><br>

        
        Email <input type="email" text="email" name="email"  required><br><br>


        What is your question? 
        <textarea text="question" name="question"  required></textarea><br><br>

        <button type="submit">Submit</button><br>

        <p>Back to your profile</p>
        <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>.
    </form>
</body>
</html>
