<?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM quizzes";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){
		array_push($response, array(
			"quizId" => $row["quiz_id"],
			"subjectId" => $row["subject_id"],
			"questionItems" => $row["question_items"],
			"quizName" => $row["quiz_name"],
			"dateUpdated" => $row["date_updated"]
		));
	}
} else {
	
}

echo json_encode($response);

?>