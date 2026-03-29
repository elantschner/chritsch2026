<?PHP
  include "inc_mysql.php";
  $sql = mysql_query("SHOW TABLES LIKE 'portfolio'");
  $anzahl = mysql_num_rows($sql);
  if ($anzahl == 1) echo "Tabelle 'portfolio' existiert bereits.";
  else {
    mysql_query("CREATE TABLE portfolio (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      titel VARCHAR(255),
	  beschreibung TEXT,
	  kategorie VARCHAR(255),
	  icon VARCHAR(255),
	  bilder VARCHAR(255),
      zeitpunkt TIMESTAMP)
	  CHARACTER SET = 'UTF8'");
    echo "Tabelle 'portfolio' wurde angelegt.";
  }
  mysql_close($dz);
?>