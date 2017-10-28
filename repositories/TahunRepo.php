<?php

class SiamTahunRepo {
  public static function all() {
    global $wpdb;

    return $wpdb->get_col('select `text` from '.$wpdb->prefix.'si_tahun order by `text` asc', 0);
  }
}