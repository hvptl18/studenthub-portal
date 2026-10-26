<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Home';
require __DIR__ . '/includes/header.php';
?>
<section class="hero-section">
  <div class="container hero-grid">
    <div class="hero-copy">
      <p class="eyebrow"><span class="eyebrow-dot"></span> YOUR CAMPUS, CONNECTED</p>
      <h1>Make your student life <em>count.</em></h1>
      <p class="hero-lead">One welcoming space to discover campus events, stay informed, manage your profile and find your next opportunity.</p>
      <div class="hero-actions"><a class="btn btn-primary" href="<?= is_logged_in()?'dashboard.php':'register.php' ?>"><?= is_logged_in()?'Go to dashboard':'Get started' ?> <span>↗</span></a><a class="btn btn-outline" href="events.php">Explore events</a></div>
      <div class="hero-proof"><div class="avatar-stack"><span>H</span><span>A</span><span>R</span><span>+</span></div><p><strong>One hub.</strong><br>More ways to get involved.</p></div>
    </div>
    <div class="hero-visual">
      <div class="visual-orbit orbit-one"></div><div class="visual-orbit orbit-two"></div>
      <div class="hero-card main-visual-card"><div class="visual-top"><span class="pill pill-light">CAMPUS LIFE</span><span>✳</span></div><div class="illustration"><div class="sun"></div><div class="hill hill-back"></div><div class="hill hill-front"></div><div class="book book-one"></div><div class="book book-two"></div><div class="plant">♣</div></div><div class="visual-bottom"><div><small>YOUR NEXT CHAPTER</small><h3>Starts here.</h3></div><span class="round-arrow">↗</span></div></div>
      <div class="floating-note"><span class="note-icon">✓</span><div><strong>You're in the loop</strong><small>Updates, all in one place</small></div></div>
      <div class="floating-date"><small>NEXT UP</small><strong>Campus events</strong><span>Find your people →</span></div>
    </div>
  </div>
</section>
<section class="stats-strip"><div class="container stats-grid"><div><strong>01</strong><span>Student-first design</span></div><div><strong>02</strong><span>Simple, useful tools</span></div><div><strong>03</strong><span>Opportunities to explore</span></div><div><strong>04</strong><span>One connected campus</span></div></div></section>
<section class="section-pad"><div class="container"><div class="section-heading"><div><p class="eyebrow">WHAT YOU CAN DO</p><h2>A little more <em>connected.</em></h2></div><p>Everything you need to keep campus life organised, accessible and interesting.</p></div>
  <div class="feature-grid">
    <article class="feature-card"><span class="feature-icon">◈</span><h3>Your dashboard</h3><p>See your account details and find your way to key student resources.</p><a href="<?= is_logged_in()?'dashboard.php':'login.php' ?>" class="text-link">Open dashboard ↗</a></article>
    <article class="feature-card feature-card-highlight"><span class="feature-icon">✳</span><h3>Campus events</h3><p>Browse workshops, seminars and student activities with easy search and filters.</p><a href="events.php" class="text-link">Browse events ↗</a></article>
    <article class="feature-card"><span class="feature-icon">⌘</span><h3>Student community</h3><p>Keep your profile up to date and stay in touch with campus announcements.</p><a href="profile.php" class="text-link">Your profile ↗</a></article>
  </div>
</div></section>
<section class="slider-section"><div class="container slider-panel"><div class="slider-copy"><p class="eyebrow">A CAMPUS FULL OF POSSIBILITIES</p><h2 id="slideTitle">Learn something new.</h2><p id="slideText">Join a workshop, ask questions and turn your curiosity into a project.</p><div class="slider-controls"><button id="slidePrev" aria-label="Previous slide" type="button">←</button><div id="slideDots" class="slider-dots"></div><button id="slideNext" aria-label="Next slide" type="button">→</button></div></div><div class="slider-art" id="sliderArt"><div class="art-circle"></div><div class="art-card art-card-a">✦<small>IDEAS</small></div><div class="art-card art-card-b">↗<small>GROWTH</small></div><div class="art-card art-card-c">⌘<small>COMMUNITY</small></div></div></div></section>
<section class="section-pad"><div class="container cta-panel"><div><p class="eyebrow">YOUR NEXT STEP</p><h2>Make room for <em>what's next.</em></h2><p>Create your account and start exploring StudentHub.</p></div><a class="btn btn-light" href="<?= is_logged_in()?'dashboard.php':'register.php' ?>"><?= is_logged_in()?'Visit dashboard':'Create your account' ?> ↗</a></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
