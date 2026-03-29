<?PHP
  include "inc_mysql.php";
  $sql = mysql_query("SHOW TABLES LIKE 'termine'");
  $anzahl = mysql_num_rows($sql);
  if ($anzahl == 1) echo "Tabelle 'termine' existiert bereits.";
  else {
    mysql_query("CREATE TABLE termine (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	    datum DATE,
      tag VARCHAR(255),
      termin VARCHAR(255),
      treffpunkt VARCHAR(255),
      titel VARCHAR(255),
	    beschreibung TEXT,
      icon VARCHAR(255),
	    zeitpunkt TIMESTAMP)
	  CHARACTER SET = 'UTF8'");
    echo "Tabelle 'termine' wurde angelegt.";
  }
  mysql_close($dz);
?>