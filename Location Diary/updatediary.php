<?php

	session_start();

	include("connection.php");
	
	$userselect = "user".$_SESSION['id'];
	
	if ($_POST['diaryedit'] == "text") {
		$query = "UPDATE `$userselect` SET diarytext='".mysqli_real_escape_string($link, $_POST['diary'])."' WHERE
			diaryID = '".$_SESSION['diarynumber']."' LIMIT 1";
		}
	
	if ($_POST['diaryedit'] == "title") {
		$query = "UPDATE `$userselect` SET diarytitle='".mysqli_real_escape_string($link, $_POST['diarytitletext'])."' WHERE
			diaryID = '".$_SESSION['diarynumber']."' LIMIT 1";
		}
		
	mysqli_query($link, $query);
	
	$query2="SELECT * FROM `$userselect` WHERE diaryID = '".$_SESSION['diarynumber']."' LIMIT 1";

	$result = mysqli_query($link, $query2);
	 	
	$row = mysqli_fetch_array($result);
	
	echo json_encode($row);
	
?>