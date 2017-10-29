<?php

function siam_activation_hook() {
  add_role('operator', 'Operator', array(
    'read' => true,
    'level_0' => true,
    'siam_role_mutu' => true
  ));

  add_role('operator', 'Operator', array(
    'read' => true,
    'level_0' => true,
    'siam_role_audit' => true
  ));

  $roles = array('administrator', 'editor', 'author', 'contributor');
  foreach ($roles as $role) {
    $r = get_role($role);
    $r->add_cap('siam_role_mutu');
    $r->add_cap('siam_role_audit');
  }
}

function siam_deactivation_hook() {
  remove_role('operator'); 
}

register_activation_hook( SIAM_FILE, 'siam_activation_hook' );
register_deactivation_hook( SIAM_FILE, 'siam_deactivation_hook' );