<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') sendError('Method not allowed', 405);

$db    = getDB();
$heute = date('Y-m-d');

// Step 1: first occurrence per title (one representative row per unique titel)
$stmt = $db->prepare(
    "SELECT t.*
     FROM termine t
     INNER JOIN (
         SELECT titel, MIN(id) AS min_id
         FROM termine
         WHERE datum >= ? OR datum < '1000-01-01'
         GROUP BY titel
     ) g ON t.id = g.min_id
     ORDER BY t.datum ASC
     LIMIT 99"
);
$stmt->bind_param('s', $heute);
$stmt->execute();
$res = $stmt->get_result();

$events = [];
while ($row = $res->fetch_assoc()) $events[] = $row;

if (empty($events)) sendJSON(true, [], ['count' => 0]);

$result = [];

foreach ($events as $event) {
    $titel = $event['titel'];

    // Step 2a: next date
    $s2 = $db->prepare(
        "SELECT termin, tag FROM termine
         WHERE titel = ? AND (datum > ? OR datum < '1000-01-01')
         ORDER BY datum ASC LIMIT 1"
    );
    $s2->bind_param('ss', $titel, $heute);
    $s2->execute();
    $nextDate = $s2->get_result()->fetch_assoc() ?: null;

    // Step 2b: all further dates
    $s3 = $db->prepare(
        "SELECT termin, tag FROM termine
         WHERE titel = ? AND datum > ?
         ORDER BY datum ASC"
    );
    $s3->bind_param('ss', $titel, $heute);
    $s3->execute();
    $allRes   = $s3->get_result();
    $allDates = [];
    while ($d = $allRes->fetch_assoc()) $allDates[] = $d;

    $result[] = [
        'id'           => (int)$event['id'],
        'titel'        => $event['titel'],
        'beschreibung' => $event['beschreibung'],
        'treffpunkt'   => $event['treffpunkt'],
        'icon'         => str_replace('flaticon-', 'icon-', $event['icon'] ?? ''),
        'next_date'    => $nextDate,
        'all_dates'    => $allDates,
    ];
}

sendJSON(true, $result, ['count' => count($result)]);
