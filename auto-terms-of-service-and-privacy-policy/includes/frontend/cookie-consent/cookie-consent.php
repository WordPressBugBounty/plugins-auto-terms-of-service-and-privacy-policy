<?php

namespace wpautoterms\frontend\cookie_consent;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Cookie_Consent {
	protected $_where;
	protected $_type;
	protected $_message;
	protected $_close_message;
	protected $_id;
	protected $_tag;
	protected $_container;
	protected $_element;

	public function __construct( $id, $container_class, $element_class ) {
		$this->_id        = $id;
		$this->_tag       = str_replace( '_', '-', $this->_id );
		$this->_container = $container_class;
		$this->_element   = $element_class;
	}

	public function init() {
		if ( ! $this->_is_enabled() ) {
			return;
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( WPAUTOTERMS_SLUG . '_container', array( $this, 'container' ), 10, 2 );

		$this->_type  = 'static';
		$this->_where = 'bottom';

	}

	public function id() {
		return $this->_id;
	}

	protected function _is_enabled() {
		return get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_enabled' );
	}

	public static function get_selected_cc_version($with_dash = false) {
		try {
			$version = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_selected_version' );
			if ( ! $version ) {
				throw new \Exception('No version defined');
			}

			// If version pattern is wrong, just use the latest version
			if (!preg_match('/^([0-9]+\.){2}[0-9]+$/', $version)) {
				throw new \Exception('Invalid version');
			}
		} catch (\Exception $e) {
			update_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_selected_version', WPAUTOTERMS_COOKIE_CONSENT_VERSION );
			$version = WPAUTOTERMS_COOKIE_CONSENT_VERSION;
		}

		if($with_dash) {
			return str_replace('.', '_', $version);
		}
		return $version;
	}

	public static function get_cc_url() {
		$selected_version = self::get_selected_cc_version();
		$cc_url = 'https://www.termsfeed.com/public/cookie-consent/' . $selected_version . '/cookie-consent.js';

		return $cc_url;
	}

	public function enqueue_scripts() {
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_js_' . $this->id(), self::get_cc_url());
	}

	public function container( $where, $type ) {
		if ( ( $this->_where == $where ) && ( $this->_type == $type ) ) {
			$this->_print_box();
		}
	}

	abstract protected function _print_box();

}