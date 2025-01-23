<?php
session_start();
require_once('../../Model/sql.php');
?>

<html>
<head>
    <title>Report Post</title>
    <script>
        function submitReport(event) {
            event.preventDefault(); // Prevent the default form submission

           
            const form = event.target;
            const formData = new FormData(form);

            // Convert form data to an object for sending via AJAX
            const data = {
                report: formData.get('report'),
                textreport: formData.get('textreport'),
                post_id: formData.get('post_id')
            };

            // Create an XMLHttpRequest
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../../Controller/Post/ReportCheck.php', true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhttp.onload = function () {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);

                        if (response.success) {
                            alert('Report submitted successfully.');
                            window.location.href = '../../View/Welcome/dashboard.php'; 
                        } else {
                            alert('Error: ' + response.message);
                        }
                    } catch (error) {
                        alert('An error occurred while processing the response.');
                        console.error('Error parsing response:', error);
                    }
                } else {
                    alert('An error occurred during the request.');
                }
            };

            xhttp.onerror = function () {
                alert('A network error occurred.');
            };

            // Send the request
            const postData = `mydata=${encodeURIComponent(JSON.stringify(data))}`;
            xhttp.send(postData);
        }
    </script>
</head>
<body>
    <h1>Report Post</h1>

    <form id="reportForm" onsubmit="submitReport(event)">
        <label>
            <input type="radio" name="report" value="Sexual activities" required> Sexual Activities
        </label><br>
        <label>
            <input type="radio" name="report" value="Harassment"> Harassment
        </label><br>
        <label>
            <input type="radio" name="report" value="Fake info"> Fake Info
        </label><br>
        <textarea name="textreport" placeholder="Add additional details (optional)"></textarea><br>

        <input type="hidden" name="post_id" value="<?php $_REQUEST['post_id']; ?>">
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
