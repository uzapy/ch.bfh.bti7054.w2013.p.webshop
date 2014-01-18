<script src="JS/search.js"></script>

<?php
if(isset($_POST['q'])) {
	$q = $_POST['q'];
} elseif(isset($_GET['q'])) {
	$q = $_GET['q'];
	$col_s = "";
}

if (isset($_POST['col_search'])) {
	$col_s = $_POST['col_search'];
} else {
	$col_s = "";
}

$mysql = new mysqli("localhost", "root", "root");
$mysql->select_db("plattelade");
$mysql->query("SET NAMES 'utf8'");
?>

<form action="?site=search<? echo $translator->getLangUrl(); ?>" method="POST" name="suche">
	<div id="main">
		<select name="col_search" id="col_search">
			<option value="all"><? echo $translator->get("Alles") ?></option>
			<option value="Artist" <? echo $col_s == "Artist" ? "selected" : "";?>><? echo $translator->get("Künstler") ?></option>
			<option value="Album" <? echo $col_s == "Album" ? "selected" : "";?>><? echo $translator->get("Album") ?></option>
			<option value="Year" <? echo $col_s == "Year" ? "selected" : "";?>><? echo $translator->get("Jahr") ?></option>
			<option value="Country" <? echo $col_s == "Country" ? "selected" : "";?>><? echo $translator->get("Land") ?></option>
			<option value="Genre" <? echo $col_s == "Genre" ? "selected" : "";?>><? echo $translator->get("Genre") ?></option>
			<option value="Style" <? echo $col_s == "Style" ? "selected" : "";?>><? echo $translator->get("Stil") ?></option>
			<option value="Label" <? echo $col_s == "Label" ? "selected" : "";?>><? echo $translator->get("Label") ?></option>
			<option value="Number" <? echo $col_s == "Number" ? "selected" : "";?>><? echo $translator->get("Nummer") ?></option>
			<option value="LastFM" <? echo $col_s == "LastFM" ? "selected" : "";?>>Last.fm</option>
		</select>
		<input name="q" type="text" maxlength="255" size="20" value="<? echo isset($q) ? $q : ""; ?>"
			onkeyup="suggest(this.value)" autocomplete="off" />
		<input type="submit" name="submit" value="Suchen" />
	</div>
</form>

<?php
if(isset($_POST['q']) || isset($_GET['q'])) {	
	$resultLastFm = array();
	$query = "SELECT * FROM Platten WHERE ";
		
	if($col_s == "all" || $col_s == "") {
		$query .= "`Artist` LIKE '%".$q."%' OR ";
		$query .= "`Album` LIKE '%".$q."%' OR ";
		$query .= "`Year` LIKE '%".$q."%' OR ";
		$query .= "`Country` LIKE '%".$q."%' OR ";
		$query .= "`Genre` LIKE '%".$q."%' OR ";
		$query .= "`Style` LIKE '%".$q."%' OR ";
		$query .= "`Label` LIKE '%".$q."%' OR ";
		$query .= "`Number` LIKE '%".$q."%'";
	} elseif ($col_s == "LastFM") {
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
		$methodVars = array(
				'user' => $lastFmUser
		);
	
		if ($artists = $userClass->getTopArtists ( $methodVars )) {
			// 			echo '<b>Data Returned</b>';
			// 			echo '<pre>';
			// 			print_r ( $artists );
			// 			echo '</pre>';
				
			foreach ($artists as $artist) {
				$artist_name = $artist['name'];
	
				$query = "SELECT * FROM Platten WHERE `Artist` LIKE '".$artist['name']."'";
	
				$result = $mysql->query($query);
	
				if ($result->num_rows == 1) {
					array_push($resultLastFm, $result->fetch_object());
				}
			}
					
		} else {
			die ( '<b>Error ' . $userClass->error ['code'] . ' - </b><i>' . $userClass->error ['desc'] . '</i>' );
		}
	} else {
		$query .= "`".$col_s."` LIKE '%".$q."%'";
	}
	
	$query .= " ORDER BY Artist ASC";
	echo '<ul>';
	if ($col_s == "LastFM") {
		foreach ($resultLastFm as $platte) {
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
	}
	else if ($result = $mysql->query($query)) {
		
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
	/* free result set */
	$result->close();
	}
}
?>
