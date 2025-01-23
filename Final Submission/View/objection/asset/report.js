document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Stop page reload

    const formData = new FormData(this); // Collect form data

    fetch("../controller/reportCheck.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.text())
        .then((message) => {
            alert(message.trim() === "" ? "Report submitted successfully!" : message);
        })
        .catch(() => {
            alert("Something went wrong. Please try again.");
        });
});
