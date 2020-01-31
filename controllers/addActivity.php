<?php

session_start();

include "../models/connection.php";

if(isset($_FILES['activityFile'])){
	$errors = array();

	$file_size = $_FILES['activityFile']['size'];
	$file_tmp = $_FILES['activityFile']['tmp_name'];
	$file_type = $_FILES['activityFile']['type'];
	$exploded = explode('.', $_FILES['activityFile']['name']);
	$file_ext = strtolower(end($exploded));
	$file_name = time().".".$file_ext;

	move_uploaded_file($file_tmp, "../activities/".$file_name);
}

$activityName = $_POST['activityName'];
$activityDescription = $_POST['activityDescription'];
$subjectId = $_POST['subjectId'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO activities (subject_id, activity_description, activity_name, file_name) values ('1','".$activityDescription."','".$activityName."', '".$file_name."')";

$result = $conn->query($sql);

header("Location: ../index.php");
?>