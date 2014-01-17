<?php
$allPlatten = $database->getAllPlatten();
if ($allPlatten->num_rows > 0) {
	
	echo '<ul>';
	// FŸr jedes gefundene Element
	while ($platte = $allPlatten->fetch_object()) {
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
					<span class="album_details"><? echo $translator->get("Jahr")  .': '?>
						<a class="link" href="?site=search&q=<? echo $platte->Year . $translator->getLangUrl() ?>">
							<? echo $platte->Year ?>
						</a>
					</span>
					<span class="album_details"><? echo $translator->get("Label") .': '?>
						<a class="link" href="?site=search&q=<? echo $platte->Label . $translator->getLangUrl() ?>">
							<? echo $platte->Label ?>
						</a>
					</span>
					<span class="album_details"><? echo $translator->get("Genre") .': '?>
						<a class="link" href="?site=search&q=<? echo $platte->Genre . $translator->getLangUrl() ?>">
							<? echo $platte->Genre ?>
						</a>
					</span>
					<span class="album_details"><? echo $translator->get("Land") .': '?>
						<a class="link" href="?site=search&q=<? echo $platte->Country . $translator->getLangUrl() ?>">
							<? echo $translator->get($platte->Country) ?>
						</a>
					</span>
					<p><? echo $translator->get("Preis") .': '. $platte->Price ?></p>
				</div>
			</div>
		</li>
		<?
	}
	
	echo '</ul>';
}
?>