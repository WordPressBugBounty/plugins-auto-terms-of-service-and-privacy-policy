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

	public static function prepare_user_vendor_script($vendor_script) {

		$vendor_script_code = $vendor_script['script_code'];
		$vendor_script_type = $vendor_script['script_type'];

		$original_code = new DOMDocument('1.0', "UTF-8");
		$original_code->loadHTML($vendor_script_code);

		$new_code = new DOMDocument('1.0', "UTF-8");
		$script_tag = $new_code->createElement('script');
		try {
			$original_code_script_tag = $original_code->getElementsByTagName('script')->item(0);
			if(!$original_code_script_tag) {
				throw new \Exception();
			}
			$script_tag->nodeValue = $original_code->getElementsByTagName('script')->item(0)->nodeValue;
		} catch(\Exception $e) {
			$script_tag->nodeValue = $vendor_script_code;
		}

		$script_tag->setAttribute('type', 'text/plain');
		$script_tag->setAttribute('id', 'termsfeed-autoterms-cookie-consent-vendor-script-' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $vendor_script['script_name'])));
		$script_tag->setAttribute('data-cookie-consent', $vendor_script_type);
		$new_code->appendChild($script_tag);
		return $new_code->saveHTML();
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

		foreach($vendor_scripts as $vendor_script) {
			\wpautoterms\print_template( 'cookie-consent-vendor-script', [
				'vendor_script_name' => strtoupper($vendor_script['script_name']) . ' Vendor Script',
				'vendor_script_type' => $vendor_script['script_type'],
				'vendor_script_code' => self::prepare_user_vendor_script($vendor_script),
			] );
		}

	}

}
