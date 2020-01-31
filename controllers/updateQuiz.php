<?php

session_start();

include "../models/connection.php";

$quizId = isset($_POST['quizId']) ?$_POST['quizId'] : "";
$quizName = isset($_POST['quizName']) ?$_POST['quizName'] : "";
$quizItems = isset($_POST['quizItems']) ?$_POST['quizItems'] : "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE quizzes set quiz_name='".$quizName."', question_items='".$quizItems."' where quiz_id = ".$quizId."";

$result = $conn->query($sql);

header("Location: ../index.php#quiz");
?>