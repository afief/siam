<?php

/*
Plugin Name: Sistem Informasi Audit Mutu
Description: Penginputan sasaran, capaian, dan hasil audit mutu.
Author: Afief Yona Ramadhana
Version: 0.0.1
Author URI: http://afief.net
License: CC BY-NC 3.0
Text Domain: si-audit-mutu
*/

if (!defined('SIAM_FILE')) {
  define('SIAM_FILE', __FILE__);
}

require_once('events/activation.php');
require_once('menus.php');