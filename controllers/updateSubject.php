<?php

session_start();

include "../models/connection.php";

$subjectId = $_POST['subjectId'];
$learningArea = $_POST['learningAreaId'];
$subjectName = $_POST['subjectName'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE subjects set name = '".$subjectName."', learning_area = '".$learningArea."' WHERE id='".$subjectId."'";

echo($sql);

$result = $conn->query($sql);

header("Location: ../index.php");
?>