<?php

/* Mutu Prodi */
function siam_page_mutu_prodi() {
  $tahuns = SiamTahunRepo::all();
  $mutus = SiamMutuRepo::all();

  include('views/mutu-prodi.php');
}

function siam_page_mutu_prodi_sasaran() {
  $tahuns = SiamTahunRepo::all();
  $mutus = SiamMutuRepo::all();

  include('views/mutu-prodi-sasaran.php');
}

function siam_page_mutu_prodi_capaian() {
  $tahuns = SiamTahunRepo::all();
  $mutus = SiamMutuRepo::all();

  include('views/mutu-prodi-capaian.php');
}


/* Pengaturan */
function siam_page_daftar_aspek() {
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit') {
      return siam_page_daftar_aspek_edit();
    }
  }
  if (isset($_POST['aspek_submit'])) {
    $text = $_POST['aspek_text'];
    if ($text) {
      AspekRepo::insert($text);
    }
  } else if (isset($_GET['delete'])) {
    AspekRepo::delete($_GET['delete']);
  }

  $aspek = AspekRepo::all();
  include('views/setting-aspek.php');
}

function siam_page_daftar_aspek_edit() {
  $aspekId = $_GET['id'];
  if (isset($_POST['aspek_edit_submit'])) {
    $text = $_POST['aspek_text'];
    if ($text) {
      AspekRepo::update($aspekId, $text);

      return siam_redirect(get_admin_urL() . 'admin.php?page=siam-options-aspek');
    }
  }
  $aspek = AspekRepo::get($aspekId);
  include('views/setting-aspek-edit.php'); 
}


function siam_page_daftar_mutu() {
  $aspek = AspekRepo::all();
  $mutus = SiamMutuRepo::all();
  include('views/setting-mutu.php');
}
