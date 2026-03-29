<?php
  include "admin/inc_logfile.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['email'])) die;

    require 'admin/phpmailer/class.phpmailer.php';
    require 'admin/phpmailer/class.smtp.php';
    require 'admin/phpmailer/phpmailer.lang-de.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host       = 'securemail.a1.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'a1.914330911@a1.net';
    $mail->Password   = 'Tschchri4711?';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('info@chritsch.at', 'Chritsch');
    $mail->addAddress('christian.tschernutter@a1.net');
    $mail->isHTML(true);

    $mail->Subject = "Anmeldung " . $_POST['titel'];
    $mail->Body    = "<b>Name: </b>"      . htmlspecialchars($_POST['name'])    . "<br>
                      <b>Email: </b>"     . htmlspecialchars($_POST['email'])   . "<br>
                      <b>Telefon: </b>"   . htmlspecialchars($_POST['telefon']) . "<br>
                      <b>Termin: </b>"    . htmlspecialchars($_POST['termin'])  . "<br>
                      <b>Personen: </b>"  . htmlspecialchars($_POST['anzahl'])  . "<br><br>"
                      . nl2br(htmlspecialchars($_POST['message']));

    if ($mail->send()) {
      header("Location: https://www.chritsch.at/email_send.php");
    } else {
      $fehler = 'Die Nachricht konnte nicht gesendet werden.';
    }
    die;
  }

  $ds = [];
  if (!empty($_GET['id'])) {
    $id  = (int)$_GET['id'];
    $res = mysqli_query($dz, "SELECT * FROM termine WHERE id = $id");
    $ds  = mysqli_fetch_assoc($res) ?: [];
  }
  $titel      = htmlspecialchars($ds['titel']       ?? '', ENT_COMPAT, 'UTF-8');
  $beschreibung = $ds['beschreibung'] ?? '';
  $treffpunkt = htmlspecialchars($ds['treffpunkt']  ?? '', ENT_COMPAT, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anmeldung – <?= $titel ?> – Chritsch</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico">
  <style>
    :root {
      --color-primary:    #1a3a5c;
      --color-accent:     #e8710a;
      --color-text:       #374151;
      --color-text-light: #6b7280;
      --color-border:     #e5e7eb;
      --color-white:      #ffffff;
      --color-light:      #f8f9fa;
      --font-heading:     'Montserrat', sans-serif;
      --font-body:        'Open Sans', sans-serif;
      --radius:           8px;
      --shadow:           0 2px 16px rgba(0,0,0,0.10);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: var(--font-body);
      font-size: 15px;
      color: var(--color-text);
      background: #f1f3f6;
      min-height: 100vh;
    }
    a { color: var(--color-accent); }

    /* Header */
    .page-header {
      background: var(--color-primary);
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    .page-header a { text-decoration: none; }
    .page-header img { height: 44px; }
    .page-header span {
      color: rgba(255,255,255,0.7);
      font-size: 0.85rem;
    }

    /* Container */
    .page-wrap {
      max-width: 900px;
      margin: 2rem auto;
      padding: 0 1.5rem 3rem;
    }

    /* Card */
    .form-card {
      background: var(--color-white);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .form-card__header {
      background: var(--color-primary);
      color: #fff;
      padding: 1.5rem 2rem;
    }
    .form-card__header h1 {
      font-family: var(--font-heading);
      font-size: 1.3rem;
      font-weight: 700;
    }
    .form-card__header p {
      font-size: 0.85rem;
      opacity: 0.75;
      margin-top: 0.25rem;
    }
    .form-card__body {
      padding: 2rem;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
    }
    @media (max-width: 640px) {
      .form-card__body { grid-template-columns: 1fr; }
    }

    /* Event info */
    .event-info h2 {
      font-family: var(--font-heading);
      font-size: 1.1rem;
      color: var(--color-primary);
      margin-bottom: 0.75rem;
    }
    .event-info .beschreibung {
      font-size: 0.88rem;
      color: var(--color-text-light);
      line-height: 1.6;
      margin-bottom: 1rem;
    }
    .event-info .treffpunkt {
      font-size: 0.85rem;
      color: var(--color-text-light);
      margin-bottom: 1.25rem;
    }
    .event-info .treffpunkt i { color: var(--color-accent); margin-right: 0.3rem; }

    /* Termine radio */
    .termin-label {
      font-size: 0.78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--color-text-light);
      margin-bottom: 0.5rem;
      display: block;
    }
    .termin-options { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 1.25rem; }
    .termin-option {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 0.75rem;
      border: 1px solid var(--color-border);
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 0.9rem;
      transition: border-color 0.15s, background 0.15s;
    }
    .termin-option:has(input:checked) {
      border-color: var(--color-accent);
      background: #fff7f0;
    }
    .termin-option input { accent-color: var(--color-accent); }

    /* Anzahl */
    .field { margin-bottom: 1.25rem; }
    .field label {
      display: block;
      font-size: 0.78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--color-text-light);
      margin-bottom: 0.35rem;
    }
    .field input, .field select, .field textarea {
      width: 100%;
      padding: 0.55rem 0.75rem;
      border: 1px solid var(--color-border);
      border-radius: var(--radius);
      font: inherit;
      font-size: 0.92rem;
      color: var(--color-text);
      background: var(--color-white);
      transition: border-color 0.2s;
    }
    .field input:focus, .field select:focus, .field textarea:focus {
      outline: none;
      border-color: var(--color-primary);
    }
    .field textarea { resize: vertical; min-height: 100px; }

    /* Checkboxes */
    .check-group { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.25rem; }
    .check-label {
      display: flex;
      align-items: flex-start;
      gap: 0.5rem;
      font-size: 0.85rem;
      cursor: pointer;
    }
    .check-label input { accent-color: var(--color-accent); margin-top: 3px; flex-shrink: 0; }
    .check-label a { color: var(--color-accent); }

    /* Submit */
    .btn-submit {
      width: 100%;
      padding: 0.75rem 1.5rem;
      background: var(--color-accent);
      color: #fff;
      border: none;
      border-radius: var(--radius);
      font: inherit;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-submit:hover { background: #cf6309; transform: translateY(-1px); }

    .divider {
      border: none;
      border-top: 1px solid var(--color-border);
      margin: 0 2rem 1.5rem;
    }
  </style>
</head>
<body>

<header class="page-header">
  <a href="https://www.chritsch.at">
    <img src="images/logo1.png" alt="Chritsch Logo">
  </a>
  <span>Anmeldeformular</span>
</header>

<div class="page-wrap">
  <div class="form-card">
    <div class="form-card__header">
      <h1><?= $titel ?></h1>
      <?php if ($treffpunkt): ?>
        <p><i class="fa fa-map-marker"></i> <?= $treffpunkt ?></p>
      <?php endif; ?>
    </div>

    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?= (int)($_GET['id'] ?? 0) ?>">
      <div class="form-card__body">

        <!-- Linke Spalte: Veranstaltungsinfos -->
        <div class="event-info">
          <?php if ($beschreibung): ?>
            <div class="beschreibung"><?= nl2br(htmlspecialchars($beschreibung, ENT_COMPAT, 'UTF-8')) ?></div>
          <?php endif; ?>

          <span class="termin-label">Termin wählen</span>
          <div class="termin-options">
          <?php
            $heute = date('Y-m-d');
            $res2  = mysqli_query($dz, "SELECT termin, tag FROM termine WHERE titel = '" . mysqli_real_escape_string($dz, $ds['titel'] ?? '') . "' AND datum > '$heute' ORDER BY datum ASC");
            if ($res2 && mysqli_num_rows($res2) > 0) {
              while ($row = mysqli_fetch_assoc($res2)) {
                $val = htmlspecialchars($row['termin'], ENT_COMPAT, 'UTF-8');
                $lbl = htmlspecialchars($row['tag'] . ', ' . $row['termin'], ENT_COMPAT, 'UTF-8');
                echo "<label class='termin-option'><input type='radio' name='termin' value='$val' required> $lbl</label>";
              }
            } else {
              echo "<p style='font-size:0.85rem;color:var(--color-text-light)'>Keine kommenden Termine verfügbar.</p>";
            }
          ?>
          </div>

          <div class="field">
            <label for="anzahl">Anzahl Personen</label>
            <select name="anzahl" id="anzahl">
              <?php for ($i = 1; $i <= 10; $i++): ?>
                <option <?= $i === 2 ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="check-group">
            <label class="check-label">
              <input type="checkbox" name="agb" required>
              Ich akzeptiere die <a href="downloads/agbs_17.pdf" target="_blank">AGB's</a>
            </label>
            <label class="check-label">
              <input type="checkbox" name="datenschutz" required>
              Ich stimme der <a href="downloads/Datenschutzerklärung_18.pdf" target="_blank">Datenschutzerklärung</a> zu
            </label>
          </div>
        </div>

        <!-- Rechte Spalte: Persönliche Daten -->
        <div class="personal-info">
          <div class="field">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" placeholder="Vor- und Nachname" required>
          </div>
          <div class="field">
            <label for="email">E-Mail *</label>
            <input type="email" id="email" name="email" placeholder="deine@email.at" required>
          </div>
          <div class="field">
            <label for="telefon">Telefon</label>
            <input type="tel" id="telefon" name="telefon" placeholder="+43 ...">
          </div>
          <div class="field">
            <label for="message">Nachricht</label>
            <textarea id="message" name="message" placeholder="Weitere Informationen oder Fragen…"></textarea>
          </div>
          <input type="hidden" name="titel" value="<?= $titel ?>">
          <button type="submit" class="btn-submit">Anmeldung absenden</button>
        </div>

      </div>
    </form>
  </div>
</div>

</body>
</html>
