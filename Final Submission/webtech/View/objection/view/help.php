
<?php 
session_start();
$id= $_SESSION['userid'];
?>
<html>

<head>

    <title>Help Center</title>
</head>

<body>
    <h1>Help Center</h1>
    <p>Find solutions to common problems below:</p>

    <h2>1. How to log in?</h2>
    <p>To log in, click on the "Log In" button of the homepage, enter your email and password, then click "Login."</p>

    <h2>2. How to delete my account?</h2>
    <p>Go to your profile settings, scroll down and click "Delete Account." Follow the prompts to confirm.</p>

    <h2>3. How to report another account?</h2>
    <p>Visit the profile of the user you want to report. Click on the "Report." button and Choose a reason for the report and submit.</p>

    <h2>4. How to post?</h2>
    <p>On your homepage or profile, locate the "Create Post" button. Write your content, upload any images or videos if needed, and click "Post."</p>

    <h2>5. How to comment on a post?</h2>
    <p>Below each post, you will see a comment box. Type your comment and press "Enter" or click the "Submit" button.</p>

    <h2>6. How to like a post?</h2>
    <p>Below each post, click the "Like" button to express your appreciation.</p>

    <h2>7. Need further help?</h2>
    <p>If your problem isn't listed here, please contact our <a href="contact.php">Support Team</a>.</p><br>

    <p>Back to your profile</p>
    <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>.
</body>

</html>