<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php
include('paginator.class.php');
try {
	$conn = new PDO('mysql:host=;dbname=', '', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	$num_rows = $conn->query('SELECT COUNT(*) FROM City')->fetchColumn(); 
	$pages = new Paginator($num_rows,9,array(15,3,6,9,12,25,50,100,250,'All'));
	echo $pages->display_pages();
	echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";
	$stmt = $conn->prepare('SELECT City.Name,City.Population,Country.Name,Country.Continent,Country.Region FROM City INNER JOIN Country ON City.CountryCode = Country.Code ORDER BY City.Name ASC LIMIT :start,:end');
	$stmt->bindParam(':start', $pages->limit_start, PDO::PARAM_INT);
	$stmt->bindParam(':end', $pages->limit_end, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	echo "<table><tr><th>City</th><th>Population</th><th>Country</th><th>Continent</th><th>Region</th></tr>\n";
	foreach($result as $row) {
		echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>\n";
	}
	echo "</table>\n";
	echo $pages->display_pages();
	echo "<p class=\"paginate\">Page: $pages->current_page of $pages->num_pages</p>\n";
	echo "<p class=\"paginate\">SELECT * FROM table LIMIT $pages->limit_start,$pages->limit_end (retrieve records $pages->limit_start-".($pages->limit_start+$pages->limit_end)." from table - $pages->total_items item total / $pages->items_per_page items per page)";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>
</body>
</html>