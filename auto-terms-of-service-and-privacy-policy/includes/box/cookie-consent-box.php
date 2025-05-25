<?php

namespace wpautoterms\box;

use wpautoterms\admin\Menu;
use wpautoterms\admin\Options;
use wpautoterms\admin\page\Base;
use wpautoterms\frontend\Links;
use wpautoterms\option;
use function wpautoterms\template_exists;
use function wpautoterms\print_template;

class Cookie_Consent_Box extends Box
{
    public function __construct($id, $title, $infotip)
    {
        parent::__construct($id, $title, $infotip);
    }

    public function defaults()
    {
        return [];
    }

    public function define_options($page_id, $section_id)
    {


    }

	public function render() {
		\wpautoterms\print_template( 'options/cookie-consent-box', $this->_box_args() );
	}

}