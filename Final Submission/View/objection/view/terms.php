<?php 
session_start();
$id= $_SESSION['userid'];
?>

<html>
<head>
   
    <title>Terms and Conditions</title>
</head>
<body>
    <h1>Terms and Conditions</h1>

    <p>By using our website, you agree to the following terms and conditions:</p>

    <h2>1. No Fake News or Rumours</h2>
    <p>You are prohibited from posting fake news, misinformation, or rumours. If you are found posting such content, your account may be banned or deleted by the admin.</p>

    <h2>2. No Hate Speech</h2>
    <p>You are not allowed to spread hate or harmful content. Posts that include hate speech, threats, or violence will be immediately removed, and the user may be banned from the platform.</p>

    <h2>3. Authentic News from VIP Accounts</h2>
    <p>Only verified VIP accounts can post authentic news. VIP accounts are trusted sources, and their posts will be considered official news for our platform.</p>

    <h2>4. Advertising on the Platform</h2>
    <p>If you wish to post advertisements for your products or services, please contact the admin. All advertisements must comply with our guidelines and will be reviewed before being published.</p>

    <h2>5. Consequences of Violating the Terms</h2>
    <p>Violating any of these terms may result in account suspension, removal of posts, or a permanent ban from the platform. Please use the platform responsibly.</p>

    <p>If you agree to these terms, you may proceed with using the platform. If you disagree, please refrain from using our services.</p><br>

    <p>Back to your profile</p>
    <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>.
</body>
</html>
