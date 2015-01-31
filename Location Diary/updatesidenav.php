<?php 

	session_start();

	include("connection.php");

    $selectuser = "user".$_SESSION['id'];
    
	$resultnav = mysqli_query($link, "SELECT diarytitle, diaryID FROM `$selectuser` ORDER BY `diaryID` DESC;");
	
	$outlist .= '<ul style="list-style-type: none; margin-left: 0px; padding: 0px;" class="navList">';
	
	while ($rownav = mysqli_fetch_array($resultnav)){
		$rowid = "".$rownav['diaryID'];
		$outlist .= "<li><p style='color: white;' class='diaryentries handhover' onClick='row_click(this.id)' id='$rowid'>".htmlspecialchars($rownav['diarytitle'])."</p></li>";
		}
	
	$outlist .= '</ul>';
	
	echo $outlist;
	
?>