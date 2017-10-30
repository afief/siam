<?php

/*
Plugin Name: Sistem Informasi Audit Mutu
Description: Penginputan sasaran, capaian, dan hasil audit mutu.
Author: Afief Yona Ramadhana
Version: 0.5.1
Author URI: http://afief.net
License: CC BY-NC 3.0
Text Domain: si-audit-mutu
*/

if (!defined('SIAM_FILE')) {
  define('SIAM_FILE', __FILE__);
}

if (!defined('SIAM_URL')) {
  define('SIAM_URL', plugin_dir_url(__FILE__));
}

require_once('functions.php');

require_once('repositories/AspekRepo.php');
require_once('repositories/TahunRepo.php');
require_once('repositories/MutuRepo.php');

require_once('events/login.php');
require_once('events/activation.php');
require_once('menus.php');