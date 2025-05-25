<?php

namespace wpautoterms\admin\page;

use wpautoterms\cpt\CPT;
use wpautoterms\frontend\cookie_consent\Cookie_Consent;
use function wpautoterms\print_template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class CookieConsent_Init extends Base {
	const SECTION_ID = 'section';

	protected $_options;
	protected $_section_title = '';
	protected $_tabs = [
		'cc_customization'            => [ 'name' => 'Customization' ],
		'cc_vendor_scripts'           => [ 'name' => 'Vendor Scripts' ],
		'cc_configuration_parameters' => [ 'name' => 'Configuration Parameters' ],
	];
	protected $_fields_accepted_values = [
		'cc_notice_banner_type'                   => [ 'simple', 'headline', 'interstitial', 'standalone' ],
		'cc_consent_type'                         => [ 'express', 'implied' ],
		'cc_color_palette'                        => [ 'light', 'dark' ],
		'cc_notice_banner_reject_button_hide'     => [ true, false, "true", "false", 1, 0 ],
		'cc_preferences_center_close_button_hide' => [ true, false, "true", "false", 1, 0 ],
		'cc_page_refresh_confirmation_buttons'    => [ true, false, "true", "false", 1, 0 ],
		'cc_language'                             => [
			'en',
			'en_gb',
			'de',
			'fr',
			'es',
			'ca_es',
			'it',
			'sv',
			'no',
			'nl',
			'pt',
			'fi',
			'hu',
			'cs',
			'hr',
			'da',
			'sk',
			'sl',
			'pl',
			'el',
			'he',
			'mk',
			'ro',
			'sr',
			'lt',
			'lv',
			'ru',
			'bg',
			'cy',
			'ja',
			'ar',
			'tr',
			'zh_tw'
		]
	];

	abstract public function defaults();

	protected function _render_args() {
		$footer = '';
		try {
			$footer = print_template( 'pages/_shared/cookie-consent-footer', [], true );
		} catch (Exception $e) {
			$footer = '';
		}
		
		return array_merge( parent::_render_args(), [
			'page'   => $this,
			'tabs'   => $this->_tabs ? $this->_tabs : [],
			'footer' => $footer ? $footer : ''
		] );
	}

	public function register_menu() {
		$page_title = $this->title();
		$menu_title = '';
		$page_id = $this->id();
		
		// Ensure all parameters are valid strings
		$page_title = is_string($page_title) && !empty($page_title) ? $page_title : 'Cookie Consent';
		$page_id = is_string($page_id) && !empty($page_id) ? $page_id : '';
		
		if (empty($page_id)) {
			return;
		}
		
		add_submenu_page( '',
			$page_title,
			$menu_title,
			CPT::edit_cap(),
			$page_id,
			array( $this, 'render' )
		);
	}

	public function define_options() {
		// NOTE: PHP<5.5 compliance
		$value = static::SECTION_ID;
		if ( empty( $value ) ) {
			return;
		}
		add_settings_section( static::SECTION_ID,
			$this->_section_title,
			false,
			$this->id() );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();

		wp_enqueue_script( WPAUTOTERMS_SLUG . 'cc_admin', WPAUTOTERMS_PLUGIN_URL . 'js/cookie-consent-admin.js',
			array( WPAUTOTERMS_JS_BASE ), WPAUTOTERMS_VERSION, true );
	}


	protected function _computed_parameters() {
		$callbacks = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_callbacks' );
		if ( $callbacks !== null && is_string( $callbacks ) ) {
			$callbacks = str_replace(['"'], "'", $callbacks );
			$callbacks = str_replace( ["\r", "\n", "\t"], '', $callbacks );
		} else {
			$callbacks = '';
		}
		
		$consent_type = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_consent_type' );
		
		// Set page_load_consent_levels based on consent_type
		if ( $consent_type === 'implied' ) {
			$page_load_consent_levels = [ "strictly-necessary", "functionality", "tracking", "targeting" ];
		} else {
			$page_load_consent_levels = [ "strictly-necessary" ];
		}
		
		return json_encode(
			[
				"website_name"                         => get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_website_name' ),
				"notice_banner_type"                   => get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_notice_banner_type' ),
				"consent_type"                         => $consent_type,
				"palette"                              => get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_color_palette' ),
				"language"                             => get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_language' ),
				"page_load_consent_levels"             => $page_load_consent_levels,
				"notice_banner_reject_button_hide"     => boolval( get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_notice_banner_reject_button_hide' ) ),
				"preferences_center_close_button_hide" => boolval( get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_preferences_center_close_button_hide' ) ),
				"page_refresh_confirmation_buttons"    => boolval( get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_page_refresh_confirmation_buttons' ) ),
				"callbacks"    => $callbacks
			], JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES
		);
	}

	protected function update_computed_parameters() {
		$selected_version = Cookie_Consent::get_selected_cc_version(true);
		$current_parameters = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_configuration_parameters_' . $selected_version );
		if ( $current_parameters ) {
			$current_parameters = json_decode( $current_parameters, true );
			if ( ! $current_parameters ) {
				$current_parameters = [];
			}
		} else {
			$current_parameters = [];
		}
		$computed_parameters = $this->_computed_parameters();
		if ( $computed_parameters ) {
			$computed_parameters = json_decode( $computed_parameters, true );
			if ( ! $computed_parameters ) {
				$computed_parameters = [];
			}
		} else {
			$computed_parameters = [];
		}


		$new_configuration_parameters = json_encode( array_merge( $current_parameters, $computed_parameters ), JSON_PRETTY_PRINT );

		update_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_configuration_parameters_' . $selected_version, $new_configuration_parameters );
	}

	/**
	 * Update the Customization page options with the ones specified by the user in 'Configuration Parameters' page
	 *
	 * @return void
	 */
	protected function update_customization_fields() {
		$customization_fields = [
			'cc_website_name'                         => 'website_name',
			'cc_notice_banner_type'                   => 'notice_banner_type',
			'cc_consent_type'                         => 'consent_type',
			'cc_color_palette'                        => 'palette',
			'cc_language'                             => 'language',
			'cc_notice_banner_reject_button_hide'     => 'notice_banner_reject_button_hide',
			'cc_preferences_center_close_button_hide' => 'preferences_center_close_button_hide',
			'cc_page_refresh_confirmation_buttons'    => 'page_refresh_confirmation_buttons',
		];
		$selected_version = Cookie_Consent::get_selected_cc_version(true);
		$option_name = WPAUTOTERMS_OPTION_PREFIX . 'cc_configuration_parameters_' . $selected_version;
		$current_parameters = get_option($option_name);
		try {
			$current_parameters = json_decode( $current_parameters, true );
			if ( ! $current_parameters ) {
				$current_parameters = [];
			}
		} catch ( \Exception $e ) {
			$current_parameters = [];
		}

		// When current parameters are not defined, just generate them automatically
		if ( ! count( $current_parameters ) || ! isset( $current_parameters ) ) {
			$this->update_computed_parameters();
			return;
		}

		foreach ( $customization_fields as $option_key => $configuration_parameter ) {
			if ( ! isset( $current_parameters[ $configuration_parameter ] ) ) {
				continue;
			}
			$value = $current_parameters[ $configuration_parameter ];

			// Allow only accepted values for specific fields
			if ( @$this->_fields_accepted_values[ $option_key ] && ! in_array( $value, $this->_fields_accepted_values[ $option_key ] ) ) {
				$value = $this->_fields_accepted_values[ $option_key ][0];
			}
			update_option( WPAUTOTERMS_OPTION_PREFIX . $option_key, $value );
		}

		$this->update_computed_parameters();
	}
}
