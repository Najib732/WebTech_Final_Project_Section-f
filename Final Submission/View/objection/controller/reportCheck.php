<?php
//session_start();
require_once('../model/sql.php');

if (!empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['report'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $report = $_REQUEST['report'];

    $con = getConnection();
    $sql = "INSERT INTO report (name, email, report) VALUES ('$name', '$email', '$report')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo ""; 
    } else {
        echo "Failed to submit report.";
    }
} else {
    echo "All fields are required.";
}

?>
