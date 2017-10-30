<?php

/* Mutu Prodi */
function siam_page_mutu_prodi() {
  $tahuns = SiamTahunRepo::all();
  $mutus = SiamMutuRepo::all();

  include('views/mutu-prodi.php');
}

function siam_page_mutu_prodi_sasaran() {
  $aspeks = AspekRepo::all();
  $tahuns = SiamTahunRepo::all();

  if (isset($_POST['sasaran_submit'])) {
    SiamMutuRepo::saveSasaran($_POST);
  }

  $aspekId = isset($_GET['aspek_id']) ? $_GET['aspek_id'] : $aspeks[0]['id'];
  $mutus = SiamMutuRepo::getMutus($aspekId);

  include('views/mutu-prodi-sasaran.php');
}

function siam_page_mutu_prodi_capaian() {
  $aspeks = AspekRepo::all();
  $tahuns = SiamTahunRepo::all();

  if (isset($_POST['capaian_submit'])) {
    SiamMutuRepo::saveCapaian($_POST);
  }

  $aspekId = isset($_GET['aspek_id']) ? $_GET['aspek_id'] : $aspeks[0]['id'];
  $mutus = SiamMutuRepo::getMutus($aspekId);

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
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit') {
      return siam_page_daftar_mutu_edit();
    }
  }
  if (isset($_POST['mutu_submit'])) {
    SiamMutuRepo::insert($_POST['aspek_id'], $_POST['mutu_text'], $_POST['mutu_keterangan']);
  } else if (isset($_GET['delete'])) {
    SiamMutuRepo::delete($_GET['delete']);
  }
  $aspek = AspekRepo::all();
  $mutus = SiamMutuRepo::all();
  include('views/setting-mutu.php');
}

function siam_page_daftar_mutu_edit() {
  if (isset($_POST['mutu_edit_submit'])) {
    SiamMutuRepo::update($_GET['id'], $_POST['aspek_id'], $_POST['mutu_text'], $_POST['mutu_keterangan']);
    return siam_redirect(get_admin_urL() . 'admin.php?page=siam-options-mutu');
  }
  $aspek = AspekRepo::all();
  $mutu = SiamMutuRepo::get($_GET['id']);
  include('views/setting-mutu-edit.php'); 
}

function siam_page_daftar_tahun() {
  if (isset($_POST['tahun_submit'])) {
    SiamTahunRepo::insert($_POST['tahun_text']);
  } else if (isset($_GET['delete'])) {
    SiamTahunRepo::delete($_GET['delete']);
  }
  $tahuns = SiamTahunRepo::select();
  include('views/setting-tahun.php');
}

function siam_page_audit() {
  $tahuns = SiamTahunRepo::all();
  $mutus = SiamMutuRepo::all();

  include('views/mutu-prodi-audit.php');
}

function siam_page_audit_form() {
  $aspeks = AspekRepo::all();
  $tahuns = SiamTahunRepo::all();

  if (isset($_POST['audit_submit'])) {
    SiamMutuRepo::saveAudit($_POST);
  }

  $aspekId = isset($_GET['aspek_id']) ? $_GET['aspek_id'] : $aspeks[0]['id'];
  $mutus = SiamMutuRepo::getMutus($aspekId);

  include('views/mutu-prodi-audit-form.php');
}
