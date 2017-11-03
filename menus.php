<?php

require_once('pages.php');

function siam_menu_utama()
{
  add_menu_page(
    'Mutu Program Studi',
    'Mutu Prodi',
    'siam_role_mutu',
    'mutu-prodi',
    'siam_page_mutu_prodi',
    'dashicons-universal-access-alt',
    30
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Sasaran Mutu',
    'Form Sasaran Mutu',
    'siam_role_mutu',
    'mutu-prodi-sasaran',
    'siam_page_mutu_prodi_sasaran',
    '',
    31
  );

  add_submenu_page(
    'mutu-prodi',
    'Form Capaian Mutu',
    'Form Capaian Mutu',
    'siam_role_mutu',
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
    'siam_role_mutu',
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
    'siam_role_mutu',
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
    'siam_role_mutu',
    'siam-options-mutu',
    'siam_page_daftar_mutu',
    '',
    41
  );

  /* Daftar Aspek */
  add_submenu_page(
    'siam-options',
    'Daftar Tahun',
    'Daftar Tahun',
    'siam_role_mutu',
    'siam-options-tahun',
    'siam_page_daftar_tahun',
    '',
    41
  );

  remove_submenu_page('siam-options', 'siam-options');
}

function siam_menu_audit() {
  add_menu_page(
    'Auditor',
    'Auditor',
    'siam_role_audit',
    'siam-audit',
    null,
    'dashicons-analytics',
    33
  );

  add_submenu_page(
    'siam-audit',
    'Audit Mutu',
    'Audit Mutu',
    'siam_role_audit',
    'mutu-prodi-audit',
    'siam_page_audit',
    '',
    34
  );

  add_submenu_page(
    'siam-audit',
    'Form Audit Mutu',
    'Form Audit Mutu',
    'siam_role_audit',
    'mutu-prodi-audit-form',
    'siam_page_audit_form',
    '',
    34
  );

  remove_submenu_page('siam-audit', 'siam-audit');
}


add_action('admin_menu', 'siam_menu_utama');
add_action('admin_menu', 'siam_menu_audit');
add_action('admin_menu', 'siam_menu_setting');



/* TOOLBAR */
function siam_admin_bar( $wp_admin_bar ) {
  global $wp_admin_bar;

  $user = wp_get_current_user();
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    if ( in_array( 'auditor', $user->roles ) ) {
      $args = array(
        'id'    => 'siam_bar_audit',
        'title' => 'Audit Mutu',
        'href'  => get_admin_url() . 'admin.php?page=mutu-prodi-audit'
      );
      $wp_admin_bar->add_node( $args );
    } else if ( in_array( 'operator', $user->roles ) ) {
      $args = array(
        'id'    => 'siam_bar_mutu',
        'title' => 'Sasaran Mutu Prodi',
        'href'  => get_admin_url() . 'admin.php?page=mutu-prodi'
      );
      $wp_admin_bar->add_node( $args );
    } else if (count($user->roles) > 0) {
      $args = array(
        'id'    => 'siam_bar_mutu',
        'title' => 'Sasaran Mutu Prodi',
        'href'  => get_admin_url() . 'admin.php?page=mutu-prodi'
      );
      $wp_admin_bar->add_node( $args );
      $args = array(
        'id'    => 'siam_bar_audit',
        'title' => 'Audit Mutu',
        'href'  => get_admin_url() . 'admin.php?page=mutu-prodi-audit'
      );
      $wp_admin_bar->add_node( $args );
    }
  }
}
add_action( 'admin_bar_menu', 'siam_admin_bar', 999 );

function siam_hide_update_info() {
  $user = wp_get_current_user();
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    if ( in_array( 'auditor', $user->roles ) || in_array( 'operator', $user->roles ) ) {
      ?>
      <style type="text/css">
        .update-nag { display: none; }
      </style>
      <?php
    }
  }
}
add_action( 'admin_head', 'siam_hide_update_info', 1 );