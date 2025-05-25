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
	}

	public function enqueue_scripts() {
		parent::enqueue_scripts();

	}
}
