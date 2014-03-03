<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<select name="tb1" onchange="submit()">
		<option>Please select a continent</option>  

<?php
try {
	$conn = new PDO('mysql:host=;dbname=', '', '');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	foreach ($conn->query('SELECT DISTINCT Continent FROM Country ORDER BY Continent ASC') as $row) {
		echo "<option";
		if(isset($_REQUEST['tb1']) and $_REQUEST['tb1']==$row['Continent']) echo ' selected="selected"';
		echo ">{$row['Continent']}</option>\n";
	}
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>

	</select>
</form> 

<?php
if(isset($_REQUEST['tb1'])) {
	include('paginator.class.php');
	$stmt = $conn->prepare('SELECT COUNT(*) FROM City,Country WHERE City.CountryCode = Country.Code AND Country.Continent = :continent');
	$stmt->execute( array(':continent'=>$_REQUEST['tb1']) );
	$num_rows = $stmt->fetchColumn();
	$stmt->closeCursor();

	$pages = new Paginator($num_rows,9);
	echo $pages->display_pages();
	echo "<span class=\"\">".$pages->display_jump_menu().$pages->display_items_per_page()."</span>";

	$stmt = $conn->prepare('SELECT City.Name,City.Population,Country.Name,Country.Continent,Country.Region FROM City INNER JOIN Country ON City.CountryCode = Country.Code AND Country.Continent = :continent ORDER BY City.Name ASC LIMIT :start,:end');
	$stmt->bindParam(':start', $pages->limit_start, PDO::PARAM_INT);
	$stmt->bindParam(':end', $pages->limit_end, PDO::PARAM_INT);
	$stmt->bindParam(':continent', $_REQUEST['tb1'], PDO::PARAM_STR);
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
}
?>

</body>
</html>