<?php

session_start();

include "../models/connection.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$lessonName = $_POST['lessonName'];
$lessonDescription = $_POST['lessonDescription'];
$lessonId = $_POST['lessonId'];

if(isset($_FILES['lessonFile'])){
	$errors = array();

	$file_size = $_FILES['lessonFile']['size'];
	$file_tmp = $_FILES['lessonFile']['tmp_name'];
	$file_type = $_FILES['lessonFile']['type'];
	$exploded = explode('.', $_FILES['lessonFile']['name']);
	$file_ext = strtolower(end($exploded));
	$file_name = time().".".$file_ext;
	
	if ($file_size == 0){
		$getOldValue = "SELECT file_name from lessons where lesson_id = '".$lessonId."'";
		$queryOldValue =  $conn->query($getOldValue);

		if ($queryOldValue->num_rows > 0) {
			while($row= mysqli_fetch_assoc($queryOldValue)){
				$file_name = $row["file_name"];
			}
		}
	} else {
		move_uploaded_file($file_tmp, "../lessons/".$file_name);
	}
}

$sql = @"UPDATE lessons set 
		lesson_description = '".$lessonDescription."', 
		lesson_name = '".$lessonName."', 
		file_name = '".$file_name."' 
		where lesson_id = '".$lessonId."'";

$result = $conn->query($sql);

header("Location: ../index.php");
?>