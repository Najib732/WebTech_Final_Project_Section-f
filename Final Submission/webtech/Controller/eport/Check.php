<?php
// session_start();
// Include the database connection
require_once('../../Model/Database/connection.php');

// Get the 'final' parameter sent via AJAX
$data = $_REQUEST['final'] ?? null;


if ($data) {
    // Decode the JSON data into an associative array
    $finaldata = json_decode($data, true);

    // Retrieve values from the decoded data
    $name = $finaldata['name'] ?? null;
    $email = $finaldata['email'] ?? null;
    $report = $finaldata['report'] ?? null;

    var_dump($name.$email.$report);
    // Check if the fields are not empty
    if (!empty($name) && !empty($email) && !empty($report)) {
        // Establish a database connection
        $con = getConnection();

        // Prepare the SQL query to insert the report data
        $sql = "INSERT INTO report (user_name, email, report) VALUES ('$name', '$email', '$report')";

        // Execute the query
        $result = mysqli_query($con, $sql);

      
        if ($result) {
            echo "successfull";
        } else {
            echo "Failed to submit report.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "No data received.";
}
?>
