<?PHP
include "inc_logfile.php";
{$titel = ""; $beschreibung = ""; $bilder =""; $kategorie = ""; $icon = ""; $id = "";}

$icons = array(
	"icon-man-with-a-bag-in-a-bicycle",
	"icon-person-riding-a-bicycle",
	"icon-hiker-silhouette-on-mountain",
	"icon-walking-to-school",
	"icon-wind-watersport-silhouette",
	"icon-walking-with-snowshoes",
	"icon-king-of-the-hill",
	"icon-cable-car",
	"icon-mountain-shoe-boot",
	"icon-man-in-hike",
	"icon-backpacker",
	"icon-man-with-bag-and-walking-stick",
	"icon-panel",
	"icon-iglu",
	"icon-construction",
	"icon-climbing",
	"icon-handycap-people"
);

//$kategorien = array("" => "Alle", "berg" => "Bergwanderungen", "mtb" => "Mountainbiken", "rr" => "Rennradtouren", "summer" => "Sommer", "winter" => "Winter");   
$kategorien = array("summer" => "Sommer", "winter" => "Winter");

if (isset($_FILES['bild'])) {
	
	include "class.upload.php";
	$handle = new Upload($_FILES['bild']);
	if ($handle->uploaded) {
	  $handle->image_resize         = true;
	  $handle->image_ratio_crop     = true;
	  $handle->image_x              = 360;
	  $handle->image_y              = 270;

	  $handle->process('../images/portfolio/');
	  if ($handle->processed) {
		echo 'image resized';
		$handle->clean();
	  } else {
		echo 'error : ' . $handle->error;
	  }
	}
	$bilder = $handle->file_dst_name;
}	


// Auswertung der POST-Variablen
  if (!empty($_POST["titel"])) {
    $titel = addslashes(trim($_POST["titel"]));
    $beschreibung = addslashes(trim($_POST["beschreibung"]));
	$kategorie = addslashes(trim($_POST["kategorie"]));
	$icon = addslashes(trim($_POST["icon"]));
	if (empty($bilder))
		$bilder = $_POST['bilder'];
	
	$id = $_POST["id"];

    if (empty($id)) {
      mysqli_query($dz, "INSERT INTO portfolio SET
		titel = '$titel', 
		beschreibung = '$beschreibung', 
		bilder = '$bilder',
		kategorie = '$kategorie',
		icon = '$icon'");
		}
	else {
      mysqli_query($dz, "UPDATE portfolio SET
		titel = '$titel', 
		beschreibung = '$beschreibung', 
		kategorie = '$kategorie',
		icon = '$icon'
		WHERE id = $id");
		if (!empty($bilder))
			mysqli_query($dz, "UPDATE portfolio SET
			bilder = '$bilder'
			WHERE id = $id");
		}
			
    header("Location: PortfolioAdmin.php");
  }
  

// Auswertung des GET-Parameters
  if (!empty($_GET["id"])){
    $id = $_GET["id"];
    if (preg_match("/^del(\d+)$/",$id,$loeschen)) {
      mysqli_query($dz, "DELETE FROM portfolio WHERE id = $loeschen[1]");
      unset($id);
    } else {
      $sql = mysqli_query($dz, "SELECT * FROM portfolio WHERE id = $id");
      $ds = mysqli_fetch_array($sql);
	  $titel = $ds["titel"];
	  $beschreibung = $ds["beschreibung"];
	  $kategorie = $ds["kategorie"];
      $icon = $ds["icon"];
	  $bilder = $ds["bilder"];
	}  
  }

?>


<!DOCTYPE html>
<head>
	<title>Chritsch</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="publisher" content="www.chritsch.at" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../fonts/icomoon.css" rel="stylesheet">
	<link href="admin.css" rel="stylesheet">
	
	<link rel="shortcut icon" href="../images/favicon.ico">
</head>
<body>


<div class="admin-header">
  <h1><a href="index.php"><i class="fa fa-wrench"></i> Admin</a> – Aktivitäten</h1>
  <a href="http://www.chritsch.at" target="_blank">www.chritsch.at</a>
</div>

<div class="admin-container">
  <div class="admin-grid">

    <div class="admin-card">
      <h3>Aktivität bearbeiten</h3>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Titel</label>
        <input type="text" value="<?= $titel ?>" name="titel" />

        <label>Beschreibung</label>
        <textarea name="beschreibung" rows="3"><?= $beschreibung ?></textarea>

        <label>Kategorie</label>
        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:0.25rem">
          <?php foreach ($kategorien as $key => $kategorien) {
            $checked = ($key == $kategorie) ? "checked" : "";
            echo "<label style='font-size:0.9rem; text-transform:none; letter-spacing:0; margin-top:0'><input type='radio' name='kategorie' value='$key' $checked> $kategorien</label>";
          } ?>
        </div>

        <label>Icon</label>
        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:0.25rem">
          <?php foreach ($icons as $key => $icons) {
            $checked = ($icons == $icon) ? "checked" : "";
            echo "<label style='display:flex; flex-direction:column; align-items:center; gap:0.25rem; font-size:0.75rem; text-transform:none; letter-spacing:0; margin-top:0; cursor:pointer'><i class='$icons' style='font-size:1.75rem'></i><input type='radio' name='icon' value='$icons' $checked></label>";
          } ?>
        </div>

        <label>Bild (360×270px)</label>
        <div id="bilder">
          <img id="bild" src="../images/portfolio/<?= $bilder ?>" class="admin-img-preview" style="<?= $bilder ? '' : 'display:none' ?>" />
          <div id="bild-placeholder" class="admin-img-preview" style="<?= $bilder ? 'display:none' : 'display:flex' ?>;align-items:center;justify-content:center;color:var(--color-text-light);font-size:0.9rem">Bild auswählen</div>
          <input type="text" id="bildName" value="<?= $bilder ?>" name="bilder" readonly />
        </div>
        <label>Neues Bild hochladen</label>
        <input type="file" name="bild" onchange="löscheBilder()">

        <input type="hidden" value="<?= $id ?>" name="id">
        <div class="btn-group">
          <input type="submit" value="Eintragen" />
          <button type="button" onclick="location.href='#'">Neu</button>
        </div>
      </form>
      <hr>
      <?PHP $ordner = "../images/portfolio"; include "inc_ordner.php"; ?>
      <script>
      function selectImg(dir) {
        document.getElementById('bild').src = dir;
        document.getElementById('bild').style.display = '';
        document.getElementById('bildName').value = dir.substring(dir.lastIndexOf('/')+1);
        document.getElementById('bild-placeholder').style.display = 'none';
      }
      </script>
    </div>

    <div class="admin-card">
      <h3>Alle Aktivitäten</h3>
      <ul class="admin-list">
        <?PHP
          $sql = mysqli_query($dz, "SELECT * FROM portfolio ORDER BY id ASC");
          while ($result = mysqli_fetch_array($sql)) {
            $id    = $result["id"];
            $titel = htmlspecialchars($result["titel"], ENT_COMPAT, "UTF-8");
            echo "<li>";
            echo "<span class='list-title'><strong>$titel</strong></span>";
            echo "<span class='list-actions'><a href='?id=$id'>Bearbeiten</a> <span class='del' onclick='var del=confirm(\"Löschen?\");if(del)window.open(\"?id=del$id\",\"_top\")'>Löschen</span></span>";
            echo "</li>";
          }
        ?>
      </ul>
    </div>

  </div>
</div>



</body>
</html>

