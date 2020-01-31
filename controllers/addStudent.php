<?php

session_start();

include "../models/connection.php";

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

$sql = "INSERT INTO students (student_id, fname, mname, lname, section, school_year, default_password) values ('".$studentId."','".$fname."','".$mname."','".$lname."','".$section."','".$schoolYear."','".$defaultPassword."')";

$result = $conn->query($sql);

header("Location: ../index.php#students");
?>