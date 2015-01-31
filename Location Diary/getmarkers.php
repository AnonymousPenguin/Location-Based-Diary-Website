<?php

	session_start();
	
	include("connection.php");

	$currentuser = "user".$_SESSION['id'];
	
	$query="SELECT date, diarytitle, location, diaryID FROM `$currentuser` ";

	$result = mysqli_query($link, $query);
	 	
	$all = array();           // multidimentional array $all holds each $row array, we json encode $all to get multidimentional json array data
	
	while($row = mysqli_fetch_assoc($result)) {
   			$all[] = $row;
		}
	
	$out .= json_encode($all);
	
	echo $out;
	
?>