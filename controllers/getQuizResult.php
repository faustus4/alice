 <?php

session_start();

include "../models/connection.php";

$response = array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$subjectId = $_GET["subjectId"];

$sql = @"SELECT * FROM quiz_results qr 
	INNER JOIN students st on st.id = qr.student_id
	INNER JOIN quizzes q on q.quiz_id = qr.quiz_id
	WHERE qr.subject_id =".$subjectId;


if(isset($_SESSION["studentId"])){
  $sql = @"SELECT * FROM quiz_results qr 
	INNER JOIN students st on st.id = qr.student_id
	INNER JOIN quizzes q on q.quiz_id = qr.quiz_id
	WHERE qr.subject_id =".$subjectId." AND qr.student_id =".$_SESSION["studentId"];
}




$result = $conn->query($sql);


if ($result->num_rows > 0) {
	while($row= mysqli_fetch_assoc($result)){

		$correctAnswers = json_decode($row["score"]);
		$correctAnswersCount = 0;

		if(in_array("1", $correctAnswers)) {
			$correctAnswersCount = array_count_values($correctAnswers)["1"];
		}

		array_push($response, array(
			"quizId" => $row["quiz_id"],
			"quizName" => $row["quiz_name"],
			"studentName" => $row["fname"]." ".$row["mname"]." ".$row["lname"],
			"numberOfItems" => count($correctAnswers),
			"numberOfCorrect" => $correctAnswersCount,
			"questionItems" => $row["question_items"],
			"answers" => $row["answers"],
			"scores" => $row["score"],
			"section" => $row["section"],
			"schoolYear" => $row["school_year"],
			"dateUpdated" => $row["date_updated"]
		));


	}
} else {
	
}

echo json_encode($response);

?>