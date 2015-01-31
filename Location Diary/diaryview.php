<?php

	session_start();
	 	
	include("connection.php");
	 	
	$currentuser = "user".$_SESSION['id'];
	
	if(!$_SESSION['diarynumber']) {
	
		$query="SELECT * FROM `$currentuser` ORDER BY `diaryID` DESC LIMIT 1";

		$result = mysqli_query($link, $query);
	 	
		$row = mysqli_fetch_array($result);
	
		$_SESSION['diarynumber'] = $row['diaryID'];
		
		}
	 
	 $query2 = "SELECT COUNT(*) FROM `$currentuser`";
	 
	 $result2 = mysqli_query($link, $query2);
	 
	 $row2 = mysqli_fetch_array($result2);
	 
	 $num = $row2['0'];
	 	
?>

<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Secret Diary</title> <!-- Bootstrap -->
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media
queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></
script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/
respond.min.js"></script>
 <![endif]-->

 <style>

 .navbar-brand {
 	 	 font-size:1.8em;
 }
 body {
    	 background-image: url("backgroundmain.jpg");
    	 background-repeat: no-repeat;
    	 background-attachment: fixed;
    	 background-size: cover;
 }
 #topContainer {
 		 margin-top:40px;
 	 	 height:400px;
 	 	 width:100%;
 	 	 background-size:cover;
 	 	 }
 #sidenav {
    	 padding-top:20px;
    	 padding-bottom:10px;
 }

 p {
    	 border:1px solid white;
    	 padding:2px;
 }

 .optextarea {
 		 color: white;
 		 background-color:rgba(0,0,0,0.2);
 }

 .hiddenmessage {
    	 display:none;
 }
 
 #topRow {
 	 	 margin-top:20px; 	 	 
 	 	 text-align:center;
 }
 	 	
 #topRow h1 {
 	 	 font-size:300%;
 }
 
 #diarytextarea {
 		 margin-top:15px;
 		 margin-bottom:15px;
 }
 #mapdiv {
 		 margin-top:20px;
 }
 #ShowAddress {
    	 margin-bottom:15px; 
 }
 #ShowInfo {
    	 margin-bottom:15px; 
 }
 
 #sidenavlist {
 		 overflow : auto;
 		 padding-top: 15px;
 		 margin-bottom: 15px;
 		 background-color:rgba(0,0,0,0.1);
 }

 .handhover {
 		 cursor: pointer;
 		 cursor: hand;
 }

 .InfoWindowStyle {
  	width: 120px;
	line-height: 1.35;
    height: 100%;
 }
 
 .navbutton {
 		 font-size:120%;
 }
 	 	
 .bold {
 	 	 font-weight:bold;
 }
 	 	
 .center {
 	 	 text-align:center;
 }
 	 	
 .title {
 	 	 margin-top:100px;
 	 	 font-size:300%;
 }
 #footer {
 	 	 background-color:#B0D1FB;
 	 	 padding-top:70px;
 	 	 width:100%;
 }
 	 	
 .marginBottom {
 	 	 margin-bottom:30px;
 }

 </style>
 </head>
 <body data-spy="scroll" data-target=".navbar-collapse">
 <div class="navbar navbar-default navbar-fixed-top">
 	<div class="container">
 		<div class="navbar-header">
 	 		<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
 	 	 		<span class="icon-bar"></span>
 	 	 	 	<span class="icon-bar"></span>
 	 	 	 	<span class="icon-bar"></span>
 	 	 	</button>
 	 	 		<a class="navbar-brand" id="tempclick">Location Diary</a>
 	 	</div>
 	 		<div class="collapse navbar-collapse">
 	 	 	 	<ul class="navbar-nav nav pull-right">
 	 	 	 	
		 			<!-- Large modal -->
					<li type="button" id="globalmap" class="navbutton" data-toggle="modal" data-target=".bs-example-modal-lg"><a class="handhover">Global Map View</a></li>
					  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="mapmodal">
  						<div class="modal-dialog modal-lg">
    					  <div class="modal-content">
      					  <a class="navbar-brand">Global Map</a>
      					  <ul class="navbar-nav nav pull-right">
 	 	 					<li class="navbutton" id="zoom_out"><a class="handhover">Zoom Out</a></li>
 	 	 					<li class="navbutton" id="closeglobalmap" data-dismiss="modal"><a class="handhover">Close Map</a></li> 	
 	 	 				  </ul> 	
      						<div id="LargeMap" style="width:100%;height:500px;" class="form-control"></div>
    					  </div>
  						</div>
					  </div>

 	 	 	 		<li class="navbutton" id="delete_button"><a class="handhover">Delete Diary Entry</a></li>
 	 	 	 	 	<li class="navbutton" id="logout_button"><a href="index.php?logout=1">Log Out</a></li> 	
 	 	 	 	</ul> 		 	 	 	
 	 	 	</div>
 		</div>
 	</div>

    <div class="container-fluid contentContainer" id="topContainer">
      <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 sidebar" id="sidenav">
          <input placeholder="Search Diary Title" id="searchbox" type="text" style="width:100%;" class="form-control optextarea"/>
        	<div class="diaryentries form-control optextarea handhover" id="addnewbutton" style="color: white; padding-left: 15px; margin-bottom: 3px; margin-top: 3px;">+ Add New</div>
          	<div id="sidenavlist" class="form-control">  

          	</div>		//  List of diary titles from database
          	<div id="error1" class="hiddenmessage alert alert-danger" >error</div>
 	 		<div id="message1" class="hiddenmessage alert alert-success" >message</div>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6" id="topRow">
         	<textarea id="diarytitlearea" rows="1" style="font-size:150%;" class="optextarea form-control"></textarea>
 	 	 	<textarea id="diarytextarea" class="form-control optextarea"></textarea>
		</div>
		 
		<div class="col-sm-6 col-sm-offset-3 col-md-3 col-md-offset-0 col-lg-3" id="mapdiv">
		 	<textarea id="ShowAddress" style="width:100%;" rows="1" class="form-control optextarea"></textarea>
		 	<textarea id="ShowInfo" style="width:100%;" rows="1" class="form-control optextarea"></textarea>
			<div id="googleMap" style="width:100%;height:485px;" class="form-control"></div> 	 
      	</div>
      </div>
    </div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as
 needed -->
 <script src="js/bootstrap.min.js"></script>
 <!-- Google Maps API -->
 <script src="http://maps.googleapis.com/maps/api/js"></script>

 <script>
 
 window.onload = function() {
 		updatetitles();
 		row_click(<?php echo $_SESSION['diarynumber']; ?>);     // "click" the newest diary entry
 		
 		var numrows = <?php echo $num; ?> ;
 		var tempheight = numrows*35+25;
 	 	if (tempheight > $(window).height()-275) tempheight = $(window).height()-275;
 	 	$('#sidenavlist').css('height', tempheight);
 };
 
 $('#searchbox').keyup(function(){
   var valThis = $(this).val().toLowerCase();
     $('.navList>li').each(function(){
     var text = $(this).text().toLowerCase();
       (text.indexOf(valThis) == 0) ? $(this).show() : $(this).hide();            
   });
 });
 
 $("#tempclick").click(function() {
 	var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
 	var d = new Date();
 	var x = d.getDay();
 	var month = d.getMonth()+1;
 	
 	var date = d.getFullYear()+"-"+month+"-"+d.getDate();
 	var weekday = days[x];
 	var timehms = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
 	
 	alert(date+" "+weekday+" "+timehms);
 });
 
 $(".contentContainer").css("min-height",$(window).height()-50);
 	 	
 $("#diarytextarea").css("height",$(window).height()-155);
  
 $("#googleMap").css("height",$(window).height()-193);
 
 $("#diarytextarea").keyup(function() {
 	 	$.post("updatediary.php", {diaryedit:"text", diary:$("#diarytextarea").val()} );
 });
 
 $("#diarytitlearea").keyup(function() {
 	 	$.post("updatediary.php", {diaryedit:"title", diarytitletext:$("#diarytitlearea").val()},
 	 		function(datati) {
 	 			var title_update = $.parseJSON(datati);
 				$("#"+title_update.diaryID).html(title_update.diarytitle);
 	 		});
 });
 
 $("#addnewbutton").click(function() {
 		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
 		var d = new Date();
 		var x = d.getDay();
 		var month = d.getMonth()+1;

 		var date = d.getFullYear()+"-"+month+"-"+d.getDate();
 		var weekday = days[x];
 		var timehms = d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
 
 		if (navigator.geolocation) {
        		navigator.geolocation.getCurrentPosition(showPosition);
        		$("#message1").html("Waiting for Geolocation");
    			$("#message1").fadeIn();
    		} else {
        		$("#error1").html("Geolocation is not supported by this browser");
        		$("#error1").fadeIn();
        		setTimeout(function(){
        			$('#error1').fadeOut();
    			},2000);
        		$.post("diaryadddrop.php", {diaryadddrop:"add", ddate:date, dweekday:weekday, dtimehms:timehms},
        		function(latest) {
 	 				updatetitles();		   // update the titles list
 	 				row_click(latest);     // "click" the newest diary entry
 	 				var tempheight = $(".navList").height();      // Set nav bar height to match contents
 	 				var temp = 70;
 	 				tempheight = tempheight + temp;
 	 				if (tempheight > $(window).height()-275) tempheight = $(window).height()-275;
 	 				$('#sidenavlist').css('height', tempheight);
 	 				});
    		}	
		function showPosition(position) {
    		var x = position.coords.latitude + ", " + position.coords.longitude;
    		$("#message1").html("Diary Entry Added, Cordinates: " + x);
    		setTimeout(function(){
        		$('#message1').fadeOut();
    		},2000);
    		$.post("diaryadddrop.php", {diaryadddrop:"add", gps:x, ddate:date, dweekday:weekday, dtimehms:timehms},
    		function(latest) {
 	 			updatetitles();			                      // update the titles list
 	 			row_click(latest);                            // "click" the newest diary entry
 	 			var tempheight = $(".navList").height();      // Set nav bar height to match contents
 	 			var temp = 70;
 	 			tempheight = tempheight + temp;
 	 			if (tempheight > $(window).height()-275) tempheight = $(window).height()-275;
 	 			$('#sidenavlist').css('height', tempheight);
 	 			});
			}
 });
 
 $("#delete_button").click(function() {
 	 	var pick = confirm("Are you sure you want to delete this entry?");
 	 	 	if (pick == true) {
 	 	 		$.post("diaryadddrop.php", {diaryadddrop:"drop"},
 	 	 		function(latest) {
 	 				updatetitles();		                                 // update the titles list
 	 				row_click(latest);                                   // "click" the newest diary entry
 	 				var tempheight = $(".navList").height();             // Set nav bar height to match contents
 	 				if (tempheight > $(window).height()-275) tempheight = $(window).height()-275;
 	 				$('#sidenavlist').css('height', tempheight);
 	 				});	
 	 			}
 });
 
 $("#zoom_out").click(function() {
 		maplarge.setZoom(2);
 });
 
 $("#globalmap").click(function() {
 		deleteOverlaysGlobal();
 });
 
 function updatetitles() {
  		$.post("updatesidenav.php",                  // update side title bar
 	 		function(datalist) {
 				$("#sidenavlist").html(datalist);
 	 		});	 	 		
 }
 
 function row_click(clicked_id) {
 			 deleteOverlays();
 			 $.post("diarypick.php", {diarynum:clicked_id}, 
 				 function(data, status){
 				 	 if (status != "success") alert("failed to retrive data!");
 				 	 else {
 					 	var arr = $.parseJSON(data);
 					 	$("#diarytextarea").val(arr.diarytext);
 					 	$("#diarytitlearea").val(arr.diarytitle);
 					 	$("#ShowInfo").val(arr.date + ", " + arr.weekdate + ", " + arr.time);
 					 	var coor = arr.location;
 					 	codeLatLng(coor);            // Mark current diary on map
 					 }
 					 });
 }
 
 var geocoder;
 var map;
 var maplarge
 var infowindow = new google.maps.InfoWindow();
 var marker;
 var markersArray = [];
 //  variables for the global map 
 var geocoderglobal;
 var markerglobal;
 var markersArrayGlobal = [];

 function initialize() {
 	geocoder = new google.maps.Geocoder();
  	var latlng = new google.maps.LatLng(37.4001429, -121.92632890000002);
  	var mapOptions = {
    	zoom: 9,
    	center: latlng,
    	mapTypeId: 'roadmap',
    	zoomControlOptions: {
      		style:google.maps.ZoomControlStyle.LARGE
    	},
  	}
  	map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
  	var mapOptionsLarge = {
    	zoom: 2,
    	center: latlng,
    	mapTypeId: 'roadmap',
    	zoomControlOptions: {
      		style:google.maps.ZoomControlStyle.DEFAULT
    	},
  	}
  	maplarge = new google.maps.Map(document.getElementById('LargeMap'), mapOptionsLarge);	
 	}
	
	function codeLatLng(loc) {
		var input = loc;
    	var latlngStr = input.split(",",2);
    	var lat = parseFloat(latlngStr[0]);
    	var lng = parseFloat(latlngStr[1]);
    	var latlng = new google.maps.LatLng(lat, lng);
    	geocoder.geocode({'latLng': latlng}, function(results, status) {
      		if (status == google.maps.GeocoderStatus.OK) {
        		if (results[1]) {
          			map.setZoom(9);
          			marker = new google.maps.Marker({
              			position: latlng,
              			animation:google.maps.Animation.DROP,
              			map: map
          				});
          			map.panTo(marker.getPosition());
          			$("#ShowAddress").val(results[1].formatted_address);
          			infowindow.setContent('<div class="InfoWindowStyle"><p1>' + results[1].formatted_address + '</p1></div>');
          			infowindow.open(map, marker);
          			markersArray.push(marker);       // Push marker into array;
          			
          			// function to zoom on the marker when marker is clicked
          			google.maps.event.addListener(marker,'click',function() {
  						map.setZoom(12);
  						map.setCenter(marker.getPosition());
  						});	
  						
  					// 3 seconds after the center of the map has changed, pan back to the marker
					google.maps.event.addListener(map,'center_changed',function() {
						window.setTimeout(function() {
    					map.panTo(marker.getPosition());
  						},3000);
  					});
		
        			}
      			} else {
        			alert("Geocoder failed due to: " + status);
      				}
    			});    			
  			}
  			
  	function deleteOverlays() {
  		if (markersArray) {
    		for (i in markersArray) markersArray[i].setMap(null);
    			markersArray.length = 0;
  			}
		}
	
	google.maps.event.addDomListener(window, 'load', initialize);

	// Resize maplarge to show on a Bootstrap's modal
	$("#mapmodal").on("shown.bs.modal", function () {
		var currentCenter = maplarge.getCenter();  // Get current center before resizing
		google.maps.event.trigger(maplarge, "resize");
  		maplarge.setCenter(currentCenter);  // Re-set previous center
  		//  Place markers on global map
  		  	$.post("getmarkers.php",
 	 		function(datamk) {
 	 			var markers = $.parseJSON(datamk);
 	 			$.each(markers, function(i, marker) {
 	 				putglobalmarkers(marker.location, marker.date, marker.diarytitle, marker.diaryID);
 	 			});
 	 		});
	});
	
	$('#mapmodal').on('hidden.bs.modal', function () {
    	maplarge.setZoom(2);
	})
	
	function putglobalmarkers(loc, ddate, dtitle, dID) {
		var input = loc;
		var latlngStr = input.split(",",2);
		var lat = parseFloat(latlngStr[0]);
		var lng = parseFloat(latlngStr[1]);
		var latlng = new google.maps.LatLng(lat, lng);
          	markerglobal = new google.maps.Marker({
            position: latlng,
            animation:google.maps.Animation.DROP,
            map: maplarge
          	});
        var infowindowglobal = new google.maps.InfoWindow({maxWidth: 300});
          	infowindowglobal.setContent(ddate +"  "+ dtitle);
          	infowindowglobal.open(maplarge, markerglobal);		
          	markersArrayGlobal.push(markerglobal);
          	
    		(function(current_position, current_id) {
       			google.maps.event.addListener(markerglobal, 'click', function() {
       				maplarge.setCenter(current_position.getPosition());
       				maplarge.setZoom(9);
       				row_click(current_id);
       			});
			})(markerglobal, dID);              //  closure to remember each marker and id	
  		}
  		
  	function deleteOverlaysGlobal() {            // Delete all markers on global map
  			if (markersArrayGlobal) {
    			for (i in markersArrayGlobal) markersArrayGlobal[i].setMap(null);
    				markersArrayGlobal.length = 0;
  			}
		}

 </script>
 </body>
</html>