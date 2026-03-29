<?PHP
  include "inc_mysql.php";
  $sql = mysql_query("SHOW TABLES LIKE 'slider'");
  $anzahl = mysql_num_rows($sql);
  if ($anzahl == 1) echo "Tabelle 'slider' existiert bereits.";
  else {
    mysql_query("CREATE TABLE slider (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      titel VARCHAR(255),
	  bilder VARCHAR(255),
      zeitpunkt TIMESTAMP)
	  CHARACTER SET = 'UTF8'");
    echo "Tabelle 'slider' wurde angelegt.";
  }
  mysql_close($dz);
?>