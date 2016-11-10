<?php 
	$username = "root";
	$servername = "localhost";
	$password = "";
	$link = mysql_connect($servername, $username, $password)
		or die ("bad connection");
	

	$selected = mysql_select_db("test2ru",$link) 
  		or die("Could not select examples");

  		;
 ?>