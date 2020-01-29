<?php

session_start();

include "../models/connection.php";


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM users where username='".$input["username"]."' and password='".$input["password"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$_SESSION["authorized"]=true;
    echo "1";
} else {
	$_SESSION["authorized"]=false;
    echo "2";
}

?>