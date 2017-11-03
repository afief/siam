<?php

function siam_plugin_loaded() {
  global $pagenow;

  if (($pagenow == 'admin.php') && isset($_GET['download'])) {
    if ($_GET['download'] == 'mutu-prodi') {
      include SIAM_DIR . '/downloads/mutu-prodi.php';
      exit;
    }
    if ($_GET['download'] == 'audit-mutu') {
      include SIAM_DIR . '/downloads/audit-mutu.php';
      exit;
    }
  }
}

add_action('plugins_loaded', 'siam_plugin_loaded');