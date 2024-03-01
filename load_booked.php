<?php 
include 'db_connect.php';
$query = $conn->query("SELECT * from reservations ");
$data = array();
while($row = $query->fetch_assoc()){
	$data[] = $row;
}
echo json_encode($data);

?>