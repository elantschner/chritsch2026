<?PHP
	include "inc_logfile.php";
	{$titel = ""; $datum = date('Y-m-d'); $artikel = ""; $bilder =""; $video =""; $id = "";}

	if (isset($_FILES['bild'])) {
		include "class.upload.php";
		$handle = new Upload($_FILES['bild']);
		if ($handle->uploaded) {
		  // $handle->file_new_name_body   = 'image_original';
		  // $handle->process('D:/CustomerData/webspaces/webspace_00109927/wwwroot/images/blog/');
		   
		  // $handle->file_new_name_body   = 'image_resized';
		  $handle->image_resize         = true;
		  $handle->image_ratio_crop     = true;
		  //$handle->image_ratio_crop      = 'L';
		  $handle->image_x              = 360;
		  $handle->image_y              = 270;
		  
		  // $handle->image_convert         = 'jpg';
		  // $handle->jpeg_quality          = 80;


		  $handle->process('../images/blog/');
		  
		  
		  // header('Content-type: ' . $handle->file_src_mime);
		  // echo $handle->process();
		  // die;
			  
		  if ($handle->processed) {
			echo 'image resized';
			$handle->clean();
		  } else {
			echo 'error : ' . $handle->error;
		  }
		}
		$bilder = $handle->file_dst_name;
	}	


	// if (isset($_FILES['bild'])){
		// $img = $_FILES['bild']['name'];
		// move_uploaded_file($_FILES['bild']['tmp_name'], ''.$img);
	// }	


	// if (!empty($_FILES))
	// {
	// echo "<pre>\r\n";
	// echo htmlspecialchars(print_r($_FILES,1));
	// echo "</pre>\r\n";
	// die;
	// }


	// Auswertung der POST-Variablen
	if (!empty($_POST["titel"])) {
		$titel = addslashes(trim($_POST["titel"]));
		$datum = addslashes(trim($_POST["datum"]));
		$artikel = addslashes(trim($_POST["artikel"]));

		if (!empty($_POST["video"]))
			$video = $_POST["video"];
		if (empty($bilder))
			$bilder = $_POST['bilder'];

		$id = $_POST["id"];

		if (empty($id)) {
		  mysqli_query($dz, "INSERT INTO blog SET
			titel = '$titel', 
			datum = '$datum', 
			artikel = '$artikel',
			bilder = '$bilder',
			video = '$video'");
			}
		else {
		  mysqli_query($dz, "UPDATE blog SET
			titel = '$titel', 
			datum = '$datum', 
			artikel = '$artikel',
			video = '$video'
			WHERE id = $id");
		  if (!empty($bilder))
			mysqli_query($dz, "UPDATE blog SET
			bilder = '$bilder'
			WHERE id = $id");
			}
				
		header("Location: BlogAdmin.php");
	}


	// Auswertung des GET-Parameters
	if (!empty($_GET["id"])){
		$id = $_GET["id"];
	if (preg_match("/^del(\d+)$/",$id,$loeschen)) {
		mysqli_query($dz, "DELETE FROM blog WHERE id = $loeschen[1]");
		unset($id);
	} else {
		$sql = mysqli_query($dz, "SELECT * FROM blog WHERE id = $id");
		$ds = mysqli_fetch_array($sql);
		$titel = $ds["titel"];
		$datum = $ds["datum"];
		$artikel = $ds["artikel"];
		$bilder = $ds["bilder"];
		$video = $ds["video"];
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
  <h1><a href="index.php"><i class="fa fa-wrench"></i> Admin</a> – News</h1>
  <a href="http://www.chritsch.at" target="_blank">www.chritsch.at</a>
</div>

<div class="admin-container">
  <div class="admin-grid">

    <div class="admin-card">
      <h3>Beitrag bearbeiten</h3>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Titel</label>
        <textarea name="titel" rows="2"><?= $titel ?></textarea>

        <label>Datum</label>
        <input type="text" value="<?= $datum ?>" name="datum" />

        <label>Artikel</label>
        <textarea name="artikel" rows="10"><?= $artikel ?></textarea>

        <label>Bild (360×270px)</label>
        <div id="bilder">
          <img id="bild" src="../images/blog/<?= $bilder ?>" class="admin-img-preview" style="<?= $bilder ? '' : 'display:none' ?>" />
          <div id="bild-placeholder" class="admin-img-preview" style="<?= $bilder ? 'display:none' : 'display:flex' ?>;align-items:center;justify-content:center;color:var(--color-text-light);font-size:0.9rem">Bild auswählen</div>
          <input type="text" id="bildName" value="<?= $bilder ?>" name="bilder" readonly />
        </div>
        <label>Neues Bild hochladen</label>
        <input type="file" name="bild" onchange="löscheBilder()">

        <label>Link Video (YouTube)</label>
        <input type="text" name="video" value="<?= $video ?>" />

        <input type="hidden" value="<?= $id ?>" name="id">
        <div class="btn-group">
          <input type="submit" value="Artikel eintragen" />
          <button type="button" onclick="location.href='#'">Neu</button>
        </div>
      </form>
      <hr>
      <?PHP $ordner = "../images/blog"; include "inc_ordner.php"; ?>
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
      <h3>Alle Beiträge</h3>
      <ul class="admin-list">
        <?PHP
          $sql = mysqli_query($dz, "SELECT * FROM blog ORDER BY datum DESC");
          while ($result = mysqli_fetch_array($sql)) {
            $id    = $result["id"];
            $datum = htmlspecialchars($result["datum"], ENT_COMPAT, "UTF-8");
            $titel = htmlspecialchars($result["titel"], ENT_COMPAT, "UTF-8");
            echo "<li>";
            echo "<span class='list-title'><strong>$titel</strong></span>";
            echo "<span class='list-date'>$datum</span>";
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

