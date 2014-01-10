<form action="?site=search" method="POST" name="suche">
	<input name="q" type="text" maxlength="255" size="20" value="<? echo $_POST['q'];?>" /> <input type="submit" name="submit" value="Suchen" />
</form>

<br>


<?php
if(isset($_POST['q'])) {
	
	$query = "SELECT * FROM Platten WHERE";
	$query .= "`Artist` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Album` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Year` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Country` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Genre` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Style` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Label` LIKE '%".$_POST['q']."%' OR ";
	$query .= "`Number` LIKE '%".$_POST['q']."%' ORDER BY Artist ASC";
	
	if ($result = $mysql->query($query)) {
		echo '<ul class="platte">';
		
		/* fetch object array */
		while ($platte = $result->fetch_object()) {
		?>
		
		
		<li>
			<div class="platte">
				<a href="?site=detail&item=<? echo $platte->ID . $translator->getLangUrl() ?>">
					<img class="album_cover" alt="<? echo $platte->Album ?>"
					src="Resources/Covers/<? echo $platte->CoverName ?>" />
				</a>
				<div class="album_info">
					<h4>
						<a class="link" href="?site=detail&item=<? echo $platte->ID . $translator->getLangUrl() ?>">
							<? echo $platte->Artist ." - ". $platte->Album ?>
						</a>
					</h4>
					<span class="album_details"><? echo $translator->get("Jahr")  .': '. $platte->Year ?></span>
					<span class="album_details"><? echo $translator->get("Label") .': '. $platte->Label ?></span>
					<span class="album_details"><? echo $translator->get("Genre") .': '. $platte->Genre ?></span>
					<span class="album_details"><? echo $translator->get("Land")  .': '. $translator->get($platte->Country) ?></span>
					<p><? echo $translator->get("Stil") .': '. $platte->Style ?></p>
				</div>
			</div>
		</li>
		<?
		}
		
	
	echo '</ul>';
		/* free result set */
		$result->close();
	}

}
?>