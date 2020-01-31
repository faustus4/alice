<?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){
		array_push($response, array(
			"id" => $row["id"],
			"learningArea" => $row["learning_area"],
			"name" => $row["name"]
		));
	}
} else {
	
}

echo json_encode($response);

?>