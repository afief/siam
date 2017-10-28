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
}
add_action('admin_menu', 'siam_menus_options');