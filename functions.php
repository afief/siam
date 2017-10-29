<?php

function siam_redirect($redirectUrl = false) {
  if (!$redirectUrl) {
    $redirectUrl = get_admin_url();
  }
  include('views/redirectjs.php');
  exit;
}