<?php
	//Edit this code with your database credentials
	$link = mysqli_connect('localhost', 'root', '', 'resfeberlabs'); 
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
?>