<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the form is submitted via POST method, process the form data
    $oldName = $_POST['oldName']; // The original name of the event
    $newName = $_POST['Name']; // The updated name of the event (if changed)
    $newDate = $_POST['Date']; // The updated date of the event
    $newTime = $_POST['Time']; // The updated time of the event
    $newMaxAttendees = $_POST['Max_Attendees']; // The updated max attendees of the event
    $newLocation = $_POST['Location']; // The updated location of the event
    $newVIPPrice = $_POST['VIP']; // The updated VIP price of the event
    $newRegularPrice = $_POST['Regular']; // The updated regular price of the event
    // You can add more fields as needed

    // Prepare and execute the SQL statement to update the event details
    $sql = "UPDATE events SET Name = ?, Date = ?, Time = ?, Max_Attendees = ?, Location = ?, VIP = ?, Regular = ? WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisiss", $newName, $newDate, $newTime, $newMaxAttendees, $newLocation, $newVIPPrice, $newRegularPrice, $oldName);

    if ($stmt->execute()) {
        // Event updated successfully
        echo "Event updated successfully.";
        header("Location: index.php?page=home");
    } else {
        // Error occurred while updating event
        echo "Error: " . $conn->error;
    }

    $stmt->close();
} else {
    // If the form is not submitted via POST method, display the HTML form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Event</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
            // Retrieve existing event details if provided in the URL
            $oldName = isset($_GET['Name']) ? $_GET['Name'] : '';
            $sql = "SELECT * FROM events WHERE Name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $oldName);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <center>
        <div class="wrapper">
        <div class="input-box">
        <input type="hidden" name="oldName" value="<?php echo $row['Name']; ?>">
        <label for="Name">Event Name:</label>
        <input type="text" name="Name" id="Name" value="<?php echo $row['Name']; ?>" required><br>
        </div>
        <div class="input-box">


        <label for="Date">Date:</label>
        <input type="date" name="Date" id="Date" value="<?php echo $row['Date']; ?>" required><br>
        </div>
        <div class="input-box">
        <label for="Time">Time:</label>
        <input type="time" name="Time" id="Time" value="<?php echo $row['Time']; ?>" required><br>
        </div>
        <div class="input-box">
        <label for="Max_Attendees">Max Attendees:</label>
        <input type="number" name="Max_Attendees" id="Max_Attendees" value="<?php echo $row['Max_Attendees']; ?>" required><br>
        </div>
        <div class="input-box">
        <label for="Location">Location:</label>
        <input type="text" name="Location" id="Location" value="<?php echo $row['Location']; ?>" required><br>
        </div>
        <div class="input-box">
        <label for="VIP">VIP Price:</label>
        <input type="number" name="VIP" id="VIP" value="<?php echo $row['VIP']; ?>" required><br>
        </div>
        <div class="input-box">
        <label for="Regular">Regular Price:</label>
        <input type="number" name="Regular" id="Regular" value="<?php echo $row['Regular']; ?>" required><br>
        </div>
        <!-- Add more fields here as needed -->

        <input type="submit" value="Update">
        <?php
            } else {
                echo "Event not found.";
            }
            $stmt->close();
        ?>
    </form>
        </div>
    </center>
</body>
</html>
<?php
}

$conn->close(); // Close database connection
?>
