<?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM students";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){
		array_push($response, array(
			"studentId" => $row["student_id"],
			"fname" => $row["fname"],
			"mname" => $row["mname"],
			"lname" => $row["lname"],
			"section" => $row["section"],
			"schoolYear" => $row["school_year"],
			"defaultPassword" => $row["default_password"],
			"id" => $row["id"]
		));
	}
} else {
	
}

echo json_encode($response);

?>