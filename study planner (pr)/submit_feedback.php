<?php
// Database connection (update with your credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];
    $course = $_POST['course'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, rating, comments, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $rating, $comments, $course);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
