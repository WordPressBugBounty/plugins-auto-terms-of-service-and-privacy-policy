<?php

namespace wpautoterms\option;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Checkbox_Option_Ex extends Checkbox_Option {
	public function sanitize( $input ) {
		return (bool) $input ;
	}

	public function get_value() {
		return parent::get_value();
	}
}