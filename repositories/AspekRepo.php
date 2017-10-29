<?php

class AspekRepo {
  public static function all() {
    global $wpdb;

    return $wpdb->get_results('select `id`, `text` from '.$wpdb->prefix.'si_aspek where deleted = 0', ARRAY_A);
  }

  public static function get($id) {
    global $wpdb;

    return $wpdb->get_row(
      $wpdb->prepare('select `id`, `text` from '.$wpdb->prefix.'si_aspek where deleted = 0 and id = %d', $id)
    ); 
  }

  public static function update($id, $text) {
    global $wpdb;

    return $wpdb->update($wpdb->prefix.'si_aspek', array(
      'text' => $text
    ), array(
      'id' => $id
    ), array('%s'), array('%d'));
  }

  public static function insert($text) {
    global $wpdb;

    return $wpdb->insert($wpdb->prefix.'si_aspek', array(
      'text' => $text
    ));
  }

  public static function delete($id) {
    global $wpdb;
    
    return $wpdb->delete($wpdb->prefix.'si_aspek', array(
      'id' => $id
    ));
  }
}