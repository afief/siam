<?php

require_once('pages.php');

function siam_menus_options()
{
  add_menu_page(
    'Mutu Program Studi',
    'Mutu Prodi',
    'manage_options',
    'mutu-prodi',
    'siam_page_mutu_prodi',
    '',
    20
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Sasaran Mutu',
    'Form Sasaran Mutu',
    'manage_options',
    'mutu-prodi-sasaran',
    'siam_page_mutu_prodi_sasaran',
    '',
    20
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Capaian Mutu',
    'Form Capaian Mutu',
    'manage_options',
    'mutu-prodi-capaian',
    'siam_page_mutu_prodi_capaian',
    '',
    20
  );
}
add_action('admin_menu', 'siam_menus_options');