<?php

session_start();

include "../models/connection.php";

$quizName = isset($_POST['quizName']) ?$_POST['quizName'] : "";
$quizItems = isset($_POST['quizItems']) ?$_POST['quizItems'] : "";
$subjectId = $_POST['subjectId']!="" ?$_POST['subjectId'] : "1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO quizzes (subject_id, quiz_name,question_items) values ('".$subjectId."','".$quizName."','".$quizItems."')";

$result = $conn->query($sql);

header("Location: ../index.php#quiz");
?>