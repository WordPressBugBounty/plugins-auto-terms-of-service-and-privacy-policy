<?php
if (!defined( 'ABSPATH' )) {
	exit;
}

use wpautoterms\admin\form\Controls;
use wpautoterms\admin\form\Legal_Page;
use wpautoterms\admin\form\Section;

/**
 * @var $page Legal_Page
 */
?>




<div class="card-container">
	<div>
		<p class="margin-bottom-0">
			Download the latest version of this document from <a href="https://app.termsfeed.com/wizard/cookies-policy?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">TermsFeed.com</a>.
		</p>
		<p class="margin-bottom-0">
			<a href="https://app.termsfeed.com/wizard/cookies-policy?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank" class="button button-primary">Generate the latest Cookies Policy document from TermsFeed.com</a>
		</p>
	</div>
</div>




<br />




<div class="legal-page-inner postbox">
	<div id="legal-page-container">
	<h1><?php echo esc_html($page->page_title()); ?></h1>




    <?php Section::begin('website_url_section', __('What is your website URL?', WPAUTOTERMS_SLUG)); ?>
	<input type="text" name="website_url" class="regular-text" value="<?php echo do_shortcode('[wpautoterms site_url]'); ?>" placeholder="Enter your website URL" />
	<?php Section::end(); ?>

	<?php Section::begin('website_name_section', __('What is your website name?', WPAUTOTERMS_SLUG)); ?>
	<input type="text" name="website_name" class="regular-text" value="<?php echo do_shortcode('[wpautoterms site_name]'); ?>" placeholder="Enter your website name" />
	<?php Section::end(); ?>




    <?php
        include __DIR__ . DIRECTORY_SEPARATOR . 'country.php';
    ?>




	<?php
        include __DIR__ . DIRECTORY_SEPARATOR . 'company-name-address.php';
    ?>




	<?php Section::begin('cookies_notice_section', __('Do you have a Cookie Notice (banner or dialog) on your website? ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'cookies_notice', array (
	'Yes' => __( 'Yes, we show a Cookies Notice.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php Section::begin('cookies_tracking_section', __('Do you use analytics tools (ie. Google Analytics, Mixpanel, Mouseflow)?', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'cookies_tracking', array (
	'Yes' => __( 'Yes, we use various analytics and performance tools to analyze how users use our website.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php Section::begin('cookies_social_media_section', __('Do you use any social media log-ins or like buttons on your website (ie. Log-in With Facebook, Facebook Like/Follow)? ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'cookies_social_media', array (
	'Yes' => __( 'Yes, we show social media like/follow buttons or "Log-in" buttons', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php 
	Section::begin( 'company_contact_section', __( 'How can users get in touch with you regarding your Cookies Policy?', WPAUTOTERMS_SLUG ) );
	?>
	<p class="text-muted text-small text-note">Click all that apply. </p>
	<?php
	Controls::checkbox_group( 'company_contact', array (
		'Email' => __( 'By email', WPAUTOTERMS_SLUG ),
		'Link' => __( 'By visiting a page on our website ', WPAUTOTERMS_SLUG ),
		'Phone' => __( 'By phone number ', WPAUTOTERMS_SLUG ),
		'Address' => __( 'By sending post mail ', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>

	<?php
        include __DIR__ . DIRECTORY_SEPARATOR . 'company-contact-options.php';
    ?>




	<?php Section::begin('is_free_section', __('Keep the plugin free?', WPAUTOTERMS_SLUG)); ?>	
	<?php
	Controls::radio( 'is_free', array (
	'Yes' => __( 'Yes! Show a small credit link note on your generated page. It helps us maintain and improve the plugin at no cost to you.', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	</div>
</div>




<p>Disclaimer: The provided agreements are for informational purposes only and do not constitute legal advice. <a href="https://www.termsfeed.com/legal/disclaimer/?utm_source=TermsFeedAutoTerms3_0&utm_medium=DisclaimerAddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">Please read the disclaimer</a>.</p>




<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'submit.php';
