<?php

session_start();

include "../models/connection.php";


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	
	$newMysql = new mysqli($servername, $username, $password);

	$commands = file_get_contents("../alice.sql");

	$newMysql->multi_query($commands);

    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users where username='".$input["username"]."' and password='".$input["password"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$_SESSION["authorized"]=true;
	$_SESSION["userType"]="admin";
	$_SESSION["password"]=$input["password"];
    echo "1";
} else {

	$sql2 =  "SELECT * FROM students where student_id='".$input["username"]."' and (password='".$input["password"]."' || default_password='".$input["password"]."') ";

	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {
		$_SESSION["authorized"]=true;
		$_SESSION["userType"]="student";
		$isPasswordEmpty = true;

		while($row= mysqli_fetch_assoc($result2)){
			$_SESSION["studentId"] = $row["id"];
			$_SESSION["fname"] = $row["fname"];
			$_SESSION["password"]=$input["password"];
		}
	    echo "1";
	} else {
		$_SESSION["authorized"]=false;
    	echo "2";
	}
}

?>