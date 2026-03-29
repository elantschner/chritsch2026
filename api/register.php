<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') sendError('Method not allowed', 405);

rateLimit('register', 5);

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;

$name      = strip_tags(trim($input['name']      ?? ''));
$email     = trim($input['email']     ?? '');
$termin    = strip_tags(trim($input['termin']    ?? ''));
$personen  = (int)($input['personen']  ?? 1);
$nachricht = strip_tags(trim($input['nachricht'] ?? ''));

if (!$name || !$email || !$termin) sendError('Bitte alle Pflichtfelder ausfüllen.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL))  sendError('Ungültige E-Mail-Adresse.');

$name      = htmlspecialchars($name,      ENT_QUOTES, 'UTF-8');
$termin    = htmlspecialchars($termin,    ENT_QUOTES, 'UTF-8');
$nachricht = htmlspecialchars($nachricht, ENT_QUOTES, 'UTF-8');

require __DIR__ . '/../admin/phpmailer/class.phpmailer.php';
require __DIR__ . '/../admin/phpmailer/class.smtp.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host       = SMTP_HOST;
$mail->SMTPAuth   = true;
$mail->Username   = SMTP_USER;
$mail->Password   = SMTP_PASS;
$mail->SMTPSecure = 'tls';
$mail->Port       = SMTP_PORT;
$mail->CharSet    = 'UTF-8';
$mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
$mail->addAddress(MAIL_TO);
$mail->addReplyTo($email, $name);
$mail->isHTML(true);
$mail->Subject = 'Anmeldung - www.chritsch.at';
$mail->Body    = "<b>Name:</b> {$name}<br><b>Email:</b> {$email}<br>"
               . "<b>Termin:</b> {$termin}<br><b>Personen:</b> {$personen}<br><br>"
               . nl2br($nachricht);

if (!$mail->send()) sendError('Die Anmeldung konnte nicht gesendet werden.', 500);

sendJSON(true, null, ['message' => 'Anmeldung erfolgreich gesendet!']);
