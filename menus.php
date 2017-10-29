<?php

require_once('pages.php');

function siam_menu_utama()
{
  add_menu_page(
    'Mutu Program Studi',
    'Mutu Prodi',
    'manage_options',
    'mutu-prodi',
    'siam_page_mutu_prodi',
    'dashicons-universal-access-alt',
    30
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Sasaran Mutu',
    'Form Sasaran Mutu',
    'manage_options',
    'mutu-prodi-sasaran',
    'siam_page_mutu_prodi_sasaran',
    '',
    31
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Capaian Mutu',
    'Form Capaian Mutu',
    'manage_options',
    'mutu-prodi-capaian',
    'siam_page_mutu_prodi_capaian',
    '',
    32
  );
}

function siam_menu_setting() {
  add_menu_page(
    'SIAM Pengaturan',
    'SIAM Pengaturan',
    'manage_options',
    'siam-options',
    null,
    'dashicons-forms',
    40
  );

  /* Daftar Aspek */
  add_submenu_page(
    'siam-options',
    'Daftar Aspek',
    'Daftar Aspek',
    'manage_options',
    'siam-options-aspek',
    'siam_page_daftar_aspek',
    '',
    41
  );

  /* Mutu Prodi */
  add_submenu_page(
    'siam-options',
    'Daftar Mutu Prodi',
    'Daftar Mutu Prodi',
    'manage_options',
    'siam-options-mutu',
    'siam_page_daftar_mutu',
    '',
    41
  );

  remove_submenu_page('siam-options', 'siam-options');
}


add_action('admin_menu', 'siam_menu_utama');
add_action('admin_menu', 'siam_menu_setting');