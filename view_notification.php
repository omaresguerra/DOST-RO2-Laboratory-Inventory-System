<?php

$conn = new mysqli("localhost","root","","inventorysystem");

$sql = "UPDATE comments SET status=1 WHERE status=0";	
$result=mysqli_query($conn, $sql);

$sql = "SELECT * FROM comments JOIN user ON user.UserID = comments.UserID ORDER BY id DESC limit 3";
$result = mysqli_query($conn, $sql);

$response ='';
 while ($row = mysqli_fetch_array($result)){  
	$response = $response .  
	"<a class='view-message' id=".$row['id'].">" . 
	"<div class='media'>" . 
	"<div class='media-body'>" . "<h5 class='media-heading'>". "<b>" . $row["subject"] . "</b>" . " " . "<br>" . " <small>"  . $row['Email']. " " .$row['time']. "</small>" . "</h5>" . 
	"<p>" . $row["comment"]  . "</p>" . "</div>" . "</div>" . "</a>";
}
	if(!empty($response)) {
		print $response;
	} 

?>