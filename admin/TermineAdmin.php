<?PHP
	include "inc_logfile.php";
	{$titel = ""; $beschreibung = ""; $tag = ""; $termin = ""; $treffpunkt = ""; $datum = ""; $icon = ""; $id = "";}

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


	// Auswertung der POST-Variablen
	if (!empty($_POST["titel"])) {
		$titel = addslashes(trim($_POST["titel"]));
		$beschreibung = addslashes(trim($_POST["beschreibung"]));
		$tag = addslashes(trim($_POST["tag"]));
		$termin = addslashes(trim($_POST["termin"]));
		$treffpunkt = addslashes(trim($_POST["treffpunkt"]));
		$datum = addslashes(trim($_POST["datum"]));
		$icon = addslashes(trim($_POST["icon"]));
		
		$id = $_POST["id"];

		if (empty($id)) {
		mysqli_query($dz, "INSERT INTO termine SET
			tag = '$tag', 
			termin = '$termin',
			treffpunkt = '$treffpunkt',
			titel = '$titel', 
			beschreibung = '$beschreibung', 
			datum = '$datum',
			icon = '$icon'");
			}
		else {
		mysqli_query($dz, "UPDATE termine SET
			tag = '$tag', 
			termin = '$termin',
			treffpunkt = '$treffpunkt',
			titel = '$titel', 
			beschreibung = '$beschreibung', 
			datum = '$datum',
			icon = '$icon'
			WHERE id = $id");
		}
				
		header("Location: TermineAdmin.php");
	}
	

	// Auswertung des GET-Parameters
	if (!empty($_GET["id"])){
		$id = $_GET["id"];
		if (preg_match("/^del(\d+)$/",$id,$loeschen)) {
			mysqli_query($dz, "DELETE FROM termine WHERE id = $loeschen[1]");
			unset($id);
		}	
		else if (preg_match("/^copy(\d+)$/",$id,$copy)) {
			$sql = mysqli_query($dz, "SELECT * FROM termine WHERE id = $copy[1]");
			$ds = mysqli_fetch_array($sql);
			$treffpunkt = $ds["treffpunkt"];
			$titel = $ds["titel"];
			$beschreibung = $ds["beschreibung"];
			$icon = $ds["icon"];
			$id = "";
		} else {
			$sql = mysqli_query($dz, "SELECT * FROM termine WHERE id = $id");
			$ds = mysqli_fetch_array($sql);
			$tag = $ds["tag"];
			$termin = $ds["termin"];
			$treffpunkt = $ds["treffpunkt"];
			$titel = $ds["titel"];
			$beschreibung = $ds["beschreibung"];
			$datum = $ds["datum"];
			$icon = $ds["icon"];
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
  <h1><a href="index.php"><i class="fa fa-wrench"></i> Admin</a> – Termine</h1>
  <a href="http://www.chritsch.at" target="_blank">www.chritsch.at</a>
</div>

<div class="admin-container">
  <div class="admin-grid">

    <div class="admin-card">
      <h3>Termin bearbeiten</h3>
      <script>
        var wtg = ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'];
        var mnt = ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
        function insertDate(datum) {
          var date1 = new Date(datum.value);
          document.getElementById("tag").value = wtg[date1.getDay()];
          document.getElementById("termin").value = date1.getDate()+'. '+mnt[date1.getMonth()];
        }
      </script>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label>Datum (JJJJ-MM-TT)</label>
        <input type="text" value="<?= $datum ?>" name="datum" onchange="insertDate(this)" />

        <label>Wochentag</label>
        <input type="text" id="tag" value="<?= $tag ?>" name="tag" />

        <label>Termin (Tag + Monat)</label>
        <input type="text" id="termin" value="<?= $termin ?>" name="termin" />

        <label>Treffpunkt</label>
        <input type="text" value="<?= $treffpunkt ?>" name="treffpunkt" />

        <label>Titel</label>
        <input type="text" value="<?= $titel ?>" name="titel" />

        <label>Beschreibung</label>
        <textarea name="beschreibung" rows="6"><?= $beschreibung ?></textarea>

        <label>Icon</label>
        <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-top:0.25rem">
          <?php foreach ($icons as $key => $icons) {
            $checked = ($icons == $icon) ? "checked" : "";
            echo "<label style='display:flex; flex-direction:column; align-items:center; gap:0.25rem; font-size:0.75rem; text-transform:none; letter-spacing:0; margin-top:0; cursor:pointer'><i class='$icons' style='font-size:1.75rem'></i><input type='radio' name='icon' value='$icons' $checked></label>";
          } ?>
        </div>

        <input type="hidden" value="<?= $id ?>" name="id">
        <div class="btn-group">
          <input type="submit" value="Eintragen" />
          <button type="button" onclick="window.open('TermineAdmin.php?id=copy<?= $id ?>','_self')">Kopieren</button>
          <button type="button" onclick="window.open('TermineAdmin.php','_self')">Neu</button>
        </div>
      </form>
    </div>

    <div class="admin-card">
      <h3>Alle Termine</h3>
      <ul class="admin-list">
        <?PHP
          $sql = mysqli_query($dz, "SELECT * FROM termine ORDER BY datum DESC");
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