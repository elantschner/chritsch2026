<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') sendError('Method not allowed', 405);

$page   = max(1, (int)($_GET['page']  ?? 1));
$limit  = min(12, max(1, (int)($_GET['limit'] ?? 6)));
$offset = ($page - 1) * $limit;
$search = trim($_GET['search'] ?? '');

$db = getDB();

if ($search !== '') {
    // Filtered query – no pagination needed
    $like = '%' . $search . '%';
    $stmt = $db->prepare(
        'SELECT id, titel, datum, artikel, bilder, video
         FROM blog WHERE titel LIKE ? ORDER BY datum DESC LIMIT 10'
    );
    $stmt->bind_param('s', $like);
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = [];
    while ($row = $res->fetch_assoc()) {
        $parts = explode('-', $row['datum']);
        $row['datum_de'] = count($parts) === 3
            ? sprintf('%02d.%02d.%04d', (int)$parts[2], (int)$parts[1], (int)$parts[0])
            : $row['datum'];
        $row['video'] = $row['video'] ?: null;
        preg_match('/href=["\']((https?:\/\/)[^"\']+)["\']/', $row['artikel'] ?? '', $m);
        $row['link'] = $m[1] ?? null;
        $rows[] = $row;
    }
    sendJSON(true, $rows);
}

// Total count
$countRes = $db->query('SELECT COUNT(*) AS total FROM blog');
if (!$countRes) sendError('Datenbankfehler: ' . $db->error, 500);
$total = (int)$countRes->fetch_assoc()['total'];

// Paginated rows
$stmt = $db->prepare(
    'SELECT id, titel, datum, artikel, bilder, video
     FROM blog ORDER BY datum DESC LIMIT ? OFFSET ?'
);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$res  = $stmt->get_result();

$rows = [];
while ($row = $res->fetch_assoc()) {
    $parts = explode('-', $row['datum']);
    $row['datum_de'] = count($parts) === 3
        ? sprintf('%02d.%02d.%04d', (int)$parts[2], (int)$parts[1], (int)$parts[0])
        : $row['datum'];
    $row['video'] = $row['video'] ?: null;
    preg_match('/href=["\']((https?:\/\/)[^"\']+)["\']/', $row['artikel'] ?? '', $m);
    $row['link'] = $m[1] ?? null;
    $rows[] = $row;
}

sendJSON(true, $rows, [
    'total'      => $total,
    'page'       => $page,
    'limit'      => $limit,
    'totalPages' => (int)ceil($total / $limit),
]);
