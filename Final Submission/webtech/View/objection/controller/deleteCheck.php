<?php
require_once('../model/sql.php');


if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email']; 

    $con = getConnection();

   
    $sql = "DELETE FROM userdata WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_affected_rows($con) > 0) {
      
        session_destroy();


        echo "Account deleted successfully! ";
        
    } else {header('location: ../view/login.html');
        
        echo "Account deleted successfully! ";
    }
} else {
    echo "Please provide a valid email address.";
}
?>
