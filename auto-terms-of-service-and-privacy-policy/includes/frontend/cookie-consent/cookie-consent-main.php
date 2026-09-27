<?php

namespace wpautoterms\frontend\cookie_consent;

use DOMDocument;
use wpautoterms\frontend\notice\Cookies_Notice;

class Cookie_Consent_Main extends Cookie_Consent {
	const CLASS_COOKIE_CONSENT = 'wpautoterms-cookie-consent';

	public static function create() {
		$a = new Cookie_Consent_Main( 'cookie_consent', 'wpautoterms-cookie-consent-container', self::CLASS_COOKIE_CONSENT );
		return $a;
	}

	public static function _get_configuration_parameters() {
		try {
			// Allow only valid JSON for configuration_parameters to be retrieved
			$selected_version = Cookie_Consent::get_selected_cc_version(true);
			$configuration_parameters = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_configuration_parameters_' . $selected_version );

			if ( $configuration_parameters === null || !is_string( $configuration_parameters ) ) {
				throw new \Exception('Configuration parameters is null or not a string');
			}

			$decoded = json_decode($configuration_parameters);
			if($decoded === null) {
				throw new \Exception('Invalid JSON');
			}

			// Convert objects that are represented as STRINGS to Real JS objects
			$string_fields_to_objects = ["callbacks"];
			foreach($string_fields_to_objects as $field) {
				$pattern = '/("'.$field.'": "\{)(.*)(}")/s';
				$replacement = '"'.$field.'": {$2}';
				$configuration_parameters = preg_replace($pattern, $replacement, $configuration_parameters);

			}
		} catch(\Exception $e) {
			$configuration_parameters = null;
		}

		return $configuration_parameters;
	}

	protected function _print_box() {

		$class_escaped = esc_attr( Cookie_Consent_Main::CLASS_COOKIE_CONSENT );
		$custom_css = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_custom_css' );
		if ( $custom_css === null || !is_string( $custom_css ) ) {
			$custom_css = '';
		}
		\wpautoterms\print_template( 'cookie-consent', [
			'class_escaped' => $class_escaped,
			'configuration_parameters' => $this->_get_configuration_parameters(),
			'custom_css' => $custom_css
		] );
	}

	/**
	 * Turns the pasted vendor code into scripts the Cookie Consent library releases after consent.
	 * Every <script> is kept with its attributes (src included) and its code byte for byte;
	 * other markup, such as a <noscript> fallback, is dropped because it would run without consent.
	 * Code with no <script> tag is used whole as one inline script.
	 */
	public static function prepare_user_vendor_script( $vendor_script ) {
		$code = isset( $vendor_script['script_code'] ) ? $vendor_script['script_code'] : '';
		if ( ! is_string( $code ) || trim( $code ) === '' ) {
			return '';
		}
		$type    = isset( $vendor_script['script_type'] ) ? (string) $vendor_script['script_type'] : '';
		$name    = isset( $vendor_script['script_name'] ) ? (string) $vendor_script['script_name'] : '';
		$base_id = 'termsfeed-autoterms-cookie-consent-vendor-script-' . strtolower( preg_replace( '/[^a-zA-Z0-9]/', '', $name ) );

		$scripts = array();
		if ( stripos( $code, '<script' ) === false ) {
			$scripts[] = array( 'attrs' => array(), 'text' => $code );
		} else {
			// A script ends at the first "</script", as in the HTML parser; libxml would also cut other end tags out of the code.
			preg_match_all( '#<script\b([^>]*)>(.*?)</script\s*>#is', $code, $matches, PREG_SET_ORDER );
			foreach ( $matches as $match ) {
				$scripts[] = array( 'attrs' => self::parse_script_attributes( $match[1] ), 'text' => $match[2] );
			}
		}

		$out = '';
		foreach ( $scripts as $i => $script ) {
			$id  = $i ? $base_id . '-' . ( $i + 1 ) : $base_id;
			$tag = '<script type="text/plain" id="' . esc_attr( $id ) . '" data-cookie-consent="' . esc_attr( $type ) . '"';
			foreach ( $script['attrs'] as $attr_name => $attr_value ) {
				$tag .= ' ' . $attr_name . ( $attr_value === '' ? '' : '="' . esc_attr( $attr_value ) . '"' );
			}
			$out .= $tag . '>' . preg_replace( '#</(script)#i', '<\/$1', $script['text'] ) . "</script>\n";
		}

		return $out;
	}

	/**
	 * Reads the attributes of one <script> start tag, leaving out the ones the plugin sets itself.
	 */
	protected static function parse_script_attributes( $attributes ) {
		$attrs = array();
		if ( trim( $attributes ) === '' ) {
			return $attrs;
		}
		$doc  = new DOMDocument( '1.0', 'UTF-8' );
		$prev = libxml_use_internal_errors( true );
		$doc->loadHTML( '<?xml encoding="UTF-8"?><html><body><script' . $attributes . '></script></body></html>' );
		libxml_clear_errors();
		libxml_use_internal_errors( $prev );
		$el = $doc->getElementsByTagName( 'script' )->item( 0 );
		if ( ! $el ) {
			return $attrs;
		}
		foreach ( $el->attributes as $attr ) {
			$attr_name = strtolower( $attr->nodeName );
			if ( in_array( $attr_name, array( 'type', 'id', 'data-cookie-consent' ), true ) ) {
				continue;
			}
			$attrs[ $attr_name ] = $attr->nodeValue;
		}

		return $attrs;
	}

	public static function show_vendor_scripts() {
		$vendor_scripts_b64 = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_vendor_scripts_b64' );
		if ( $vendor_scripts_b64 === null || !is_string( $vendor_scripts_b64 ) ) {
			$vendor_scripts_b64 = '';
		}
		try {
			$vendor_scripts = json_decode( base64_decode( $vendor_scripts_b64 ), true);
			if(!$vendor_scripts) {
				$vendor_scripts = [];
			}
		} catch(\Exception $e) {
			$vendor_scripts = [];
		}

		foreach ( $vendor_scripts as $vendor_script ) {
			$script_code = isset( $vendor_script['script_code'] ) ? $vendor_script['script_code'] : '';
			if ( ! is_string( $script_code ) || trim( $script_code ) === '' ) {
				continue;
			}

			\wpautoterms\print_template( 'cookie-consent-vendor-script', [
				'vendor_script_name'  => strtoupper( $vendor_script['script_name'] ) . ' Vendor Script',
				'vendor_script_type'  => $vendor_script['script_type'],
				'vendor_script_code'  => self::prepare_user_vendor_script( $vendor_script ),
			] );
		}

	}

}
