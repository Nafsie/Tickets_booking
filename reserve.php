<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include('db_connect.php');

// Function to send email
function sendEmail($Name, $ticket_type, $email, $num_tickets, $conn) {
    
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'eileenafula@gmail.com'; 
        $mail->Password = 'qaeb auvo svob covu'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 

        // Recipients
        $mail->setFrom('eileenafula@gmail.com', 'Online Tickets');
        $mail->addAddress($email);
        $mail->Subject = "Reservation Confirmation for $Name";
        $mail->Body = "Thank you for your reservation. Details:\n\nEvent: $Name\nTicket Type: $ticket_type\nNumber of Tickets: $num_tickets";

       
        if ($mail->send()) {
            echo "Reservation successful. Confirmation email sent to $email.";
        } else {
            // Handle SMTP connection error
            if ($mail->ErrorInfo == 'SMTP connect() failed.') {
                echo 'Error sending email: Unable to connect to the internet. Please check your internet connection.';
            } else {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        }

        echo "<a href='./index.php?page=home'>Back to Home</a>";
    } catch (Exception $e) {
        echo "Error sending email: {$e->getMessage()}";
    }
}

// Check if form submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Name = $_POST['Name'];
    $ticket_type = $_POST['ticket_type'];
    $email = $_POST['email'];
    $num_tickets = $_POST['num_tickets'];

    // Insert reservation into the database
    $sql = "INSERT INTO reservations (Name, ticket_type, email, num_tickets) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $Name, $ticket_type, $email, $num_tickets);
    if ($stmt->execute()) {
        // Reservation successful, send confirmation email
        sendEmail($Name, $ticket_type, $email, $num_tickets, $conn);
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close(); // Close database connection
?>
