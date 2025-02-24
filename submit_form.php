<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO contact_us (first_name, last_name, phone_number, email) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared correctly
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }

    $stmt->bind_param("ssis", $first_name, $last_name, $phone_number, $email);

    // Execute the query
    if ($stmt->execute()) {
        echo "Your information has been submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Please submit the form.";
}
?>
