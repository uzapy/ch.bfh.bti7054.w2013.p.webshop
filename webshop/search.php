<script src="JS/search.js"></script>

<?php
	if(isset($_POST['q'])) {
		$q = $_POST['q'];
	} elseif(isset($_GET['q'])) {
		$q = $_GET['q'];
	}
	
	
	if(isset($_POST['q'])) {
		$col_s = $_POST['col_search'];
	} else {
		$col_s = "";
	}
?>

<?
$result_array = array();

if (isset($_POST['lastfm'])) {
	$lastFmUser = $_POST['lastfm'];
	
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
					array_push($result_array, $result->fetch_object());
				}
			}
			
	} else {
		die ( '<b>Error ' . $userClass->error ['code'] . ' - </b><i>' . $userClass->error ['desc'] . '</i>' );
	}
	
	print_r($result_array);
}
?>

<form action="?site=search" method="POST" name="suche">
	<div id="main">

		<select name="col_search" id="col_search">
			<option value="all">Alles</option>
			<option value="Artist"
				<? echo $col_s == "Artist" ? "selected" : "";?>>Artist</option>
			<option value="Album" <? echo $col_s == "Album" ? "selected" : "";?>>Album</option>
			<option value="Year" <? echo $col_s == "Year" ? "selected" : "";?>>Jahr</option>
			<option value="Country"
				<? echo $col_s == "Country" ? "selected" : "";?>>Land</option>
			<option value="Genre" <? echo $col_s == "Genre" ? "selected" : "";?>>Genre</option>
			<option value="Style" <? echo $col_s == "Style" ? "selected" : "";?>>Style</option>
			<option value="Label" <? echo $col_s == "Label" ? "selected" : "";?>>Label</option>
			<option value="Number"
				<? echo $col_s == "Number" ? "selected" : "";?>>Nummer</option>
		</select> <input name="q" type="text" maxlength="255" size="20"
			value="<? echo isset($q) ? $q : ""; ?>" onkeyup="suggest(this.value)"
			autocomplete="off" /> <input type="submit" name="submit"
			value="Suchen" />
		<div id="ausgabe"></div>
	</div>
</form>

<br>


<?php
if(isset($_POST['q']) || isset($_GET['q'])) {	

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
	} else {
		$query .= "`".$col_s."` LIKE '%".$q."%'";
	}
	
	$query .= " ORDER BY Artist ASC";
	
	
	if ($result = $mysql->query($query)) {
		echo '<ul class="platte">';
		
		/* fetch object array */
		while ($platte = $result->fetch_object()) {
		?>
<li>
	<div class="platte">
		<a
			href="?site=detail&item=<? echo $platte->ID . $translator->getLangUrl() ?>">
			<img class="album_cover" alt="<? echo $platte->Album ?>"
			src="Resources/Covers/<? echo $platte->CoverName ?>" />
		</a>
		<div class="album_info">
			<h4>
				<a class="link"
					href="?site=detail&item=<? echo $platte->ID . $translator->getLangUrl() ?>">
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

<form accept-charset="utf-8" id="registerForm" autocomplete="on"
	action="?site=search" method="POST" name="registerForm"
	onsubmit="return validateForm();">

	<fieldset>
		<p>
			<label for="lastfm">Last FM User Name:</label> <input id="lastfm"
				name="lastfm" required="required" type="text" />
		</p>
		<input type="submit" value="Suche" />
	</fieldset>
</form>
