<?php 
	include 'order_connect.php';
  	mysql_query("DELETE  from Items");
  	echo "DB_Items clean <br>";

  	$images = array(
	"img/1.jpg",
	"img/2.jpg",
	"img/3.jpg");


	for ($i = 1; $i < 51; ++$i) 
	{
		$price = mt_rand(100 * 100, 1000 * 100) / 100;
		$imageId = $i % 3;

		mysql_query(
			"Insert into Items (Title, ImageUrl, Description, Price) values ('Mobile " . 
			$i . 
			"', '" .
			$images[$imageId] . 
			"', 'description from mobile " .
			$i .
			"', " .
			$price . 
			") ");

	}
	echo "DB_Items full";
 ?>