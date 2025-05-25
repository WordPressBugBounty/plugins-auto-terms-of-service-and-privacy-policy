<?php

namespace wpautoterms\box;

use wpautoterms\admin\Menu;
use wpautoterms\cpt\CPT;
use wpautoterms\frontend\Container_Constants;
use wpautoterms\frontend\notice\Update_Notice;
use wpautoterms\option;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Update_Notice_Box extends Box {

	function empty_buttons( $buttons ) {
		return array();
	}

	function limited_buttons( $buttons ) {
		return array(
			'bold',
			'italic',
			'underline',
			'bullist',
			'numlist',
			'link',
			'unlink',
		);
	}

	function shortcodes( $option ) {
		\wpautoterms\print_template( 'shortcodes', array(
			'shortcodes' => array(
				__( 'title', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms page_title]',
				__( 'link', 'auto-terms-of-service-and-privacy-policy' ) => '<a href="[wpautoterms page_link]">[wpautoterms page_title]</a>',
				__( 'href', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms page_link]',
				__( 'last effective date', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms last_updated_date]',
			),
			'option' => $option,
		) );
	}

	function shortcodes_multiple( $option ) {
		\wpautoterms\print_template( 'shortcodes', array(
			'shortcodes' => array(
				__( 'titles', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms page_titles]',
				__( 'links', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms page_links]',
				__( 'last effective date', 'auto-terms-of-service-and-privacy-policy' ) => '[wpautoterms last_updated_date]',
			),
			'option' => $option,
		) );
	}

	function define_options( $page_id, $section_id ) {
		new option\Checkbox_Option( $this->id(), __( 'Enabled', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );

		$a = new option\Choices_Option( $this->id() . '_bar_position', __( 'Announcement bar position', 'auto-terms-of-service-and-privacy-policy' ),
			'', $page_id, $section_id );
		$a->set_values( array(
			Container_Constants::LOCATION_TOP => __( 'top', 'auto-terms-of-service-and-privacy-policy' ),
			Container_Constants::LOCATION_BOTTOM => __( 'bottom', 'auto-terms-of-service-and-privacy-policy' ),
		) );
		$a = new option\Choices_Option( $this->id() . '_bar_type', __( 'Announcement bar type', 'auto-terms-of-service-and-privacy-policy' ),
			'', $page_id, $section_id );
		$a->set_values( array(
			Container_Constants::TYPE_STATIC => __( 'static', 'auto-terms-of-service-and-privacy-policy' ),
			Container_Constants::TYPE_FIXED => __( 'fixed', 'auto-terms-of-service-and-privacy-policy' ),
		) );
		/*
		new Choices_Combo_Option($this->id().'_offset', __( 'Announcement bar offset', WPAUTOTERMS_SLUG ),
			array(
				' ' => __('default', WPAUTOTERMS_SLUG),
				'5px' => '5px',
				'10px' => '10px',
				'15px' => '15px',
				'20px' => '20px',
				'25px' => '25px',
			), Choices_Combo_Option::TYPE_SELECT, $page_id, $section_id);
		*/
		$a = new option\Choices_Option( $this->id() . '_disable_logged', __( 'Disable for logged-in users', 'auto-terms-of-service-and-privacy-policy' ),
			'', $page_id, $section_id );
		$a->set_values( array(
			'yes' => __( 'yes', 'auto-terms-of-service-and-privacy-policy' ),
			'no' => __( 'no', 'auto-terms-of-service-and-privacy-policy' ),
		) );
		$a = new option\Choices_Option( $this->id() . '_duration', __( 'How long to keep the announcement bar', 'auto-terms-of-service-and-privacy-policy' ),
			'', $page_id, $section_id );
		$a->set_values( array(
			'1' => __( '24 hours', 'auto-terms-of-service-and-privacy-policy' ),
			'3' => __( '3 days', 'auto-terms-of-service-and-privacy-policy' ),
			'10' => __( '10 days', 'auto-terms-of-service-and-privacy-policy' ),
			'30' => __( '30 days', 'auto-terms-of-service-and-privacy-policy' ),
		) );
		$a = new option\Editor_Option( $this->id() . '_message', __( 'Message', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		$a->set_settings( array(
			'drag_drop_upload' => false,
			'media_buttons' => false,
			'editor_height' => 150,
			'filters' => array(
				array( 'mce_buttons', array( $this, 'limited_buttons' ) ),
				array( 'mce_buttons_2', array( $this, 'empty_buttons' ) ),
				array( 'mce_buttons_3', array( $this, 'empty_buttons' ) ),
				array( 'mce_buttons_4', array( $this, 'empty_buttons' ) ),
				array( 'wpautoterms_post_editor', array( $this, 'shortcodes' ) ),
				array( 'wpautoterms_post_editor', array( $this, '_render_revert_message' ) ),
			),
			'tinymce' => array(
				'resize' => false,
			),
		) );
		$a = new option\Editor_Option( $this->id() . '_message_multiple', __( 'Message for multiple updated pages', 'auto-terms-of-service-and-privacy-policy' ),
			'', $page_id, $section_id );
		$a->set_settings( array(
			'drag_drop_upload' => false,
			'media_buttons' => false,
			'editor_height' => 150,
			'filters' => array(
				array( 'mce_buttons', array( $this, 'limited_buttons' ) ),
				array( 'mce_buttons_2', array( $this, 'empty_buttons' ) ),
				array( 'mce_buttons_3', array( $this, 'empty_buttons' ) ),
				array( 'mce_buttons_4', array( $this, 'empty_buttons' ) ),
				array( 'wpautoterms_post_editor', array( $this, 'shortcodes_multiple' ) ),
				array( 'wpautoterms_post_editor', array( $this, '_render_revert_message' ) ),
			),
			'tinymce' => array(
				'resize' => false,
			),
		) );
		new option\Text_Option( $this->id() . '_close_message', __( 'Message for close button', 'auto-terms-of-service-and-privacy-policy' ), '',
			$page_id, $section_id, option\Text_Option::TYPE_GENERIC );
		new option\Color_Option( $this->id() . '_bg_color', __( 'Background color', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		$a = new option\Choices_Combo_Option( $this->id() . '_notice_font', __( 'Font', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		$a->set_values( Menu::fonts() );
		$a = new option\Choices_Combo_Option( $this->id() . '_font_size', __( 'Font size', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		$a->set_values( Menu::font_sizes() );
		new option\Color_Option( $this->id() . '_text_color', __( 'Text color', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		new option\Color_Option( $this->id() . '_links_color', __( 'Links color', 'auto-terms-of-service-and-privacy-policy' ), '', $page_id, $section_id );
		$this->_custom_css_options( $page_id, $section_id );
	}

	public function defaults() {
		return array(
			$this->id() => false,
			$this->id() . '_bar_position' => Container_Constants::LOCATION_TOP,
			$this->id() . '_bar_type' => Container_Constants::TYPE_STATIC,
			$this->id() . '_disable_logged' => 'yes',
			$this->id() . '_duration' => '3',
			$this->id() . '_message' => __( 'Our <a href="[wpautoterms page_link]">[wpautoterms page_title]</a> has been updated on [wpautoterms last_updated_date].', 'auto-terms-of-service-and-privacy-policy' ),
			$this->id() . '_message_multiple' => __( 'Our [wpautoterms page_links] have been updated on [wpautoterms last_updated_date].', 'auto-terms-of-service-and-privacy-policy' ),
			$this->id() . '_close_message' => __( 'Close', 'auto-terms-of-service-and-privacy-policy' ),
			$this->id() . '_bg_color' => '',
			$this->id() . '_font' => '',
			$this->id() . '_font_size' => '',
			$this->id() . '_text_color' => '',
			$this->id() . '_links_color' => '',
		);
	}

	protected function _class_hints() {
		return array(
			__( 'Update notice class:', 'auto-terms-of-service-and-privacy-policy' ) => '.' . Update_Notice::BLOCK_CLASS,
			__( 'Close button class:', 'auto-terms-of-service-and-privacy-policy' ) => '.' . Update_Notice::CLOSE_CLASS,
		);
	}
}
