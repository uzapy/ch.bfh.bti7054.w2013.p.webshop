<script src="JS/search.js"></script>

<?php
if(isset($_POST['q'])) {
	$q = $_POST['q'];
} elseif(isset($_GET['q'])) {
	$q = $_GET['q'];
	$category = "";
}

if (isset($_POST['category_option'])) {
	$category = $_POST['category_option'];
} else {
	$category = "";
}
?>

<form action="?site=search<? echo $translator->getLangUrl(); ?>" method="POST" name="suche">
	<div id="main">
		<select name="category_option" id="category_option">
			<option value="all"><? echo $translator->get("Alles") ?></option>
			<option value="Artist" <? echo $category == "Artist" ? "selected" : "";?>><? echo $translator->get("Künstler") ?></option>
			<option value="Album" <? echo $category == "Album" ? "selected" : "";?>><? echo $translator->get("Album") ?></option>
			<option value="Year" <? echo $category == "Year" ? "selected" : "";?>><? echo $translator->get("Jahr") ?></option>
			<option value="Country" <? echo $category == "Country" ? "selected" : "";?>><? echo $translator->get("Land") ?></option>
			<option value="Genre" <? echo $category == "Genre" ? "selected" : "";?>><? echo $translator->get("Genre") ?></option>
			<option value="Style" <? echo $category == "Style" ? "selected" : "";?>><? echo $translator->get("Stil") ?></option>
			<option value="Label" <? echo $category == "Label" ? "selected" : "";?>><? echo $translator->get("Label") ?></option>
			<!-- <option value="Number" <? echo $category == "Number" ? "selected" : "";?>><? echo $translator->get("Nummer") ?></option> -->
			<option value="LastFM" <? echo $category == "LastFM" ? "selected" : "";?>>Last.fm</option>
		</select>
		<input name="q" type="text" maxlength="255" size="20" value="<? echo isset($q) ? $q : ""; ?>"
			onkeyup="suggest(this.value)" autocomplete="off" />
		<input type="submit" name="submit" value="Suchen" />
	</div>
</form>

<?php
if(isset($_POST['q']) || isset($_GET['q'])) {
	$result = array();
		
	if($category == "all" || $category == "") {
		
		$result = $database->searchPlattenAll($q);
		
	} elseif ($category == "LastFM") {
		$lastFmUser = $q;
	
		// Include the API
		require 'lastFMAPI/lastfmapi/lastfmapi.php';
	
		// Put the auth data into an array
		$authVars = array(
				'apiKey' => 'ae77ad67ac320dd2231efe3bef1e7235',
				'secret' => '80baefd85aea297c09836d4c56dd494e',
				'username' => 'uzapy'
		);

		$config = array( 'enabled' => true, 'path' => 'lastFMAPI/lastfmapi/', 'cache_length' => 1800 );
	
		// Pass the array to the auth class to eturn a valid auth
		$auth = new lastfmApiAuth('setsession', $authVars);
		$apiClass = new lastfmApi();
		$userClass = $apiClass->getPackage($auth, 'user', $config);
	
		// Setup the variables
		$methodVars = array('user' => $lastFmUser);
	
		$artists = array();
		if ($topArtists = $userClass->getTopArtists ($methodVars)) {
			foreach ($topArtists as $artist) {
				array_push($artists, $artist['name']);
			}
			
			$result = $database->searchPlattenByArtistSet($artists);
					
		} else {
			die ( '<b>Error ' . $userClass->error ['code'] . ' - </b><i>' . $userClass->error ['desc'] . '</i>' );
		}
	} else {
		$result = $database->searchPlattenByCategory($category, $q);
	}
			
	echo '<ul>';
	/* fetch object array */
	if (isset($result) && $result->num_rows > 0) {
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
	
	if (!isset($result) || $result->num_rows < 1 && strlen($q) > 0) {
		echo '<div>' . $translator->get("Nichts gefunden, Sorry.") . '</div>';
	}
}
?>
