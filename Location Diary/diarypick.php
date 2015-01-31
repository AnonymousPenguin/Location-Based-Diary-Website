<?php

	session_start();
	
	include("connection.php");

	$_SESSION['diarynumber'] = $_POST['diarynum'];
	 	
	$currentuser = "user".$_SESSION['id'];
	 	
	$query="SELECT * FROM `$currentuser` WHERE diaryID = '".$_SESSION['diarynumber']."' LIMIT 1";

	$result = mysqli_query($link, $query);
	 	
	$row = mysqli_fetch_array($result);
	
	echo json_encode($row);

?>