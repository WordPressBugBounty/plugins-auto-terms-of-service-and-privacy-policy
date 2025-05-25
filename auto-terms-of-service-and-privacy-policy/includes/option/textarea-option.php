<?php

namespace wpautoterms\option;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Textarea_Option extends Option {
	const TYPE_GENERIC = 'textarea-option';

	protected static function _default_template() {
		return static::TYPE_GENERIC;
	}

	public function sanitize( $input ) {
		return trim( strval( $input ) );
	}
}
