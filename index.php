<?php 
header('X-Frame-Options: DENY');
// Setting waktu Indonesia
date_default_timezone_set('Asia/Jakarta');

// Ambil file index di public
require_once('public/index.php');