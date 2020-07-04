<?php

session_start();

include "../models/connection.php";

if(isset($_FILES['lessonFile'])){
	$errors = array();

	$file_size = $_FILES['lessonFile']['size'];
	$file_tmp = $_FILES['lessonFile']['tmp_name'];
	$file_type = $_FILES['lessonFile']['type'];
	$exploded = explode('.', $_FILES['lessonFile']['name']);
	$file_ext = strtolower(end($exploded));
	$file_name = time().".".$file_ext;

	move_uploaded_file($file_tmp, "../lessons/".$file_name);
}

$lessonName = $_POST['lessonName'];
$lessonDescription = $_POST['lessonDescription'];
$lessonYoutubeLink = $_POST['lessonYoutubeLink'];
$subjectId = $_POST['subjectId'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO lessons (subject_id, lesson_description, lesson_name, file_name, youtube_link) values ('".$subjectId."','".$lessonDescription."','".$lessonName."', '".$file_name."','".$lessonYoutubeLink."')";

$result = $conn->query($sql);

header("Location: ../index.php");
?>