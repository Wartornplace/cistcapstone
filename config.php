<?php
	//DATABASE CONNECTION
	 
	
	//CREATE CONNECTION
	// $conn = new mysqli_connect($dbserver, $dbusername, $dbpassword, $db);
	$link = mysqli_connect($dbserver, $dbusername, $dbpassword, $db);
	
	//CHECK CONNECTION
	// if ($mysqli_connect_errno()) {
    // printf("Connect failed: %s\n", $mysqli->connect_error());
    // exit();
// }
// 	
	 
	// if ($conn->connect_error)
	// {
	  // die("Connection failed: ".$conn->connect_error);
	// }
	// else
	// {
		 // //IF CONNECTION IS GOOD, GET DATA FROM DATABASE
		 // $query = "SELECT title, separator, description, logo FROM config";
		 // $result = mysqli_query($conn, $query);
		 // $row = mysqli_fetch_assoc($result);
// 
		 // //GENERAL SETTINGS
		  // $title 			= $row['name'];
		 // $seperator 		= $row['separator'];
		  // $description 		= $row['description'];
		  // $logo 			= $row['logo'];
// 	
//  		
	// }
// 	
	
// function protect($string) {
    // return mysqli_real_escape_string(strip_tags(addslashes($string)));
// 	
// }
// 
// function output($string) {
    // echo "<div id=\"output\">" . $string . "</div>";
// }	
?>