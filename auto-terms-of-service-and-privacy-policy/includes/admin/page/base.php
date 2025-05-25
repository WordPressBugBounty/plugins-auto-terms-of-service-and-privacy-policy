<?php

namespace wpautoterms\admin\page;

use wpautoterms\cpt\CPT;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Base {
	private $_id;
	protected $_title;
	protected $_menu_title;
	protected $_options;

	public function __construct( $id, $title = null, $menu_title = null ) {
		$this->_id = is_string($id) ? $id : '';
		$this->_title = is_string($title) ? $title : '';
		if ( $menu_title === null ) {
			$menu_title = $this->_title;
		}
		$this->_menu_title = is_string($menu_title) ? $menu_title : '';
		$this->_init();
	}

	protected function _init() {
	}

	public function menu_title() {
		$title = $this->_menu_title ?? '';
		return is_string($title) ? $title : '';
	}

	public function register_menu() {
		$menu_title = $this->menu_title();
		if ( empty($menu_title) ) {
			return;
		}
		$page_title = $this->title();
		$page_id = $this->id();
		
		// Ensure all parameters are strings
		$page_title = is_string($page_title) ? $page_title : '';
		$menu_title = is_string($menu_title) ? $menu_title : '';
		$page_id = is_string($page_id) ? $page_id : '';
		
		if (empty($page_id)) {
			return;
		}
		
		add_submenu_page( 'edit.php?post_type=' . CPT::type(),
			$page_title,
			$menu_title,
			CPT::edit_cap(),
			$page_id,
			array( $this, 'render' )
		);
	}

	public function enqueue_scripts() {
	}

	protected function _render_args() {
		return array(
			'page' => $this,
		);
	}

	public function render() {
		$template_id = is_string($this->_id) ? $this->_id : '';
		if ($template_id) {
			\wpautoterms\print_template( 'pages/' . $template_id, $this->_render_args() );
		}
	}

	public function title() {
		$title = $this->_title ?? '';
		return is_string($title) ? $title : '';
	}

	public function id() {
		// TODO: move out prefixing
		$slug = defined('WPAUTOTERMS_SLUG') ? WPAUTOTERMS_SLUG : 'wpautoterms';
		$id = is_string($this->_id) ? $this->_id : '';
		return $slug . '_' . $id;
	}

	public function options_id() {
		$id = $this->_id ?? '';
		return is_string($id) ? $id : '';
	}
}
