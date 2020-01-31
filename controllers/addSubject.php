<?php

session_start();

include "../models/connection.php";


$subjectName = $_POST['subjectName'];
$learningAreaId = $_POST['learningAreaId'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO subjects (learning_area, name) values ('".$learningAreaId."','".$subjectName."')";

$result = $conn->query($sql);

header("Location: ../index.php");
?>