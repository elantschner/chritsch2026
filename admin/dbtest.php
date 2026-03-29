<?php
	$host = "mysqlng16.intern.ispservices.at";
	$database = "db39702_chritsch";
	$user = "u39702_chritsch";
	$pass = "chritsch_1976";


	$link = mysqli_connect($host, $user, $pass, $database);

	if (!$link) {
		echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
		echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	echo "Erfolg: es wurde ordnungsgemäß mit MySQL verbunden! Die Datenbank \"datenbank\" ist toll." . PHP_EOL;
	echo "Host-Informationen: " . mysqli_get_host_info($link) . PHP_EOL;

	mysqli_close($link);
?>