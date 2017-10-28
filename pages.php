<?php

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