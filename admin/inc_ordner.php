<?php
$alledateien = scandir($ordner);           
 
foreach ($alledateien as $datei) {
	$dateiinfo = pathinfo($ordner."/".$datei); 
	$size = ceil(filesize($ordner."/".$datei)/1024); 
	if ($datei != "." && $datei != ".."  && $datei != "_notes" && $dateiinfo['basename'] != "Thumbs.db") { 
		//Bildtypen sammeln
		$bildtypen= array("jpg", "jpeg", "gif", "png");
		//Dateien nach Typ prüfen, in dem Fall nach Endungen für Bilder filtern
		if(in_array($dateiinfo['extension'],$bildtypen)){
		?>
		<span class="galerie" style="float:left; width:30%; margin:1.5%">
			<img src="<?php echo $dateiinfo['dirname']."/".$dateiinfo['basename'];?>" style="width:100%" onclick="selectImg(this.src)"/>
			<p style="width:200px; height:30px; overflow: hidden; text-overflow:ellipsis" title="<?php echo $dateiinfo['filename']; ?> (<?php echo $size ; ?>kb)"><?php echo $dateiinfo['filename']; ?> (<?php echo $size ; ?>kb)</p>
		</span>
		<?php 
		// wenn keine Bildendung dann normale Liste für Dateien ausgeben
	} else { ?>
		<div class="file">
			<a href="<?php echo $dateiinfo['dirname']."/".$dateiinfo['basename'];?>">&raquo <?php echo $dateiinfo['filename']; ?></a> (<?php echo $dateiinfo['extension']; ?> | <?php echo $size ; ?>kb)
		</div>
	<?php } ?>
	<?php
	};
};
?>

<script>
function selectImg(dir){
	document.getElementById("bild").src = dir;
	document.getElementById("bildName").value = dir.substring(dir.lastIndexOf('/')+1);
}
</script>