<?php

session_start();

include "../models/connection.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "";

if($_SESSION["userType"]=="student") {
	$newPassword = $_POST['newPassword'];

	$sql = "UPDATE students set password = '".$newPassword."' where id = '".$_SESSION["studentId"]."'";
} else {
	$newPassword = $_POST['newPassword'];

	$sql = "UPDATE users set password = '".$newPassword."' where username = 'admin'";
}

echo($sql);


$result = $conn->query($sql);

header("Location: logout.php");
?>