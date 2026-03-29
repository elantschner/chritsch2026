<?php
require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') sendError('Method not allowed', 405);

rateLimit('contact', 5);

$input = json_decode(file_get_contents('php://input'), true) ?: $_POST;

$name    = strip_tags(trim($input['name']    ?? ''));
$email   = trim($input['email']   ?? '');
$subject = strip_tags(trim($input['subject'] ?? ''));
$message = strip_tags(trim($input['message'] ?? ''));

if (!$name || !$email || !$subject || !$message) sendError('Bitte alle Felder ausfüllen.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL))   sendError('Ungültige E-Mail-Adresse.');

$name    = htmlspecialchars($name,    ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

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
$mail->Subject = 'Anfrage - www.chritsch.at';
$mail->Body    = "<b>Name:</b> {$name}<br><b>Email:</b> {$email}<br><br>"
               . "<b>Betreff:</b> {$subject}<br><br>" . nl2br($message);

if (!$mail->send()) sendError('Die Nachricht konnte nicht gesendet werden.', 500);

sendJSON(true, null, ['message' => 'Danke! Deine Nachricht wurde gesendet.']);
