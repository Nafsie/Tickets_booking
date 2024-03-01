<?php
include 'db_connect.php'; // Include your database connection file

// Check if event Name is provided in the URL
if(isset($_GET['Name'])) {
    $Name = $_GET['Name']; // Get the event name from the URL
    
    // Prepare and execute the SQL statement to delete the event
    $sql = "DELETE FROM events WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Name);
    
    if ($stmt->execute()) {
        // Event deletion successful
        echo json_encode(array("status" => "success", "message" => "Event $Name deleted successfully."));
    } else {
        // Error occurred during event deletion
        echo json_encode(array("status" => "error", "message" => "Event Not found."));
    }
} else {
    // Event Name not provided in the URL
    echo json_encode(array("status" => "error", "message" => "Event Name not provided in the URL."));
}

$conn->close(); // Close database connection
?>
