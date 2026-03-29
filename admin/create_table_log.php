<?PHP
  include "inc_mysql.php";
  $sql = mysql_query("SHOW TABLES LIKE 'logdatei'");
  $anzahl = mysql_num_rows($sql);
  if ($anzahl == 1) echo "Tabelle 'logdatei' existiert bereits.";
  else {
    mysql_query("CREATE TABLE logdatei (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      ip VARCHAR(15),
	  agent VARCHAR(255),		
	  referer TEXT,
	  seite TEXT,
	  datum DATE,
	  zeit TIME)");
    echo "Tabelle 'logdatei' wurde angelegt.";
  }
  mysql_close($dz);
?>