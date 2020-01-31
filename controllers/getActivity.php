<?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$subjectId = $_GET['subjectId'];

$sql = "SELECT * FROM activities where subject_id = ".$subjectId;


$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){
		array_push($response, array(
			"activityId" => $row["activity_id"],
			"subjectId" => $row["subject_id"],
			"activityDescription" => $row["activity_description"],
			"activityName" => $row["activity_name"],
			"fileName" => $row["file_name"],
			"dateUpdated" => $row["date_updated"]
		));
	}
} else {
	
}

echo json_encode($response);

?>