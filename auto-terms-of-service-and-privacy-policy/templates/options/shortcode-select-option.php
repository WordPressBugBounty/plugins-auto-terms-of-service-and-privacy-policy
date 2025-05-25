<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include __DIR__ . DIRECTORY_SEPARATOR . 'select-option.php';
echo '<p class="wpautoterms-shortcode-option ' . $classes . '"><small>' . __( 'Shortcode:', WPAUTOTERMS_SLUG ) . '' .
     ' [wpautoterms ' . esc_html( substr( $name, strlen( WPAUTOTERMS_OPTION_PREFIX ) ) ) . ']</small></p>';