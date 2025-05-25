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
			Download the latest version of this document from <a href="https://app.termsfeed.com/wizard/privacy-policy?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank">TermsFeed.com</a>
		</p>
		<p class="margin-bottom-0">
			<a href="https://app.termsfeed.com/wizard/privacy-policy?utm_source=TermsFeedAutoTerms3_0&utm_medium=AddLegalPage&utm_campaign=TermsFeedAutoTermsPlugin" target="_blank" class="button button-primary">Generate the latest Privacy Policy document from TermsFeed.com</a>
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




	<?php Section::begin( 'types_of_data_collected_section', __( 'What kind of personal information you collect from users?', WPAUTOTERMS_SLUG ) ); ?>
	<?php
	Controls::checkbox_group( 'types_of_data_collected', array (
	'Email' => __( 'Email address', WPAUTOTERMS_SLUG ),
	'Name' => __( 'First name and last name', WPAUTOTERMS_SLUG ),
	'Phone' => __( 'Phone number', WPAUTOTERMS_SLUG ),
	'Address' => __( 'Address, State, Province, ZIP/Postal code, City', WPAUTOTERMS_SLUG ),
	'Social Media Login' => __( 'Social Media Profile information (ie. from Connect with Facebook, Sign In With Twitter)', WPAUTOTERMS_SLUG ),
	'Others' => __( 'Others', WPAUTOTERMS_SLUG ),
	) );
	?>
	<?php Section::end(); ?>




	<?php Section::begin('service_providers_analytics_section', __('Do you use tracking and/or analytics tools, such as Google Analytics? ', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'service_providers_analytics', array (
	'Yes' => __( 'Yes, we use Google Analytics or other related tools.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>

	<div id="analytics-tools-section" style="display: none;">
		<?php 
		Section::begin( 'service_providers_analytics_list_section', __( 'Select the tools you use for tracking and/or analytics:', WPAUTOTERMS_SLUG ) );
		?>
		<p class="text-muted text-small text-note">Click all that apply. If the provider isn't listed, select any provider from the list and then edit it out after you have generated your Privacy Policy.</p>
		<?php
		Controls::checkbox_group( 'service_providers_analytics_list', array (
			'Google Analytics' => __( 'Google Analytics', WPAUTOTERMS_SLUG ),
			'Facebook Analytics' => __( 'Facebook Analytics', WPAUTOTERMS_SLUG ),
			'Firebase' => __( 'Firebase', WPAUTOTERMS_SLUG ),
			'Matomo' => __( 'Matomo', WPAUTOTERMS_SLUG ),
			'Clicky' => __( 'Clicky', WPAUTOTERMS_SLUG ),
			'Statcounter' => __( 'Statcounter', WPAUTOTERMS_SLUG ),
			'Flurry Analytics' => __( 'Flurry Analytics', WPAUTOTERMS_SLUG ),
			'Mixpanel' => __( 'Mixpanel', WPAUTOTERMS_SLUG ),
			'Unity Analytics' => __( 'Unity Analytics', WPAUTOTERMS_SLUG ),
		));
		?>
		<?php Section::end(); ?>
	</div>

	<script>
	wpAutoTermsDomReady(function() {
		var analyticsRadios = document.getElementsByName('service_providers_analytics');
		var analyticsToolsSection = document.getElementById('analytics-tools-section');

		function updateAnalyticsSection() {
			analyticsToolsSection.style.display = 
				(analyticsRadios[0].checked) ? 'block' : 'none';
		}

		analyticsRadios.forEach(function(radio) {
			radio.addEventListener('change', updateAnalyticsSection);
		});

		// Set initial state
		updateAnalyticsSection();
	});
	</script>




	<?php Section::begin('compliance_ccpa_section', __('Do you want your Privacy Policy to include CCPA (CPRA) wording?', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'compliance_ccpa', array (
	'Yes' => __( 'Yes. Adapt my Privacy Policy to include CCPA (CPRA) wording.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>

	<?php Section::begin('compliance_gdpr_section', __('Do you want your Privacy Policy to include GDPR wording?', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'compliance_gdpr', array (
	'Yes' => __( 'Yes. Adapt my Privacy Policy to include GDPR wording.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>

	<?php Section::begin('compliance_caloppa_section', __('Do you want your Privacy Policy to include CalOPPA wording?', WPAUTOTERMS_SLUG)); ?>
	<?php
	Controls::radio( 'compliance_caloppa', array (
	'Yes' => __( 'Yes. Adapt my Privacy Policy to include CalOPPA wording.', WPAUTOTERMS_SLUG ),
	'No' => __( 'No', WPAUTOTERMS_SLUG ),
	));
	?>
	<?php Section::end(); ?>




	<?php 
	Section::begin( 'company_contact_section', __( 'How can users get in touch with you regarding your Privacy Policy?', WPAUTOTERMS_SLUG ) );
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


