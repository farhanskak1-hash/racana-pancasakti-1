<?php
// Vercel serverless entry point. Keep the public directory as Laravel's web root.
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/../public/index.php';
