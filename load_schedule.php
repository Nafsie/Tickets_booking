<?php
include 'db_connect.php';

// SQL query to retrieve data from the events table
$qry = $conn->query("SELECT Name, Date, Time, Location, VIP, Regular, Max_Attendees FROM events ORDER BY Date ASC");

$data = array();

while($row = $qry->fetch_assoc()) {
    // Transformations or additional processing can be performed here if needed
    $data[] = $row;
}

echo json_encode($data);
?>
