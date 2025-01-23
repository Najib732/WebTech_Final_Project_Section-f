<?php
session_start();
$id = $_SESSION['userid'] ?? null;



function saveReport($name, $email, $report)
{
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS count FROM report WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ((int)$row['count'] > 0) {
        return false;
    }

    $sql = "INSERT INTO report (name, email, report) VALUES ('$name', '$email', '$report')";
    return mysqli_query($con, $sql);
}




