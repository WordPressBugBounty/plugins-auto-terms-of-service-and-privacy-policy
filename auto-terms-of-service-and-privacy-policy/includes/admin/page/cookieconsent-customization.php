<?php

namespace wpautoterms\admin\page;

use wpautoterms\admin\Options;
use wpautoterms\option;
use wpautoterms\option\Text_Option;
use function wpautoterms\print_template;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CookieConsent_Customization extends CookieConsent_Init {
	const PAGE_ID = 'cc_customization';
	const SECTION_ID = 'section';

	protected $_options;
	protected $_section_title = '';

	public function defaults() {
		return [
			'cc_selected_version'                     => WPAUTOTERMS_COOKIE_CONSENT_VERSION,
			'cc_enabled'                              => '0',
			'cc_consent_type'                         => 'implied',
			'cc_notice_banner_type'                   => 'headline',
			'cc_color_palette'                        => 'light',
			'cc_language'                             => 'en',
			'cc_allow_open_prf_center'                => true,
			'cc_notice_banner_reject_button_hide'     => false,
			'cc_preferences_center_close_button_hide' => false,
			'cc_page_refresh_confirmation_buttons'    => false,
			'cc_callbacks'                            => "{\r\n        'i_agree_button_clicked': () => {\r\n\r\n        },\r\n        'scripts_specific_loaded': (level) => {\r\n            switch (level) {\r\n                case 'targeting':\r\n                    gtag('consent', 'update', {\r\n                        'ad_storage': 'granted',\r\n                        'ad_user_data': 'granted',\r\n                        'ad_personalization': 'granted',\r\n                        'analytics_storage': 'granted'\r\n                    });\r\n                    break;\r\n            }\r\n        }\r\n    }"

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
			'tabs_html'   => $tabs_html ? $tabs_html : ''
		] );
	}

	public function define_options() {
		parent::define_options();
		$a = new option\Checkbox_Option( 'cc_enabled', __( 'Enabled', WPAUTOTERMS_SLUG ), '', $this->id(), static::SECTION_ID );

		$a = new option\Radio_Option( 'cc_consent_type', __( 'Compliance preference', WPAUTOTERMS_SLUG ),
			'Currently, Cookie Consent does not include geolocation functionality. <br /> <strong>Try <a href="https://www.termsfeed.com/privacy-consent/?utm_source=TermsFeedAutoTerms3_0&utm_medium=CC_Customization&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">Privacy Consent</a>,</strong> premium solution with automatic geolocation (i.e. notice banner loads only for EU users), consent for embeddable content (i.e. YouTube, Vimeo, etc.), consent logs and other features.', $this->id(), static::SECTION_ID );
		$a->set_values( array(
			'implied' => __( 'ePrivacy Directive (i.e. OK button)', WPAUTOTERMS_SLUG ),
			'express' => __( 'GDPR Directive (i.e. I Agree & I Decline buttons)', WPAUTOTERMS_SLUG ),
		) );

		$a = new option\Text_Option( 'cc_website_name', __( 'Website name', WPAUTOTERMS_SLUG ),
			'', $this->id(), static::SECTION_ID );

		$a = new option\Radio_Option( 'cc_notice_banner_type', __( 'Notice banner style', WPAUTOTERMS_SLUG ),
			'', $this->id(), static::SECTION_ID );
		$a->set_values( array(
			'simple'       => __( 'Simple', WPAUTOTERMS_SLUG ),
			'headline'     => __( 'Headline', WPAUTOTERMS_SLUG ),
			'interstitial' => __( 'Interstitial', WPAUTOTERMS_SLUG ),
			'standalone'   => __( 'Standalone', WPAUTOTERMS_SLUG ),
		) );

		$a = new option\Radio_Option( 'cc_color_palette', __( 'Color palette', WPAUTOTERMS_SLUG ),
			'', $this->id(), static::SECTION_ID );
		$a->set_values( array(
			'light' => __( 'Light', WPAUTOTERMS_SLUG ),
			'dark'  => __( 'Dark', WPAUTOTERMS_SLUG ),
		) );


		$a = new option\Choices_Option( 'cc_language', __( 'Default language', WPAUTOTERMS_SLUG ),
			'', $this->id(), static::SECTION_ID );
		$a->set_values( array(
			'en'    => __( 'English', WPAUTOTERMS_SLUG ),
			'en_gb' => __( 'English (GB)', WPAUTOTERMS_SLUG ),
			'de'    => __( 'German', WPAUTOTERMS_SLUG ),
			'fr'    => __( 'French', WPAUTOTERMS_SLUG ),
			'es'    => __( 'Spanish', WPAUTOTERMS_SLUG ),
			'ca_es' => __( 'Catalan', WPAUTOTERMS_SLUG ),
			'it'    => __( 'Italian', WPAUTOTERMS_SLUG ),
			'sv'    => __( 'Swedish', WPAUTOTERMS_SLUG ),
			'no'    => __( 'Norwegian', WPAUTOTERMS_SLUG ),
			'nl'    => __( 'Dutch', WPAUTOTERMS_SLUG ),
			'pt'    => __( 'Portuguese', WPAUTOTERMS_SLUG ),
			'fi'    => __( 'Finnish', WPAUTOTERMS_SLUG ),
			'hu'    => __( 'Hungarian', WPAUTOTERMS_SLUG ),
			'cs'    => __( 'Czech', WPAUTOTERMS_SLUG ),
			'hr'    => __( 'Croatian', WPAUTOTERMS_SLUG ),
			'da'    => __( 'Danish', WPAUTOTERMS_SLUG ),
			'sk'    => __( 'Slovak', WPAUTOTERMS_SLUG ),
			'sl'    => __( 'Slovenian', WPAUTOTERMS_SLUG ),
			'pl'    => __( 'Polish', WPAUTOTERMS_SLUG ),
			'el'    => __( 'Greek', WPAUTOTERMS_SLUG ),
			'he'    => __( 'Hebrew', WPAUTOTERMS_SLUG ),
			'mk'    => __( 'Macedonian', WPAUTOTERMS_SLUG ),
			'ro'    => __( 'Romanian', WPAUTOTERMS_SLUG ),
			'sr'    => __( 'Serbian', WPAUTOTERMS_SLUG ),
			'et'    => __( 'Estonian', WPAUTOTERMS_SLUG ),
			'lt'    => __( 'Lithuanian', WPAUTOTERMS_SLUG ),
			'lv'    => __( 'Latvian', WPAUTOTERMS_SLUG ),
			'ru'    => __( 'Russian', WPAUTOTERMS_SLUG ),
			'bg'    => __( 'Bulgarian', WPAUTOTERMS_SLUG ),
			'cy'    => __( 'Welsh', WPAUTOTERMS_SLUG ),
			'ja'    => __( 'Japanese', WPAUTOTERMS_SLUG ),
			'ar'    => __( 'Arabic', WPAUTOTERMS_SLUG ),
			'tr'    => __( 'Turkish', WPAUTOTERMS_SLUG ),
			'zh_tw' => __( 'Traditional Chinese (zh-TW)', WPAUTOTERMS_SLUG ),
		) );

		$a = new option\Checkbox_Option( 'cc_allow_open_prf_center', __( 'Insert link for users to open Preferences Center', WPAUTOTERMS_SLUG ), 'Automatically added at the end of the website pages. Otherwise, insert your own link/button with ID "open_preferences_center": <br /> <code><small>&lt;a href=&quot;#&quot; id=&quot;open_preferences_center&quot;&gt;Update cookies preferences&lt;/a&gt;</small></code>', $this->id(), static::SECTION_ID );

		// Additional options to be shown on Customization page
		// $a = new option\Checkbox_Option( 'cc_notice_banner_reject_button_hide', __( 'notice_banner_reject_button_hide2', WPAUTOTERMS_SLUG ), '', $this->id(), static::SECTION_ID );
		// $a = new option\Checkbox_Option( 'cc_preferences_center_close_button_hide', __( 'preferences_center_close_button_hide2', WPAUTOTERMS_SLUG ), '', $this->id(), static::SECTION_ID );
		// $a = new option\Checkbox_Option( 'cc_page_refresh_confirmation_buttons', __( 'page_refresh_confirmation_buttons2', WPAUTOTERMS_SLUG ), '', $this->id(), static::SECTION_ID );

		$to = new Text_Option( 'cc_callbacks', __( 'Callbacks', WPAUTOTERMS_SLUG ), 'Please visit <a href="https://www.termsfeed.com/documentation/?utm_source=TermsFeedAutoTerms3_0&amp;utm_medium=CCCustomizationCallbacks&amp;utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">TermsFeed Documentation pages</a> for more information on available options.',
			$this->id(), static::SECTION_ID, 'textarea-option',[],
			array( 'wpautoterms-resize-both' ) );

		$to = new Text_Option( 'cc_custom_css', __( 'Additional CSS', WPAUTOTERMS_SLUG ), 'Use Developer Tools > Inspect Element to find all available CSS classes.',
			$this->id(), static::SECTION_ID, 'css-textarea-option', array( 'data-codemirror' => null ),
			array( 'wpautoterms-resize-both' ) );

		$a = new option\Choices_Option( 'cc_selected_version', __( 'Cookie Consent version', WPAUTOTERMS_SLUG ),
			'', $this->id(), static::SECTION_ID );
		$a->set_values( [
			'4.2.0' => '4.2.0'
		] );
		//$to->additional_template_args['class_hints'] = $this->_class_hints();

	}

	protected function _class_hints() {
		return [];
	}


	public function render() {
		// Update computed parameters immediately before rendering (every time)
		parent::update_computed_parameters();

		\wpautoterms\print_template( 'pages/' . self::PAGE_ID, $this->_render_args() );
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/codemirror.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_css', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/css.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_hint', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/hint/show-hint.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_css_hint', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/hint/css-hint.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_matchbrackets', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/edit/matchbrackets.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_closebrackets', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/edit/closebrackets.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_active_line', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/selection/active-line.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_annotatescrollbar', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/scroll/annotatescrollbar.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_matchesonscrollbar', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/search/matchesonscrollbar.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_search_cursor', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/search/searchcursor.js', false, false, true );
		wp_enqueue_script( WPAUTOTERMS_SLUG . '_codemirror_match_highlight', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/search/match-highlighter.js', false, false, true );
		wp_enqueue_style( WPAUTOTERMS_SLUG . '_codemirror', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/codemirror.css' );
		wp_enqueue_style( WPAUTOTERMS_SLUG . '_codemirror_hint', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/hint/show-hint.css' );
		wp_enqueue_style( WPAUTOTERMS_SLUG . '_codemirror_matchesonscrollbar', WPAUTOTERMS_PLUGIN_URL . 'js/codemirror-5.42.0/addon/search/matchesonscrollbar.css' );


		wp_enqueue_script( WPAUTOTERMS_SLUG . 'cc_customization', WPAUTOTERMS_PLUGIN_URL . 'js/cookie-consent-customization.js',
			array( WPAUTOTERMS_JS_BASE ), WPAUTOTERMS_VERSION, true );
	}
}
