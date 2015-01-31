<?php

	session_start();
	 	
	include("connection.php");

	$currentuser = "user".$_SESSION['id'];
	
	$currentdiary = $_SESSION['diarynumber'];
	
	if ($_POST['diaryadddrop'] == "add") {
		$query = "INSERT INTO `$currentuser` (date, weekdate, time, diarytitle)
			VALUES ('".$_POST['ddate']."','".$_POST['dweekday']."','".$_POST['dtimehms']."','"."new diary title"."');";
		mysqli_query($link, $query);	
		$_SESSION['diarynumber']=mysqli_insert_id($link);                    // update the diarynumber to edit the new entry
		
		if ($_POST['gps']) {                            //  IF we have location data then add location data
					$placegps = $_POST['gps'];
					$query2 = "UPDATE `$currentuser` SET location = '$placegps' WHERE diaryID = '".$_SESSION['diarynumber']."' LIMIT 1";
					mysqli_query($link, $query2);
				}
		
		}
		
	if ($_POST['diaryadddrop'] == "drop") {
		$query = "DELETE FROM `$currentuser` WHERE diaryID='$currentdiary' LIMIT 1";
		mysqli_query($link, $query);

		// Now we select the newest diary entry after the delete (the newest entry that was there before this deleted one)

		$query2="SELECT * FROM `$currentuser` ORDER BY `diaryID` DESC LIMIT 1";

		$result = mysqli_query($link, $query2);
	 	
		$row = mysqli_fetch_array($result);
	
		$_SESSION['diarynumber'] = $row['diaryID'];
		
		}
		
	$latest = $_SESSION['diarynumber'];   // We need to pass on the id of the latest diary entry
	
	echo $latest;
		
?>