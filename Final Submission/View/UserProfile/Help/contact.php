<html>
<head>
    <title>Report</title>
</head>
<body>
    <h1>Reported Problems</h1>

    <p>If you have any other problem, you can report it here by filling up this form.</p>

    <form id="reportForm"> 
        Name: <input id="name" type="text" name="name"><br><br>

        Email: <input id="email" type="email" name="email"><br><br>

        What is your question? 
        <textarea id="report" name="report"></textarea><br><br>

        <button type="submit" name="submit">Submit</button><br>

        <p>Back to your profile</p>
        <a href="userprofile.php?id=<?php echo $id; ?>">Profile</a>
    </form>

    <script>
      
        document.getElementById('reportForm').addEventListener('submit', function(event) {
           
            event.preventDefault();

            // Collect form data
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let report = document.getElementById('report').value.trim();

           
            if (!name || !email || !report) {
                alert("Please fill out all fields.");
                return;
            }

           
            let data = {
                name: name,
                email: email,
                report: report
            };

          
            let jsonData = JSON.stringify(data);

      
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../../../Controller/eport/Check.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

          
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    if (xhttp.responseText === "successfull") {
                        location.reload();
                    } else {
                        location.reload();
                    }
                }
            };

            // Send data to the server
            xhttp.send("final=" + encodeURIComponent(jsonData));
        });
    </script>

</body>
</html>
