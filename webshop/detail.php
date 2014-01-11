<?php
$query = 'SELECT * FROM Platten WHERE ID = ' . $item;
$result = $mysql->query($query);

if ($result->num_rows == 1) {
	$album = $result->fetch_object();
	
	?>
	<div class="platte">
		<img class="detail_cover" alt="<? echo $album->Album ?>"
			src="Resources/Covers/<? echo $album->CoverName ?>" />
		<div class="album_info">
			<h4><? echo $album->Artist ." - ". $album->Album ?></h4>
			<span class="album_details"><? echo $translator->get("Jahr")  .': '. $album->Year ?></span>
			<span class="album_details"><? echo $translator->get("Label") .': '. $album->Label ?></span>
			<span class="album_details"><? echo $translator->get("Genre") .': '. $album->Genre;?></span>
			<span class="album_details"><? echo $translator->get("Land")  .': '. $translator->get($album->Country) ?></span>
			<p><? echo $translator->get("Stil") .': '. $album->Style ?></p>
			<br><a class="link" href="?site=cart&item=<? echo $album->ID . $translator->getLangUrl() ?>">
				<? echo $translator->get("Kaufen") ?>
			</a>
		</div>
	</div>
	<?
} else {
	echo $translator->get ( 'Das gesuchte Element konnte nicht gefunden werden.');
}

$result->close();
?>