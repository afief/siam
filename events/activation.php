<?php

function siam_activation_hook() {

}

function siam_deactivation_hook() {
  
}

register_activation_hook( SIAM_FILE, 'siam_activation_hook' );
register_deactivation_hook( SIAM_FILE, 'siam_deactivation_hook' );