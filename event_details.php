<?php
include('db_connect.php'); // Include your database connection file

// Function to validate ticket count (not more than 5)
function validateTicketCount($ticketCount) {
    return $ticketCount >= 1 && $ticketCount <= 5;
}

// Check if eventName is provided in the URL
if(isset($_GET['Name'])) {
    $eventName = $_GET['Name'];
    
    // Fetch event details from the database
    $sql = "SELECT * FROM events WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $eventName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Event found, fetch details
        $row = $result->fetch_assoc();
        $Name = $row['Name'];
        $Date = $row['Date'];
        $Time = $row['Time'];
        $Location = $row['Location'];
        $VIP = $row['VIP'];
        $Regular = $row['Regular'];
        $Max_Attendees = $row['Max_Attendees'];
        

        // Display event details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Event Details</title>
            <link rel="stylesheet" href="styles.css"> 
        </head>
        <body>
            <div class="background">
                <div class="container">
                    <h1>Event Details</h1>
                    <div class="event-details">
                        <div class="detail">
                            <strong>Name:</strong> <?php echo $Name; ?>
                        </div>
                        <div class="detail">
                            <strong>Date:</strong> <?php echo $Date; ?>
                        </div>
                        <div class="detail">
                            <strong>Time:</strong> <?php echo $Time; ?>
                        </div>
                        <div class="detail">
                            <strong>Location:</strong> <?php echo $Location; ?>
                        </div>
                        <div class="detail">
                            <strong>VIP Price:</strong> <?php echo $VIP; ?>
                        </div>
                        <div class="detail">
                            <strong>Regular Price:</strong> <?php echo $Regular; ?>
                        </div>
                        <div class="detail">
                            <strong>Max Attendees:</strong> <?php echo $Max_Attendees; ?>
                        </div>
                    </div>
                    
                    <!-- Reservation form -->
                    <div class="detail">

                        <h2>Reserve Tickets</h2>
                    
                        <form action="reserve.php" method="post">
                       
                        
                            <input type="hidden" name="Name" value="<?php echo $Name; ?>">
                            <div class="details">

			                    <label for="email">Email</label>
			                    <input type="email" id="email" name="email" required>
		                    </div>  
                            <div class="details">
                                
                                <label for="ticket_type">Ticket Type:</label>
                                <select id="ticket_type" name="ticket_type" required>
                                    <option value="VIP">VIP</option>
                                    <option value="Regular">Regular</option>

                                </select>
                            </div>
                            <div class="details">
                                <label for="num_tickets">Number of Tickets (max 5):</label>
                                <input type="number" id="num_tickets" name="num_tickets" min="1" max="5" required>
                            </div>
                            <button type="submit">Reserve Tickets</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Event not found.";
    }
} else {
    echo "Invalid event name.";
}

$conn->close(); // Close database connection
?>
