<?php

class SiamMutuRepo {
  public static function all() {
    global $wpdb;

    $aspeks = $wpdb->get_results('SELECT `id`, `text` FROM `'.$wpdb->prefix.'si_aspek` WHERE deleted = 0', ARRAY_A);

    foreach ($aspeks as &$aspek) {
      $aspek['list'] = self::getMutus($aspek['id']);
    }

    return $aspeks;
  }

  public static function get($id) {
    global $wpdb;

    return $wpdb->get_row(
      $wpdb->prepare('select `id`, `aspek_id`, `text`, `keterangan` from '.$wpdb->prefix.'si_mutu where deleted = 0 and id = %d', $id)
    ); 
  }

  public static function update($id, $aspekId, $text, $keterangan) {
    global $wpdb;

    return $wpdb->update($wpdb->prefix.'si_mutu', array(
      'aspek_id' => $aspekId,
      'text' => $text,
      'keterangan' => $keterangan
    ), array(
      'id' => $id
    ), array('%s'), array('%d'));
  }

  public static function insert($aspekId, $text, $keterangan) {
    global $wpdb;

    return $wpdb->insert($wpdb->prefix.'si_mutu', array(
      'aspek_id' => $aspekId,
      'text' => $text,
      'keterangan' => $keterangan
    ));
  }

  public static function delete($id) {
    global $wpdb;
    
    return $wpdb->update($wpdb->prefix.'si_mutu', array(
      'deleted' => 1
    ), array(
      'id' => $id
    ));
  }

  public static function getMutus($aspekId) {
    global $wpdb;

    $mutus = $wpdb->get_results(
      $wpdb->prepare('SELECT * FROM `'.$wpdb->prefix.'si_mutu` WHERE aspek_id = %d AND deleted = 0', $aspekId)
    , ARRAY_A);
    foreach ($mutus as &$mutu) {
      $mutu['sasaran'] = $wpdb->get_results(
        $wpdb->prepare('SELECT `tahun`, `nilai` FROM `'.$wpdb->prefix.'si_sasaran` WHERE mutu_id = %s ORDER BY `tahun` ASC', $mutu['id'])
      , ARRAY_A);
      $mutu['sasaran'] = self::tahunAsKey($mutu['sasaran']);

      $mutu['capaian'] = $wpdb->get_results(
        $wpdb->prepare('SELECT `tahun`, `nilai` FROM `'.$wpdb->prefix.'si_capaian` WHERE mutu_id = %s ORDER BY `tahun` ASC', $mutu['id'])
      , ARRAY_A);
      $mutu['capaian'] = self::tahunAsKey($mutu['capaian']);

      $mutu['audit'] = $wpdb->get_results(
        $wpdb->prepare('SELECT `tahun`, `nilai` FROM `'.$wpdb->prefix.'si_audit` WHERE mutu_id = %s ORDER BY `tahun` ASC', $mutu['id'])
      , ARRAY_A);
      $mutu['audit'] = self::tahunAsKey($mutu['audit']);
    }
    return $mutus;
  }

  public static function tahunAsKey($values) {
    $tahuns = SiamTahunRepo::all();
    $result = array();
    foreach ($values as $value) {
      $result[$value['tahun']] = $value['nilai'];
    }
    foreach ($tahuns as $tahun) {
      if (!isset($result[$tahun])) {
        $result[$tahun] = '';
      }
    }
    return $result;
  }

  public static function saveSasaran($data) {
    global $wpdb;

    foreach ($data as $key => $value) {
      if (substr($key, 0, 4) == 'mutu') {
        $ar = explode('_', $key);
        $exists = $wpdb->get_row(
          $wpdb->prepare('select id from '.$wpdb->prefix.'si_sasaran where tahun = %s and mutu_id = %d', $ar[2], $ar[1])
        );
        if ($exists) {
           $wpdb->update($wpdb->prefix.'si_sasaran', array(
            'nilai' => $value
          ), array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2]
          ));
        } else {
          $wpdb->insert($wpdb->prefix.'si_sasaran', array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2],
            'nilai' => $value
          ));
        }
      }
    }
  }

  public static function saveCapaian($data) {
    global $wpdb;

    foreach ($data as $key => $value) {
      if (substr($key, 0, 4) == 'mutu') {
        $ar = explode('_', $key);
        $exists = $wpdb->get_row(
          $wpdb->prepare('select id from '.$wpdb->prefix.'si_capaian where tahun = %s and mutu_id = %d', $ar[2], $ar[1])
        );
        if ($exists) {
           $wpdb->update($wpdb->prefix.'si_capaian', array(
            'nilai' => $value
          ), array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2]
          ));
        } else {
          $wpdb->insert($wpdb->prefix.'si_capaian', array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2],
            'nilai' => $value
          ));
        }
      }
    }
  }

  public static function saveAudit($data) {
    global $wpdb;

    foreach ($data as $key => $value) {
      if (substr($key, 0, 4) == 'mutu') {
        $ar = explode('_', $key);
        $exists = $wpdb->get_row(
          $wpdb->prepare('select id from '.$wpdb->prefix.'si_audit where tahun = %s and mutu_id = %d', $ar[2], $ar[1])
        );
        if ($exists) {
           $wpdb->update($wpdb->prefix.'si_audit', array(
            'nilai' => $value
          ), array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2]
          ));
        } else {
          $wpdb->insert($wpdb->prefix.'si_audit', array(
            'mutu_id' => $ar[1],
            'tahun' => $ar[2],
            'nilai' => $value
          ));
        }
      }
    }
  }
}