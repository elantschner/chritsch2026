<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') sendError('Method not allowed', 405);

$db   = getDB();
$res  = $db->query('SELECT id, titel, bilder FROM slider ORDER BY id');

if (!$res) sendError('Datenbankfehler: ' . $db->error, 500);

$rows = [];
while ($row = $res->fetch_assoc()) $rows[] = $row;

sendJSON(true, $rows);
