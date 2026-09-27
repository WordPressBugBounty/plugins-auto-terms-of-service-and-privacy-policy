<?php

namespace wpautoterms\admin\page;


use wpautoterms\cpt\CPT;

class Dashboard extends Base {
	public function register_menu() {
		if ( $this->menu_title() == null ) {
			return;
		}
		add_submenu_page( 'edit.php?post_type=' . CPT::type(),
			$this->title(),
			$this->menu_title(),
			CPT::edit_cap(),
			$this->id(),
			array( $this, 'render' ),
			0
		);
		add_filter( 'submenu_file', array( $this, 'submenu_file' ) );
	}

	/**
	 * The top-level menu links to admin.php?page=..., which lacks post_type, so WP can't match
	 * the Dashboard submenu item as current on its own.
	 */
	public function submenu_file( $submenu_file ) {
		global $plugin_page;
		if ( empty( $submenu_file ) && $plugin_page === $this->id() ) {
			return $this->id();
		}

		return $submenu_file;
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();

	}
}
