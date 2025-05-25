<?php

namespace wpautoterms\admin\page;

use wpautoterms\admin\Options;
use wpautoterms\option;
use function wpautoterms\print_template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CookieConsent_VendorScripts extends CookieConsent_Init {
	const PAGE_ID = 'cc_vendor_scripts';
	const SECTION_ID = 'section';

	protected $_options;
	protected $_section_title = '';

	public function defaults() {
		return [
			'cc_vendor_scripts_b64' => null,

		];
	}

	protected function _render_args() {
		$current_tab = self::PAGE_ID ? self::PAGE_ID : '';
		$tabs_html = '';
		try {
			$tabs_html = print_template('pages/_shared/cookie-consent-tabs', [
				'tabs' => $this->_tabs ? $this->_tabs : [], 
				'current_tab' => $current_tab
			], true);
		} catch (Exception $e) {
			$tabs_html = '';
		}
		
		return array_merge(parent::_render_args(), [
			'current_tab' => $current_tab,
			'tabs_html' => $tabs_html ? $tabs_html : ''
		]);
	}



	public function define_options()
	{
		parent::define_options();
		$a = new option\Hidden_Option( 'cc_vendor_scripts_b64', '', '', $this->id(), static::SECTION_ID );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();

		wp_enqueue_script( WPAUTOTERMS_SLUG . 'cc_vendor_scripts', WPAUTOTERMS_PLUGIN_URL . 'js/cookie-consent-vendor-scripts.js',
			array( WPAUTOTERMS_JS_BASE ), WPAUTOTERMS_VERSION, true );
	}
}
