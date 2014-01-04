<?php
$query = "SELECT * FROM Platten";

if ($result = $mysql->query($query)) {
	
	echo '<ul>';
	// FŸr jedes gefundene Element
	while ($platte = $result->fetch_object()) {
		?>
		<li>
			<div class="platte">
				<img class="album_cover" alt="<? echo $platte->Album; ?>"
					 src="Resources/Covers/<? echo $platte->CoverName; ?>" />
				<div class="album_info">
					<h4><? echo $platte->Artist ." - ". $platte->Album; ?></h4>
					<span class="album_details"><? echo $translator->get("Jahr")  .': '. $platte->Year; ?></span>
					<span class="album_details"><? echo $translator->get("Label") .': '. $platte->Label; ?></span>
					<span class="album_details"><? echo $translator->get("Genre") .': '. $platte->Genre; ?></span>
					<span class="album_details"><? echo $translator->get("Land")  .': '. $platte->Country; ?></span>
					<p><? echo $translator->get("Stil") .': '. $platte->Style; ?></p>
				</div>
			</div>
		</li>
		<?
	}
	
	echo '</ul>';
	
	$result->close();
}
?>