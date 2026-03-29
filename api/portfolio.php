<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') sendError('Method not allowed', 405);

$kategorie = $_GET['kategorie'] ?? 'all';
if (!in_array($kategorie, ['all', 'summer', 'winter'], true)) $kategorie = 'all';

$db = getDB();

if ($kategorie === 'all') {
    $res = $db->query(
        'SELECT id, titel, beschreibung, kategorie, icon, bilder FROM portfolio ORDER BY RAND()'
    );
    if (!$res) sendError('Datenbankfehler: ' . $db->error, 500);
} else {
    $stmt = $db->prepare(
        'SELECT id, titel, beschreibung, kategorie, icon, bilder FROM portfolio WHERE kategorie = ? ORDER BY RAND()'
    );
    $stmt->bind_param('s', $kategorie);
    $stmt->execute();
    $res = $stmt->get_result();
}

$rows = [];
while ($row = $res->fetch_assoc()) {
    $row['icon'] = str_replace('flaticon-', 'icon-', $row['icon'] ?? '');
    $rows[] = $row;
}

sendJSON(true, $rows);
