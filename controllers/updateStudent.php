<?php

session_start();

include "../models/connection.php";

$id = $_POST['id'];
$studentId = $_POST['studentId'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$section = $_POST['section'];
$schoolYear = $_POST['schoolYear'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$defaultPassword = mt_rand(100000, 999999);

$sql = "UPDATE students set student_id = '".$studentId."', fname = '".$fname."', mname='".$mname."', lname='".$lname."', section='".$section."', school_year='".$schoolYear."' WHERE id='".$id."'";

$result = $conn->query($sql);

header("Location: ../index.php#students");
?>