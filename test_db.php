<?php
require_once __DIR__.'/config/db.php';
header('Content-Type: text/html; charset=utf-8');
$count=(int)$conn->query('SELECT COUNT(*) AS n FROM users')->fetch_assoc()['n'];
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Database Test</title><link rel="stylesheet" href="assets/css/style1.css"></head><body><main class="section-pad"><div class="container narrow-container"><div class="form-card"><p class="eyebrow">CONNECTION CHECK</p><h1>Database test</h1><div class="flash success">Connected successfully to <strong>studenthub_db</strong>.</div><p>Registered account count: <strong><?=$count?></strong></p><a class="btn btn-primary" href="index.php">Open StudentHub ↗</a><p class="field-hint">For security, remove or restrict this diagnostic file before any public deployment.</p></div></div></main></body></html>
