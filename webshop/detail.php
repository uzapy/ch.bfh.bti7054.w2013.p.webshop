<?php
if ($database->getPlatte($item)) {
	$album = $database->getPlatte($item);
	
	?>
	<div class="platte">
		<img class="detail_cover" alt="<? echo $album->Album ?>" src="Resources/Covers/<? echo $album->CoverName ?>" />
		<div class="album_info">
			<h4><? echo $album->Artist ." - ". $album->Album ?></h4>
			
			<p>
				<span class="detail_left"><? echo $translator->get("Jahr").':' ?></span>
				<a class="link" href="?site=search&q=<? echo $album->Year . $translator->getLangUrl() ?>">
					<span><? echo $album->Year ?></span>
				</a>
			</p>
			<p>
				<span class="detail_left"><? echo $translator->get("Label").':' ?></span>
				<a class="link" href="?site=search&q=<? echo $album->Label . $translator->getLangUrl() ?>">
					<span><? echo $album->Label ?></span>
				</a>
			</p>
			<p>
				<span class="detail_left"><? echo $translator->get("Genre").':' ?></span>
				<a class="link" href="?site=search&q=<? echo $album->Genre . $translator->getLangUrl() ?>">
					<span><? echo $album->Genre ?></span>
				</a>
			</p>
			<p>
				<span class="detail_left"><? echo $translator->get("Land").':' ?></span>
				<a class="link" href="?site=search&q=<? echo $album->Country . $translator->getLangUrl() ?>">
					<span><? echo $translator->get($album->Country) ?></span>
				</a>
			</p>
			<p>
				<span class="detail_left"><? echo $translator->get("Stil").':' ?></span>
				<span><? echo $album->Style ?></span>
			</p>
			<p>
				<span class="detail_left"><? echo $translator->get("Preis").':' ?></span>
				<span><b><? echo $album->Price ?> CHF</b></span>
			</p>
			<a class="link buy" href="?site=cart&add=<? echo $album->ID . $translator->getLangUrl() ?>">
				<? echo $translator->get("Kaufen") ?>
			</a>
		</div>
	</div>
	<?
} else {
	echo $translator->get ( 'Das gesuchte Element konnte nicht gefunden werden.');
}
?>