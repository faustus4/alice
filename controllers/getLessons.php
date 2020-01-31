<?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$subjectId = $_GET["subjectId"];

$sql = "SELECT * FROM lessons WHERE subject_id = ".$subjectId;


$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){
		array_push($response, array(
			"lessonId" => $row["lesson_id"],
			"subjectId" => $row["subject_id"],
			"lessonDescription" => $row["lesson_description"],
			"lessonName" => $row["lesson_name"],
			"fileName" => $row["file_name"],
			"dateUpdated" => $row["date_updated"]
		));
	}
} else {
	
}

echo json_encode($response);

?>