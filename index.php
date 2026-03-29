<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Bergwanderführer und Mountainbike-Guide Tirol Außerfern – Wanderungen, BiSki-Guiding, barrierefreie Bergerlebnisse mit Swiss-Trac. Reutte, Tannheimer Tal, Zugspitz Arena.">
  <meta name="author" content="Christian Tschernutter">
  <title>Chritsch – Tiroler Bergwanderführer und Mountainbike-Guide</title>

  <!-- Open Graph -->
  <meta property="og:title" content="Chritsch – Bergwanderführer Tirol">
  <meta property="og:description" content="Wanderungen, Mountainbiken, BiSki-Guiding und barrierefreie Bergerlebnisse in Tirol.">
  <meta property="og:image" content="images/logo_abenteuer_outdoor.jpg">
  <meta property="og:type" content="website">

  <!-- Icons -->
  <link href="fonts/icomoon.css?v=2" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">

  <!-- App CSS -->
  <link href="css/style.css?v=2" rel="stylesheet">

  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="apple-touch-icon" href="images/hmscreen.png">
</head>

<body>

<!-- ═══════════════════════════════════════════════════════════════════════
     HERO / SLIDER
═══════════════════════════════════════════════════════════════════════ -->
<header id="home">
  <div class="slider-container" id="slider-container" aria-live="polite">
    <!-- JS fills slides from /api/slider.php -->
    <div class="loading-spinner">
      <div class="spinner"></div> Laden…
    </div>
  </div>

  <button class="slider-control slider-control--prev" aria-label="Vorheriges Bild">&#8249;</button>
  <button class="slider-control slider-control--next" aria-label="Nächstes Bild">&#8250;</button>

  <div class="slider-dots" role="tablist" aria-label="Slider Navigation"></div>

  <a class="scroll-down" href="#nav-anchor" aria-label="Nach unten scrollen">&#8964;</a>
</header>

<!-- ═══════════════════════════════════════════════════════════════════════
     NAVIGATION
═══════════════════════════════════════════════════════════════════════ -->
<div id="nav-anchor"></div>
<nav class="main-nav" role="navigation" aria-label="Hauptnavigation">
  <div class="container">
    <div class="nav-inner">
      <a class="nav-logo" href="#home" aria-label="Chritsch Startseite">
        <img src="images/logo.png" alt="Chritsch Logo">
      </a>

      <button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" aria-label="Menü öffnen">
        <span></span><span></span><span></span>
      </button>

      <ul class="nav-menu" id="nav-menu" role="list">
        <li><a href="#services">Angebot</a></li>
        <li id="nav-calendar"><a href="#calendar">Termine</a></li>
        <li><a href="#blog">News&nbsp;/&nbsp;Fotos</a></li>
        <li><a href="#about-us">Über mich</a></li>
        <li><a href="#portfolio">Aktivitäten</a></li>
        <li><a href="#contact">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- ═══════════════════════════════════════════════════════════════════════
     USP – BiSkiGuiding + Barrierefreie Bergerlebnisse
═══════════════════════════════════════════════════════════════════════ -->
<section id="usp" aria-labelledby="usp-heading">
  <h2 id="usp-heading" class="visually-hidden">Unsere Highlights</h2>
  <div class="container">
  <div class="usp-grid">

    <!-- BiSki-Guiding -->
    <div class="usp-card usp-card--biskiguiding">
      <div class="usp-card__bg" style="background-image:url(images/biski1.jpeg)" role="img" aria-label="BiSki-Guiding"></div>
      <div class="usp-card__overlay"></div>
      <div class="usp-card__content">
        <span class="usp-card__tag">Winter 2025/26</span>
        <h2>BiSki&nbsp;Guiding</h2>
        <p>Skifahren auf einem speziellen Sitz-Ski – geführt von Christian. Ein unvergessliches Erlebnis auf dem Schnee für alle.</p>
        <a href="#contact" class="btn btn-outline">Anfragen per WhatsApp / Email</a>
      </div>
    </div>

    <!-- Iglubau -->
    <div class="usp-card usp-card--barrierefrei">
      <div class="usp-card__bg" style="background-image:url(images/iglu-bau.jpg)" role="img" aria-label="Iglubau-Workshop"></div>
      <div class="usp-card__overlay"></div>
      <div class="usp-card__content">
        <span class="usp-card__tag">Winterabenteuer</span>
        <h2>Iglubau-Workshop<br>auf 1812m</h2>
        <p>Einen echten Eispalast bauen – auf dem Bernhardseck, ganz nach alter Inuit-Kunst.</p>
        <a href="#iglubau" class="btn btn-outline">Mehr erfahren</a>
      </div>
    </div>

  </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     SERVICES
═══════════════════════════════════════════════════════════════════════ -->
<section id="services" class="section-padding">
  <div class="container">

    <div class="section-heading reveal">
      <h2>Mein Angebot</h2>
      <p>Der Berg ruft! Wandern und Mountainbiken im Außerfern – wunderschöne Ausblicke, urige Hütten, kristallklare Seen.
         Egal ob zu Fuß, mit dem Bike oder beides in Kombination – das Naturerlebnis steht im Mittelpunkt.</p>
    </div>

    <div class="services-grid">

      <div class="service-card reveal reveal-delay-1">
        <div class="service-icon"><i class="icon-man-in-hike"></i></div>
        <h3>Bergwanderungen</h3>
        <p>Lechweg-Etappen, Hüttenwanderungen, Gipfelsiege und Seenwanderungen im Sommer. Im Winter Schneeschuh-Touren abseits des Alltags­tourismus.</p>
      </div>

      <div class="service-card reveal reveal-delay-2">
        <div class="service-icon"><i class="icon-man-with-a-bag-in-a-bicycle"></i></div>
        <h3>Mountainbiken</h3>
        <p>Von leichten Genusstouren bis anspruchsvollen Routen. Auch E-Bike, Hüttentouren und Seenrunden – ein Bike-Erlebnis der Extraklasse!</p>
      </div>

      <div class="service-card reveal reveal-delay-3">
        <div class="service-icon"><i class="icon-mountain-shoe-boot"></i></div>
        <h3>Bike &amp; Hike</h3>
        <p>Mit dem Bike den Aufstieg abkürzen und die Gelenke beim Rückweg schonen. Zwei wunderbare Sportarten vereint in einem Highlight der Natur.</p>
      </div>

      <div class="service-card reveal reveal-delay-1">
        <div class="service-icon"><i class="icon-person-riding-a-bicycle"></i></div>
        <h3>Rennradtouren</h3>
        <p>Das gesamte Außerfern und das benachbarte Allgäu stehen offen – jede Menge Runden mit unterschiedlichem Anspruch an Kondition.</p>
      </div>

      <div class="service-card reveal reveal-delay-2">
        <div class="service-icon"><i class="icon-walking-with-snowshoes"></i></div>
        <h3>Schneeschuhwanderung</h3>
        <p>Wo die tief verschneite Landschaft am unberührtesten ist, gelangt man mit Schneeschuhen hin. Stille der Berge, kristallklare Luft.</p>
      </div>

      <div class="service-card reveal reveal-delay-3">
        <div class="service-icon"><i class="icon-iglu"></i></div>
        <h3>Iglubau-Workshop</h3>
        <p>Auf den Spuren der Inuit – mit Schneesäge und Schaufel einen kleinen Eispalast in der traumhaften Winterlandschaft erschaffen.</p>
      </div>

      <div class="service-card reveal reveal-delay-1">
        <div class="service-icon"><i class="fa fa-users"></i></div>
        <h3>Teamevents</h3>
        <p>Im Team mit Kollegen oder Kunden – spannend, abenteuerlich, chilling, anstrengend. Sommer und Winter.</p>
      </div>

      <div class="service-card reveal reveal-delay-2">
        <div class="service-icon"><i class="icon-handycap-people"></i></div>
        <h3>Swiss Trac Touren</h3>
        <p>Wunderschöne geführte Touren – barrierefrei, nohandicap. Die Berge für alle zugänglich machen.</p>
      </div>

      <div class="service-card reveal reveal-delay-3">
        <div class="service-icon"><i class="icon-climbing"></i></div>
        <h3>Arbeiten am Seil</h3>
        <p>Felsräumen, Photovoltaik, Absturzsicherungen und diverse Arbeiten am Seil als zertifizierter Höhenarbeiter.</p>
      </div>

    </div>

    <div class="services-footer reveal">
      <h3>Wander-, Bike- und Rennradtouren stelle ich gerne individuell zusammen. Je nach Lust und Laune!</h3>
      <p>Richtpreis <strong>ab 40&nbsp;€/Person</strong> je nach Tour &nbsp;|&nbsp;
         Tourengebiete: Talkessel Reutte, Tannheimer Tal, Lechtal, Tiroler Zugspitz Arena, Allgäu</p>
      <div style="margin-top:1rem; display:flex; gap:1rem; align-items:center; justify-content:center; flex-wrap:wrap">
        <a href="downloads/agbs_17.pdf" target="_blank" class="btn btn-primary">AGBs</a>
        <a href="https://www.paypal.com/de/webapps/mpp/paypal-popup" target="_blank">
          <img src="https://www.paypalobjects.com/webstatic/de_DE/i/de-pp-logo-150px.png" alt="PayPal" style="height:32px; width:auto">
        </a>
      </div>
    </div>

    <div class="service-card--img-wide reveal" style="background-image:url(images/wandern_barrierefrei.jpg)">
      <div class="service-card--img-wide__overlay">
        <h3>Barrierefreie Wanderungen in Tirol</h3>
        <p>Natur erleben – für jeden zugänglich. Ich begleite dich auf barrierefreien Touren durch die wunderschöne Tiroler Bergwelt.</p>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════════
     TERMINE / CALENDAR
═══════════════════════════════════════════════════════════════════════ -->
<section id="calendar" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>Termine</h2>
    </div>
    <div class="events-grid" id="events-grid">
      <!-- JS fills from /api/events.php -->
      <div class="loading-spinner">
        <div class="spinner"></div> Termine werden geladen…
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════════
     FEATURE PANEL – Iglubau
═══════════════════════════════════════════════════════════════════════ -->
<section id="iglubau" class="feature-panel feature-panel--img" style="background-image:url(images/features2-bg.jpg)">
  <div class="container">
    <div class="iglubau-layout reveal">

      <!-- Text / Info -->
      <div class="iglubau-text">
        <span style="background:var(--color-nature); color:white; font-size:0.75rem; font-weight:700; padding:0.25rem 0.75rem; border-radius:20px; text-transform:uppercase; letter-spacing:0.08em">Winter 2026/27</span>
        <h2 style="color:#fff; margin-top:1rem">Iglubau-Workshop auf 1812m</h2>
        <p>Begeben wir uns auf den Spuren der Inuit und bauen unter fachkundiger Anleitung unser eigenes Iglu.
           Mit Schneesäge und Schaufel erschaffen wir ganz nach alter Kunst einen kleinen Eispalast
           in der traumhaften Winterlandschaft auf dem Bernhardseck.</p>

        <strong>Tagesablauf:</strong>
        <ul style="margin:0.5rem 0 1rem 1.25rem; line-height:1.8">
          <li>Begrüßungsgetränk</li>
          <li>Iglubau ca. 1,5 h</li>
          <li>Mittagessen</li>
          <li>Iglu-Fertigstellung ca. 1,5 h</li>
        </ul>

        <strong>Kosten:</strong>
        <ul style="margin:0.5rem 0 1.5rem 1.25rem; line-height:1.8">
          <li>mit Übernachtung und Abendessen €160/Person</li>
        </ul>

        <div style="display:flex; gap:1.5rem; align-items:center; flex-wrap:wrap">
          <a href="#contact" class="btn btn-outline">Anfragen per WhatsApp / Email</a>
        </div>
      </div>

      <!-- Bild -->
      <div class="iglubau-img">
        <img src="images/iglubau.jpg" alt="Iglubau-Workshop auf dem Bernhardseck"
             style="width:100%; height:auto; border-radius:12px; display:block">
      </div>

    </div>

    <!-- Fotoalbum aus Blog-Beiträgen -->
    <div id="iglubau-fotos" style="margin-top:2.5rem" class="reveal">
      <strong style="color:#fff; display:block; margin-bottom:1rem">Fotoalbum:</strong>
      <div id="iglubau-fotos-grid">
        <span style="color:rgba(255,255,255,0.6); font-size:0.9rem">Lade Fotos…</span>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  fetch('api/blog.php?search=Iglubau&limit=10')
    .then(function(r){ return r.json(); })
    .then(function(json) {
      var grid = document.getElementById('iglubau-fotos-grid');
      if (!json.success || !json.data.length) {
        grid.innerHTML = '<span style="color:rgba(255,255,255,0.6)">Keine Einträge gefunden.</span>';
        return;
      }
      grid.innerHTML = json.data.map(function(p) {
        var thumb = p.bilder ? '<img src="images/blog/' + p.bilder + '" alt="' + p.titel + '" loading="lazy" class="iglubau-foto-img"><div class="iglubau-foto-datum">' + p.datum_de + '</div>' : '<span style="color:rgba(255,255,255,0.6)">' + p.titel + ' (' + p.datum_de + ')</span>';
        if (p.link) {
          return '<a href="' + p.link + '" target="_blank" rel="noopener" class="iglubau-foto-item">' + thumb + '</a>';
        }
        return '<div class="iglubau-foto-item">' + thumb + '</div>';
      }).join('');
    })
    .catch(function() {
      document.getElementById('iglubau-fotos-grid').innerHTML = '<span style="color:rgba(255,255,255,0.6)">Fotos konnten nicht geladen werden.</span>';
    });
})();
</script>

<!-- ═══════════════════════════════════════════════════════════════════════
     BLOG / NEWS / FOTOS
═══════════════════════════════════════════════════════════════════════ -->
<section id="blog" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>News / Fotos</h2>
    </div>

    <div class="blog-grid" id="blog-grid">
      <!-- JS fills from /api/blog.php -->
      <div class="loading-spinner" style="grid-column:1/-1">
        <div class="spinner"></div> Beiträge werden geladen…
      </div>
    </div>

    <div class="load-more-wrap">
      <button id="btn-load-more" class="btn btn-primary">
        <i class="fa fa-repeat"></i> Mehr laden
      </button>
    </div>
  </div>
</section>

<!-- Fetzerl link -->
<div class="fetzerl-section">
  <div class="container">
    <a href="https://www.fetzerl.at/" target="_blank" rel="noopener">
      <img src="images/links/fetzarl.png" alt="Fetzerl" loading="lazy" style="max-width:280px; margin:0 auto">
    </a>
  </div>
</div>


<!-- ═══════════════════════════════════════════════════════════════════════
     FEATURE PANEL – Spendenaktionen
═══════════════════════════════════════════════════════════════════════ -->
<section class="feature-panel feature-panel--img" style="background-image:url(images/tourdeherz-bg.jpg)">
  <div class="container">

    <div style="text-align:center; margin-bottom:2.5rem" class="reveal">
      <span class="feature-badge">Spendenaktionen</span>
      <h2>Für den guten Zweck in die Pedale!</h2>
    </div>

    <div class="spenden-grid reveal">

      <!-- 2025 – zuerst -->
      <div class="spenden-card">
        <div style="margin-bottom:0.75rem; display:flex; align-items:center; gap:0.6rem">
          <span style="background:var(--color-nature); color:white; font-size:0.75rem; font-weight:700; padding:0.25rem 0.75rem; border-radius:20px; text-transform:uppercase; letter-spacing:0.08em">2025</span>
          <span style="font-size:0.8rem; color:#6b7280; font-style:italic">abgeschlossen – Danke!</span>
        </div>
        <h3 style="color:var(--color-primary); margin-bottom:0.25rem">18 Stunden Rad Challenge</h3>
        <p style="font-size:0.85rem; color:#6b7280; margin-bottom:1rem">Reutte, 24./25. Mai 2025</p>
        <p style="color:#374151">Als Skilehrer in Berwang durfte er einen kleinen Jungen im Bi-Ski begleiten – diese Begeisterung
           hat das Projekt angestossen.</p>
        <img src="images/bi-ski.jpg" alt="18h Rad Challenge 2025" loading="lazy"
             style="width:100%; height:auto; border-radius:8px; margin-bottom:1rem; display:block">
        <p style="color:#374151">Am 24. und 25. Mai 2025 radelte Christian 18 Stunden lang zwischen Reutte und Forchach, um Spenden für
           einen "Bi-Ski" zu sammeln – ein spezielles Skigerät mit Sitzschale, das Menschen mit Behinderung
           das Skifahren ermöglicht.</p>
        <p style="color:#374151">In der Nacht zwangen starker Regen, Kälte und Wind Christian zum vorzeitigen Abbruch nach elf Stunden – in den letzten Stunden war er nur noch mit wenigen Stundenkilometern unterwegs.</p>
        <hr style="border-color:#e5e7eb; margin:1rem 0">
        <p style="color:#374151">Insgesamt kamen <strong style="color:#374151">12.900 Euro</strong> zusammen – durch viele private Spender sowie einigen Grossspenden.</p>
        <div style="padding-top:1rem; display:flex; gap:1rem; align-items:center; flex-wrap:wrap">
          <a href="https://photos.app.goo.gl/YXuf8y4mDw8FfoGa6" target="_blank" rel="noopener"
             style="color:var(--color-accent); font-weight:600; font-size:0.9rem">
            <i class="fa fa-camera"></i> Fotoalbum
          </a>
        </div>
      </div>

      <!-- 2024 -->
      <div class="spenden-card">
        <div style="margin-bottom:0.75rem; display:flex; align-items:center; gap:0.6rem">
          <span style="background:var(--color-accent); color:white; font-size:0.75rem; font-weight:700; padding:0.25rem 0.75rem; border-radius:20px; text-transform:uppercase; letter-spacing:0.08em">2024</span>
          <span style="font-size:0.8rem; color:#6b7280; font-style:italic">abgeschlossen – Danke!</span>
        </div>
        <h3 style="color:var(--color-primary); margin-bottom:0.25rem">Tour de Herz unsupported</h3>
        <p style="font-size:0.85rem; color:#6b7280; margin-bottom:1rem">&#127937; 378,9 km · 2430 hm · Reutte, 08.06.2024</p>
        <img src="images/tourdeherz001.jpg" alt="Tour de Herz 2024" loading="lazy"
             style="width:100%; aspect-ratio:16/9; border-radius:8px; margin-bottom:1rem; object-fit:cover">
        <p style="color:#374151">Um 4:15 Uhr startete Christian in Steeg – 19 Runden zwischen Reutte und Weißenbach, 378,9 km und 2.430 Höhenmeter. Sein Ziel: die Strecke in 15,5 Stunden zu bewältigen, angelehnt an die klassische Tour de Herz Passau–Wien.</p>
        <p style="color:#374151">Begleitet von Radsportfreunden, seiner Frau an der Verpflegungsstation in Lechaschau und dem Paralympicsathleten Alexander Gritsch kämpfte er sich Kilometer für Kilometer durch. Bei rund 350 km zwang ihn ein schweres Gewitter mit Starkregen und Wind zum Abbruch.</p>
        <hr style="border-color:#e5e7eb; margin:1rem 0">
        <p style="color:#374151">Trotzdem: <strong style="color:#374151">€ 5.600 an Spenden</strong> – genug für mindestens eine Kinderherzoperation. <em>#allesistmöglich</em></p>
        <div style="margin-top:auto; display:flex; gap:1.5rem; align-items:center; flex-wrap:wrap">
          <a href="https://photos.app.goo.gl/npPXchDaFQWufoAB6" target="_blank" rel="noopener"
             style="color:var(--color-accent); font-weight:600; font-size:0.9rem">
            <i class="fa fa-camera"></i> Fotoalbum
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     BI-SKI
═══════════════════════════════════════════════════════════════════════ -->
<section id="biski" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>BiSki – Pistengaudi für alle mit Christian</h2>
    </div>
    <div class="biski-intro reveal">
      <p>Bi-Ski ist ein adaptives Skisystem, das Menschen mit körperlichen Einschränkungen das Skifahren ermöglicht. Zwei parallele Ski tragen einen Sitz, in dem der Fahrer sicher befestigt wird – gesteuert wird das Gerät von einem ausgebildeten Begleiter über Ausleger oder direkt vom Fahrer selbst. So erfahren Menschen mit Behinderungen das Gefühl von Geschwindigkeit, Freiheit und Natur auf der Piste.</p>
    </div>
    <div class="biski-galleries reveal">
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/jsgcedC6RWfDMtb9A" target="_blank" rel="noopener">
        <img src="images/biski/galerie1.jpg" alt="Bi-Ski Hahnenkamm" loading="lazy">
        <span><strong>Bi-Ski Hahnenkamm</strong><br>8. März 2026</span>
      </a>
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/VrPb5vL2f1nLsBnb7" target="_blank" rel="noopener">
        <img src="images/biski/galerie2.jpg" alt="Biski Thomas" loading="lazy">
        <span><strong>Biski Thomas</strong><br>13.–14. Februar 2026</span>
      </a>
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/KxEEwLb2KUjyxDB99" target="_blank" rel="noopener">
        <img src="images/biski/galerie3.jpg" alt="Biski Rob" loading="lazy">
        <span><strong>Biski Rob</strong><br>27. Feb. – 1. März 2026</span>
      </a>
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/qgXfu7kt2adLRjft7" target="_blank" rel="noopener">
        <img src="images/biski/galerie4.jpg" alt="Biski Huberbauerhof" loading="lazy">
        <span><strong>Biski Huberbauerhof</strong><br>14.–16. Jänner 2026</span>
      </a>
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/W1ZAzzK25YqUckWWA" target="_blank" rel="noopener">
        <img src="images/biski/galerie5.jpg" alt="Biski Isabel" loading="lazy">
        <span><strong>Biski Isabel</strong><br>9.–10. Jänner 2026</span>
      </a>
      <a class="biski-gallery-card" href="https://photos.app.goo.gl/qdwiWq41Q9HJ5VVX7" target="_blank" rel="noopener">
        <img src="images/biski/galerie6.jpg" alt="Biski Marco" loading="lazy">
        <span><strong>Biski Marco</strong><br>11. März 2026</span>
      </a>
    </div>
  </div>
</section>

<!-- Partner link – Skischule Berwang -->
<div class="partner-link-panel">
  <div class="container">
    <div class="reveal" style="text-align:center">
      <img src="images/links/skischule-berwang.jpg" alt="Skischule Berwang" loading="lazy" style="max-width:320px; margin:0 auto; border-radius:8px">
      <a href="https://skischule-berwang.at/" target="_blank" rel="noopener" style="display:block; margin-top:0.75rem; color:var(--color-primary); font-weight:700; font-size:1.1rem">www.skischule-berwang.at</a>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════
     ABOUT
═══════════════════════════════════════════════════════════════════════ -->
<section id="about-us" class="section-padding">
  <div class="container">
    <div class="about-grid">
      <div class="about-img-wrap reveal-left">
        <img class="about-img-main" src="images/foto_chritsch2.jpg" alt="Bergwanderführer Christian Tschernutter" loading="lazy">
        <img class="about-img-secondary" src="images/dachri.jpg" alt="Christian und Dagmar Tschernutter" loading="lazy">
      </div>
      <div class="about-text reveal">
        <h2>Über mich</h2>
        <p class="lead">Der Weg ist das Ziel!</p>
        <p>Schon als kleiner Kärntner Bub war ich sehr naturverbunden.
           Ob zu Fuß, mit dem Rad oder im Winter mit den Langlaufschiern und natürlich Alpin –
           ich war immer in der Natur zu finden.</p>
        <p>Durch meine Arbeit kam ich nach Tirol ins Außerfern und heiratete die Liebe meines Lebens.
           Die Liebe zur Natur teile ich seitdem mit meinen Gästen.</p>
        <div style="margin-top:1.5rem">
          <p><strong>Christian Tschernutter</strong></p>
          <p>Tiroler Bergwanderführer und Mountainbike-Guide</p>
          <p>Höhenarbeiter und Seilzugstechniker</p>
          <p>Skilehrer Alpin und Langlauf</p>
          <p>No Handicap Skilauf</p>
        </div>
        <a href="#contact" class="btn btn-outline" style="margin-top:1.5rem; background:var(--color-accent); border-color:var(--color-accent)">
          Kontakt aufnehmen
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     TEAM / AUSBILDUNG
═══════════════════════════════════════════════════════════════════════ -->
<section id="team" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>Meine Ausbildung</h2>
    </div>

    <div class="credentials-grid">

      <div class="credential-card reveal reveal-delay-1">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/9.jpg" alt="Snowbike Workshop" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Snowbike Workshop</h3>
          <div class="year">2023</div>
          <a href="https://snowbike.com/" target="_blank" rel="noopener">Snowbike</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-2">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/8.jpg" alt="Höhenarbeiter und Seilzugstechniker" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Höhenarbeiter &amp; Seilzugstechniker</h3>
          <div class="year">2019</div>
          <a href="https://irata.org/" target="_blank" rel="noopener">Irata</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-3">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/6.jpg" alt="Nordic Walking Trainer" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Nordic Walking Trainer</h3>
          <div class="year">2018</div>
          <a href="https://www.nordicfit.com/" target="_blank" rel="noopener">Nordicfit Academy</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-4">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/4.jpg" alt="E-Bike Guide" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>E-Bike Guide</h3>
          <div class="year">2016</div>
          <a href="http://www.bikepro.at" target="_blank" rel="noopener">VÖR</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-1">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/5.jpg" alt="Skilehrer" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Skilehrer</h3>
          <div class="year">2016</div>
          <a href="http://www.snowsporttirol.at/ausbildung/skilehrerausbildung/" target="_blank" rel="noopener">Tiroler Skilehrerverband</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-2">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/3.jpg" alt="Langlauflehrer Tirol" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Langlauflehrer</h3>
          <div class="year">2015</div>
          <a href="http://www.snowsporttirol.at/ausbildung/langlauf/" target="_blank" rel="noopener">Tiroler Skilehrerverband</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-3">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/1.jpg" alt="Bergwanderführer Tirol" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Bergwanderführer</h3>
          <div class="year">2015</div>
          <a href="http://www.bergsportfuehrer-tirol.at/tirol/wanderfuehrer/" target="_blank" rel="noopener">Tiroler BSFV</a>
        </div>
      </div>

      <div class="credential-card reveal reveal-delay-4">
        <div class="credential-card__img-wrap"><img class="credential-card__img" src="images/team/2.jpg" alt="Mountainbike-Guide" loading="lazy"></div>
        <div class="credential-card__body">
          <h3>Mountainbike-Guide</h3>
          <div class="year">2012</div>
          <a href="http://www.bikepro.at" target="_blank" rel="noopener">VÖR</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     PARTNER LOGOS TOP (Zugspitz, Reutte, TripAdvisor, Jochen Schweizer)
═══════════════════════════════════════════════════════════════════════ -->
<div class="partner-logos-top">
  <div class="container">
    <div class="partner-logos-row reveal">
      <span class="logo-circle">
        <img src="images/zugspitzarena.jpg" alt="Tiroler Zugspitz Arena" loading="lazy">
      </span>
      <span class="logo-circle">
        <img src="images/reutte-logo.png" alt="Naturparkregion Reutte" loading="lazy">
      </span>
      <a class="logo-circle" href="https://www.tripadvisor.at/" target="_blank" rel="noopener">
        <img src="images/tripadvisor-logo.png"
             alt="TripAdvisor" loading="lazy">
      </a>
      <a class="logo-circle" href="https://www.jochen-schweizer.at/geschenkidee/wandertour-huettenuebernachtung,default,pd.html"
         target="_blank" rel="noopener">
        <img src="images/logo_Jochen_Schweizer.png" alt="Jochen Schweizer" loading="lazy">
      </a>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════════════════
     PORTFOLIO / AKTIVITÄTEN
═══════════════════════════════════════════════════════════════════════ -->
<section id="portfolio" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>Aktivitäten</h2>
    </div>

    <div class="portfolio-filters reveal">
      <button class="portfolio-filter-btn" data-filter="all">Alle</button>
      <button class="portfolio-filter-btn" data-filter="summer">Sommer</button>
      <button class="portfolio-filter-btn" data-filter="winter">Winter</button>
    </div>

    <div class="portfolio-grid" id="portfolio-grid">
      <!-- JS fills from /api/portfolio.php -->
      <div class="loading-spinner" style="grid-column:1/-1">
        <div class="spinner"></div> Aktivitäten werden geladen…
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════════
     WETTER
═══════════════════════════════════════════════════════════════════════ -->
<section id="weather">
  <div class="container">
    <h2>Wetter</h2>
    <iframe
      src="https://www.meteoblue.com/de/wetter/widget/daily/reutte-in-tirol_%c3%96sterreich_2767511?geoloc=fixed&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&days=5&coloured=monochrome&pictoicon=1&maxtemperature=1&mintemperature=1&windspeed=0&windgust=0&winddirection=0&uv=0&humidity=0&precipitation=1&precipitationprobability=0&spot=0&pressure=0&layout=dark"
      frameborder="0"
      scrolling="NO"
      allowtransparency="true"
      sandbox="allow-same-origin allow-scripts allow-popups"
      title="Wetter Reutte – Meteoblue"
      loading="lazy"
      style="width:100%; max-width:420px; height:250px; border-radius:12px; display:block; margin:0 auto">
    </iframe>
    <div style="text-align:center; margin-top:0.5rem">
      <a href="https://www.meteoblue.com/de/wetter/vorhersage/woche/reutte-in-tirol_%c3%96sterreich_2767511"
         target="_blank" rel="noopener" style="color:rgba(255,255,255,0.7); font-size:0.8rem">
        www.meteoblue.com
      </a>
    </div>
  </div>
</section>



<!-- ═══════════════════════════════════════════════════════════════════════
     TEAMEVENTS
═══════════════════════════════════════════════════════════════════════ -->
<section class="teamevents-section">
  <div class="container">
    <img src="images/teamevents.jpg" alt="Teamevents Teambuilding" loading="lazy">
    <h2>Teamevents – Teambuilding</h2>
    <p>Im Team mit Kollegen oder Kunden. Sommer und Winter.</p>
    <a href="https://photos.app.goo.gl/NSWGWqyjjP1ua5n3A" target="_blank" rel="noopener" class="teamevents-gallery-link">
      <i class="fa fa-camera"></i> Fotoalbum ansehen
    </a>
  </div>
</section>



<!-- ═══════════════════════════════════════════════════════════════════════
     SEILWERKER PANEL
═══════════════════════════════════════════════════════════════════════ -->
<div class="seilwerker-panel">
  <div class="container">
    <div class="seilwerker-inner reveal">
      <a href="https://www.seilwerker.at/" target="_blank" rel="noopener" class="seilwerker-text">
        <img src="images/links/seilwerker.png" alt="Seilwerker" loading="lazy" style="max-width:200px; margin:0 auto 1rem; background:#fff; padding:0.75rem; border-radius:8px;">
        <div class="seilwerker-text">
          <a href="https://www.seilwerker.at/" target="_blank" rel="noopener">www.seilwerker.at</a>
        </div>
      </a>
      <img src="images/seil.jpg" alt="Arbeiten am Seil" loading="lazy" style="max-width:300px; border-radius:12px">
    </div>
  </div>
</div>



<!-- ═══════════════════════════════════════════════════════════════════════
     PARTNER
═══════════════════════════════════════════════════════════════════════ -->
<section id="partner" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>Partner</h2>
    </div>
    <div class="partner-flex reveal">
      <a href="https://bernhardseck.at/" target="_blank" rel="noopener">
        <img src="images/links/Bernhardseckhütte.png" alt="Bernhardseckhütte" loading="lazy">
      </a>
      <a href="http://www.ernberg.at" target="_blank" rel="noopener">
        <img src="images/links/Alpenhotel_Ernberg.png" alt="Alpenhotel Ernberg" loading="lazy">
      </a>
      <a href="https://www.patisserie-susanne.at/" target="_blank" rel="noopener">
        <img src="images/links/naschwerk.png" alt="Patisserie Susanne" loading="lazy">
      </a>
      <a href="https://www.grubigbike.com/" target="_blank" rel="noopener">
        <img src="images/links/grubigbike.png" alt="Grubigbike" loading="lazy">
      </a>
      <a href="https://www.juwelier-seitz.at/" target="_blank" rel="noopener">
        <img src="images/links/juwelier-seitz.jpg" alt="Juwelier Seitz" loading="lazy">
      </a>
      <a href="https://www.garmin.com/de-AT/" target="_blank" rel="noopener">
        <img src="images/links/garmin.jpg" alt="Garmin" loading="lazy">
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     KONTAKT
═══════════════════════════════════════════════════════════════════════ -->
<section id="contact" class="section-padding">
  <div class="container">
    <div class="section-heading reveal">
      <h2>Kontakt</h2>
    </div>

    <div class="contact-grid">

      <!-- Form -->
      <div class="reveal-left">
        <form id="contact-form" novalidate>
          <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Dein Name" required>
            </div>
            <div class="form-group">
              <label for="email">E-Mail *</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="deine@email.at" required>
            </div>
          </div>
          <div class="form-group">
            <label for="betreff">Betreff *</label>
            <input type="text" id="betreff" name="subject" class="form-control" placeholder="Betreff" required>
          </div>
          <div class="form-group">
            <textarea id="message" name="message" class="form-control" rows="5"
                      placeholder="Deine Nachricht …" required></textarea>
          </div>
          <div class="form-group">
            <label class="form-checkbox">
              <input type="checkbox" required>
              <span>Ich stimme der <a href="downloads/Datenschutzerklärung_18.pdf" target="_blank" style="color:var(--color-accent)">Datenschutzerklärung</a> zu *</span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%">Abschicken</button>
          <div id="form-status" class="form-status" role="alert" aria-live="polite"></div>
        </form>
      </div>

      <!-- Info -->
      <div class="contact-info reveal">
        <ul>
          <li><strong>Christian Tschernutter</strong></li>
          <li><i class="fa fa-map-marker"></i> <span>Alpenbadstr. 15a, 6600 Reutte – Tirol</span></li>
          <li><i class="fa fa-phone"></i> <a href="tel:+4365024117060">+43 650 2411760</a></li>
          <li><i class="fa fa-envelope"></i> <a href="mailto:christian.tschernutter@a1.net">christian.tschernutter@a1.net</a></li>
          <li><i class="fa fa-globe"></i> <a href="https://www.chritsch.at">www.chritsch.at</a></li>
        </ul>
        <div class="contact-logos">
          <div class="contact-logos-row">
            <img src="images/Logo-Bergwanderfuehrer.png" alt="Bergwanderführer Tirol" loading="lazy">
            <img src="images/siegelnwbi2018.png"          alt="Nordic Walking Trainer" loading="lazy">
            <img src="images/mydayspartner.png"           alt="Mydays Partner"         loading="lazy" style="transform:rotate(12deg)">
          </div>
          <div class="contact-logos-row">
            <img src="images/logo_skilehrer.jpg" alt="Tiroler Skilehrer" loading="lazy">
            <img src="images/logo_irata.jpg"     alt="IRATA"             loading="lazy">
          </div>
          <div class="contact-logos-row">
            <img src="images/logo_bikepro.jpg" alt="BikePro" loading="lazy">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════════════════════════════ -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <p>Folge mir und gewinne weitere Eindrücke von meinen Touren!</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/chritsch.at" target="_blank" rel="noopener" aria-label="Facebook">
          <i class="fa fa-facebook"></i>
        </a>
        <a href="https://www.instagram.com/chritsch_outdoor_workonrope" target="_blank" rel="noopener" aria-label="Instagram">
          <i class="fa fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/user/ChritschMtbGuide" target="_blank" rel="noopener" aria-label="YouTube">
          <i class="fa fa-youtube"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="footer-bottom container">
    <p>&copy; 2016-<?php echo date('Y'); ?> Chritsch – Christian Tschernutter</p>
    <p>
      <a href="downloads/Datenschutzerklärung_18.pdf" target="_blank">Datenschutz</a> &nbsp;|&nbsp;
      <a href="downloads/agbs_17.pdf" target="_blank">AGBs</a>
    </p>
  </div>
</footer>

<!-- Visually hidden helper -->
<style>.visually-hidden{position:absolute;width:1px;height:1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}</style>

<!-- App JS -->
<script src="js/app.js?v=2" defer></script>

</body>
</html>
