<?php

namespace wpautoterms\admin\page;

use wpautoterms\admin\Options;
use wpautoterms\frontend\cookie_consent\Cookie_Consent;
use wpautoterms\option;
use function wpautoterms\print_template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CookieConsent_ConfigurationParameters extends CookieConsent_Init {
	const PAGE_ID = 'cc_configuration_parameters';
	const SECTION_ID = 'section';

	protected $_options;
	protected $_section_title = '';

	public function defaults() {
		$selected_version = Cookie_Consent::get_selected_cc_version(true);
		return [
			'cc_configuration_parameters_' . $selected_version => $this->_computed_parameters()
		];
	}

	protected function _render_args() {
		$current_tab = self::PAGE_ID ? self::PAGE_ID : '';
		$tabs_html = '';
		try {
			$tabs_html = print_template( 'pages/_shared/cookie-consent-tabs', [ 
				'tabs'        => $this->_tabs ? $this->_tabs : [],
				'current_tab' => $current_tab
			], true );
		} catch (Exception $e) {
			$tabs_html = '';
		}
		
		return array_merge( parent::_render_args(), [
			'current_tab' => $current_tab,
			'tabs_html'   => $tabs_html ? $tabs_html : '',
		] );
	}


	public function define_options() {
		parent::define_options();
		$selected_version = Cookie_Consent::get_selected_cc_version(true);
		$a = new option\Textarea_Option( 'cc_configuration_parameters_' . $selected_version, __( 'Configuration Parameters', WPAUTOTERMS_SLUG ),
			'Please visit <a href="https://www.termsfeed.com/documentation/?utm_source=TermsFeedAutoTerms3_0&utm_medium=CCConfigParams&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">TermsFeed Documentation pages</a> for more information on available options.', $this->id(), static::SECTION_ID );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();

		wp_enqueue_script( WPAUTOTERMS_SLUG . 'cc_configuration_parameters', WPAUTOTERMS_PLUGIN_URL . 'js/cookie-consent-configuration-parameters.js',
			array( WPAUTOTERMS_JS_BASE ), WPAUTOTERMS_VERSION, true );
	}

	public function render() {

		if(isset($_REQUEST['settings-updated']) && sanitize_text_field(wp_unslash($_REQUEST['settings-updated'])) && check_admin_referer('update-options')) {
			parent::update_customization_fields();
		}
		\wpautoterms\print_template( 'pages/' . self::PAGE_ID, $this->_render_args() );
	}
}
