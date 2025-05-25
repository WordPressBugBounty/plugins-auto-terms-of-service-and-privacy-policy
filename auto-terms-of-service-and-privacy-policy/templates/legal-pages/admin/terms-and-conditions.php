<?php
if ( ! defined( 'ABSPATH' ) ) {
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
			Download the latest version of this document from <a href="https://app.termsfeed.com/wizard/terms-conditions?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">TermsFeed.com</a>.
		</p>
		<p class="margin-bottom-0">
			<a href="https://app.termsfeed.com/wizard/terms-conditions?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank" class="button button-primary">Generate the latest Terms & Conditions document from TermsFeed.com</a>
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




	<?php Section::begin('user_accounts_section', __('Can users create an account on your website?', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'user_accounts', array (
	'Yes' => __( 'Yes, users can create an account.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php Section::begin('user_content_section', __('Can users create and/or upload content (ie. text, images)? ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'user_content', array (
	'Yes' => __( 'Yes, users can create and/or upload content.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>

	<div id="copyright_policy_agent_email_section" style="display: none;">
		<?php Section::begin('copyright_policy_agent_email_section', __('What is the email address where you will receive infringements notices? ', WPAUTOTERMS_SLUG)); ?>
		<p class="text-muted text-small text-note">For example, Digital Millennium Copyright Act (DMCA) requires the email address of the Copyright Agent in order to receive infringements notices.</p>
		<input type="text" name="copyright_policy_agent_email" class="regular-text" placeholder="e.g. dmca@website.com" />
		<?php Section::end(); ?>
	</div>
	<script>
	wpAutoTermsDomReady(function() {
		var userContentRadios = document.querySelectorAll('input[name="user_content"]');
		var copyrightSection = document.getElementById('copyright_policy_agent_email_section');

		function updateCopyrightSection() {
			userContentRadios.forEach(function(radio) {
				if (radio.checked && radio.value === 'Yes') {
					copyrightSection.style.display = 'block';
				} else if (radio.checked && radio.value === 'No') {
					copyrightSection.style.display = 'none';
				}
			});
		}

		userContentRadios.forEach(function(radio) {
			radio.addEventListener('change', updateCopyrightSection);
		});

		// Initial check
		updateCopyrightSection();
	});
	</script>




	<?php Section::begin('ecommerce_section', __('Can users buy goods (products, items)?  ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'ecommerce', array (
	'Yes' => __( 'Yes, users can buy goods, items or services (one-time payments only).', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php Section::begin('intellectual_property_section', __('Do you want to make it clear that your own content & trademarks are your exclusive property?   ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'intellectual_property', array (
	'Yes' => __( 'Yes, our content (logo, visual design, trademarks etc.) is our exclusive property.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php 
	Section::begin( 'company_contact_section', __( 'How can users get in touch with you regarding your Terms & Conditions?', WPAUTOTERMS_SLUG ) );
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
