<?php
// require_once('../Database/connection.php');

function getConnection()
{
    $con = mysqli_connect('127.0.0.1', 'root', '', 'webtech');
    return $con;
}

function login($email, $password)
{
    $con = getConnection();
    $sql = "SELECT id FROM  userdata WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return false;
    }
}


function autogenerateId()
{

    return rand(100000, 999999);
}


function countEmails($email) {
    $con = getConnection();
    $stmt = $con->prepare("SELECT COUNT(*) AS email_count FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['email_count']; 
}



function addUser($name, $password, $email, $dob)
{
    $id = autogenerateId(); // Ensure this function generates a valid unique ID
    $con = getConnection();

    // Use prepared statements for safety
    $stmt = $con->prepare("INSERT INTO userdata (id, name, password, email, dob) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters: 's' indicates string data type
    $stmt->bind_param("sssss", $id, $name, $password, $email, $dob);

    // Execute the query
    $result = $stmt->execute();

    // Check the result and return true or false
    if ($result) {
        return true;
    } else {
        // Debugging the error if needed
        error_log("Error inserting user: " . $stmt->error);
        return false;
    }
}


?>