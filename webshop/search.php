<?php
$query = "SELECT * FROM Platten WHERE";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%' OR ";
$query .= "`Artist` LIKE '%".$_GET['term']."%'";

if ($result = $mysql->query($query)) {
	echo '<ul class="platte">';
	
	/* fetch object array */
	while ($platte = $result->fetch_object()) {
		echo '<li>'; 
		echo $platte->Artist." - ".$platte->Album;
		echo '</li>';
	}
	
	echo '</ul>';
	
	/* free result set */
	$result->close();
}
?>