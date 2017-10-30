<?php

class SiamTahunRepo {
  public static function all() {
    global $wpdb;

    return $wpdb->get_col('select `text` from '.$wpdb->prefix.'si_tahun order by `text` asc', 0);
  }

  public static function select() {
    global $wpdb;

    return $wpdb->get_results('select `id`, `text` from '.$wpdb->prefix.'si_tahun order by `text` asc', ARRAY_A);
  }

  public static function insert($text) {
    global $wpdb;

    return $wpdb->insert($wpdb->prefix.'si_tahun', array(
      'text' => $text
    ));
  }

  public static function delete($id) {
    global $wpdb;
    
    return $wpdb->delete($wpdb->prefix.'si_tahun', array(
      'id' => $id
    ));
  }
}