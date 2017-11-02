<?php

function siam_login_logo() { ?>
<style type="text/css">
#login h1 a, .login h1 a {
  background-image: url(<?= SIAM_URL ?>images/logo.png);
  height:100px;
  width:320px;
  background-size: contain;
  background-position: center-center;
  background-repeat: no-repeat;
  padding-bottom: 30px;
}
</style>
<?php
}

add_action( 'login_enqueue_scripts', 'siam_login_logo' );

function siam_login_redirect( $redirect_to, $request, $user ) {
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    if ( in_array( 'auditor', $user->roles ) ) {
      return get_admin_url() . 'admin.php?page=mutu-prodi-audit';
    } else if ( in_array( 'operator', $user->roles ) ) {
      return get_admin_url() . 'admin.php?page=mutu-prodi';
    } else {
      return home_url();
    }
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'siam_login_redirect', 10, 3 );

function siam_admin_redirect() {
  if (($_SERVER['REQUEST_SCHEME'] . '://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) == admin_url()) {
    $user = wp_get_current_user();
    if ( in_array( 'auditor', $user->roles ) ) {
      wp_redirect(get_admin_url() . 'admin.php?page=mutu-prodi-audit');
      exit;
    } else if ( in_array( 'operator', $user->roles ) ) {
      wp_redirect(get_admin_url() . 'admin.php?page=mutu-prodi');
      exit;
    }
  }
}

add_action( 'init', 'siam_admin_redirect', 1 );