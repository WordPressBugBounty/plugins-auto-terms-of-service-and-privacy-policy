<?php

namespace wpautoterms\option;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Radio_Option extends Option {
	const TYPE_GENERIC = 'radio-option';

	protected $_values = array();

	protected static function _default_template() {
		return static::TYPE_GENERIC;
	}

	public function set_values( $values ) {
		$this->_values = $values;
	}

	protected function _template_args() {
		$args           = parent::_template_args();
		$args['values'] = $this->_values;

		return $args;
	}

	function sanitize( $input ) {
		if ( ! isset( $this->_values[ $input ] ) ) {
			$k = array_keys( $this->_values );

			return trim( reset( $k ) );
		}

		return $input;
	}


}