<?PHP
include "inc_logfile.php";
{$titel = ""; $bilder =""; $id = "";}


if (isset($_FILES['bild'])) {
	include "class.upload.php";

	$handle = new Upload($_FILES['bild']);

	if ($handle->uploaded) {
	  $handle->image_resize         = true;
	  $handle->image_ratio_crop     = true;
	  $handle->image_x              = 1200;
	  $handle->image_y              = 675;

	  $handle->process('../images/slider/');
	  
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
    $titel = $_POST["titel"];
	if (empty($bilder))
		$bilder = $_POST['bilder'];
	$id = $_POST["id"];

    if (empty($id)) {
      mysqli_query($dz, "INSERT INTO slider SET
		titel = '$titel', 
		bilder = '$bilder'");
		}
	else {
      mysqli_query($dz, "UPDATE slider SET
        titel = '$titel' 
		WHERE id = $id");
	  if (!empty($bilder))
		mysqli_query($dz, "UPDATE slider SET
		bilder = '$bilder'
		WHERE id = $id");
		}
			
    header("Location: SliderAdmin.php");
  }
  

// Auswertung des GET-Parameters
  if (!empty($_GET["id"])){
    $id = $_GET["id"];
    if (preg_match("/^del(\d+)$/",$id,$loeschen)) {
      mysqli_query($dz, "DELETE FROM slider WHERE id = $loeschen[1]");
      unset($id);
    } else {
      $sql = mysqli_query($dz, "SELECT * FROM slider WHERE id = $id");
      $ds = mysqli_fetch_array($sql);
	  $titel = $ds["titel"];
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
	<link href="admin.css" rel="stylesheet">
		
	<link rel="shortcut icon" href="../images/favicon.ico">
</head>
<body>


<div class="admin-header">
  <h1><a href="index.php"><i class="fa fa-wrench"></i> Admin</a> – Slider</h1>
  <a href="http://www.chritsch.at" target="_blank">www.chritsch.at</a>
</div>

<div class="admin-container">
  <div class="admin-grid">

    <div class="admin-card">
      <h3>Slide bearbeiten</h3>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Titel</label>
        <textarea name="titel" rows="2"><?= $titel ?></textarea>

        <label>Bild (1200×950px)</label>
        <div id="bilder">
          <img id="bild" src="../images/slider/<?= $bilder ?>" class="admin-img-preview" style="aspect-ratio:16/9;<?= $bilder ? '' : 'display:none' ?>" />
          <div id="bild-placeholder" class="admin-img-preview" style="aspect-ratio:16/9;<?= $bilder ? 'display:none' : 'display:flex' ?>;align-items:center;justify-content:center;color:var(--color-text-light);font-size:0.9rem">Bild auswählen</div>
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
      <?PHP $ordner = "../images/slider"; include "inc_ordner.php"; ?>
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
      <h3>Alle Slides</h3>
      <ul class="admin-list">
        <?PHP
          $sql = mysqli_query($dz, "SELECT * FROM slider ORDER BY id");
          while ($result = mysqli_fetch_array($sql)) {
            $id    = $result["id"];
            $titel = htmlspecialchars($result["titel"], ENT_COMPAT, "UTF-8");
            echo "<li>";
            echo "<span class='list-title'><strong>$titel</strong></span>";
            echo "<span class='list-date'>#$id</span>";
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

