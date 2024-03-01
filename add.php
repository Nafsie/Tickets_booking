<?php
// Include database connection file
include 'db_connect.php';
include 'admin_navbar.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventName = $_POST['Name'];
    $eventDate = $_POST['Date'];
    $eventTime = $_POST['Time'];
    $maxAttendees = $_POST['Max_Attendees'];
    $location = $_POST['Location'];
    $vipPrice = $_POST['VIP'];
    $regularPrice = $_POST['Regular'];
    

    // SQL query to insert event data into events table
    $sql = "INSERT INTO events (Name, Date, Time, Max_Attendees, Location, VIP, Regular) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissi", $eventName, $eventDate, $eventTime, $maxAttendees, $location, $vipPrice, $regularPrice);

    // Execute query
    if ($stmt->execute()) {
        // Event added successfully
        echo "Event added successfully.";
        header("Location: index.php?page=home");
    } else {
        // Error occurred while adding event
        echo "Error: " . $conn->error;
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted via POST method, redirect back to the form page
    echo "Event not added";
    header("Location: add_event.html");
    exit;
}
?>
