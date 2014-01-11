<script src="Resources/search.js"></script> 

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

<form action="?site=search" method="POST" name="suche">
<div id="main">

<select name="col_search" id="col_search">
	<option value="all">Alles</option>
	<option value="Artist" <? echo $col_s == "Artist" ? "selected" : "";?> >Artist</option>
	<option value="Album" <? echo $col_s == "Album" ? "selected" : "";?> >Album</option>
	<option value="Year" <? echo $col_s == "Year" ? "selected" : "";?> >Jahr</option>
	<option value="Country" <? echo $col_s == "Country" ? "selected" : "";?> >Land</option>
	<option value="Genre" <? echo $col_s == "Genre" ? "selected" : "";?> >Genre</option>
	<option value="Style" <? echo $col_s == "Style" ? "selected" : "";?> >Style</option>
	<option value="Label" <? echo $col_s == "Label" ? "selected" : "";?> >Label</option>
	<option value="Number" <? echo $col_s == "Number" ? "selected" : "";?> >Nummer</option>
</select>

	<input name="q" type="text" maxlength="255" size="20" value="<? echo isset($q) ? $q : ""; ?>" onkeyup="suggest(this.value)" autocomplete="off"/>
	<input type="submit" name="submit" value="Suchen" />
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