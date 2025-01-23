
<html>
<head>
    <title>Report</title>
</head>
<body>
    <h1>Reported problems</h1>

    <p>If you have any other problem, you can report it here by filling up this form.</p>

    <form action="../controller/reportCheck.php" method="POST"> 
       
        Name: <input type="text" name="name"><br><br>

        Email: <input type="email" name="email" ><br><br>

        What is your question? 
        <textarea name="report" ></textarea><br><br>

        <button type="submit" name="submit">Submit</button><br>

        <p>Back to your profile</p>
        <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>
    </form>
    <script src="../asset/report.js"></script>

</body>
</html>
