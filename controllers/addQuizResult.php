<?php

session_start();

include "../models/connection.php";

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$quizId = $input["quizId"];
$subjectId = $input["subjectId"];
$studentId = $input["studentId"];
$answers = json_encode($input["answers"]);
$scores = json_encode($input["scores"]);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// check for duplicate

$sqlDup = "SELECT * from quiz_results where quiz_id = '".$quizId."' and student_id = '".$studentId."'";
$checkDup = $conn->query($sqlDup);

if ($checkDup->num_rows > 0) {

} else {
	$sql = "INSERT INTO quiz_results (quiz_id, subject_id, student_id, answers, score) values ('".$quizId."','".$subjectId."','".$studentId."','".$answers."','".$scores."')";
	$result = $conn->query($sql);
}




echo($sql)

?>