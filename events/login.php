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