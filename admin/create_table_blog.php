<?PHP
  include "inc_mysql.php";
  $sql = mysql_query("SHOW TABLES LIKE 'blog'");
  $anzahl = mysql_num_rows($sql);
  if ($anzahl == 1) echo "Tabelle 'blog' existiert bereits.";
  else {
    mysql_query("CREATE TABLE blog (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      titel VARCHAR(255),
	  datum DATE,
	  artikel TEXT,
	  bilder VARCHAR(255),
      zeitpunkt TIMESTAMP)
	  CHARACTER SET = 'UTF8'");
    echo "Tabelle 'blog' wurde angelegt.";
  }
  mysql_close($dz);
?>