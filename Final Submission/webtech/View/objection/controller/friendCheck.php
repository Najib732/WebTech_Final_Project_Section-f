<?php 
require_once('../model/sql.php');

if (isset($_POST['friendid'])) {
    
    $con = getConnection();  

    $friendid = $_POST['friendid'];  
    $userid = $_SESSION['userid'];  

    $sql = "DELETE FROM friendlist WHERE userid='$userid' AND friendid='$friendid'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        header('Location: ../view/friend.php');
    } else {
        header('Location: ../view/userprofile.php');
    }
    exit;
}
?>


