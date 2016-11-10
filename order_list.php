<?php 
	include 'order_connect.php';

	header('Content-type: application/json');

	$items = array();
	sleep(3);

	/*$result = mysql_query("SELECT * FROM Items");
	while ($row = mysql_fetch_array($result))
	{
		$item = array(
			'title' => $row['Title'],
			'url' => $row['ImageUrl'],
			'id' => $row['Id'],
			'description' => $row['Description'], 
			'price' => $row['Price']);
		$items[] = $item;
	}*/

	$totalResult = mysql_query("SELECT COUNT(*) AS Total FROM Items"); //общее количество
	$row = mysql_fetch_assoc($totalResult);
	$total = $row['Total'];
	$per_page = 10; // количество items на странице
	$num_pages = ceil($total/$per_page); // число страниц

	if (isset($_GET['page'])) $page = ($_GET['page']-1); 
	else $page = 0;

	$start = abs($page*$per_page); // с какой item вытаскивать
	$result = mysql_query("SELECT * FROM Items LIMIT $start, $per_page"); // запрос пагинации
	while ($row = mysql_fetch_array($result))
	{
		$item = array(
			'title' => $row['Title'],
			'url' => $row['ImageUrl'],
			'id' => $row['Id'],
			'description' => $row['Description'], 
			'price' => $row['Price']);
		$items[] = $item;
	}

	$page = $_GET['page'];
	$result = array('items' => $items, 'total' => $total, 'num_pages' => $num_pages, 'page' => $page);

	
	echo json_encode($result);
?>