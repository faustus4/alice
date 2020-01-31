<?php

session_start();

include "../models/connection.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$activityName = $_POST['activityName'];
$activityDescription = $_POST['activityDescription'];
$activityId = $_POST['activityId'];

if(isset($_FILES['activityFile'])){
	$errors = array();

	$file_size = $_FILES['activityFile']['size'];
	$file_tmp = $_FILES['activityFile']['tmp_name'];
	$file_type = $_FILES['activityFile']['type'];
	$exploded = explode('.', $_FILES['activityFile']['name']);
	$file_ext = strtolower(end($exploded));
	$file_name = time().".".$file_ext;
	
	if ($file_size == 0){
		$getOldValue = "SELECT file_name from activities where activity_id = '".$activityId."'";
		$queryOldValue =  $conn->query($getOldValue);

		if ($queryOldValue->num_rows > 0) {
			while($row= mysqli_fetch_assoc($queryOldValue)){
				$file_name = $row["file_name"];
			}
		}
	} else {
		move_uploaded_file($file_tmp, "../activities/".$file_name);
	}
}

$sql = @"UPDATE activities set 
		activity_description = '".$activityDescription."', 
		activity_name = '".$activityName."', 
		file_name = '".$file_name."' 
		where activity_id = '".$activityId."'";

$result = $conn->query($sql);

header("Location: ../index.php");
?>