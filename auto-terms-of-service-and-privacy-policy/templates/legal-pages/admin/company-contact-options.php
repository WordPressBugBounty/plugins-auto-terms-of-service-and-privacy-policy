<?php

use wpautoterms\admin\form\Section;
use wpautoterms\admin\form\Controls;
?>

<div id="company_contact_email_section" style="display: none;">
		<?php Section::begin('company_contact_email_section', __('What is the email?', WPAUTOTERMS_SLUG)); ?>
		<p class="text-muted text-small text-note">Optional. Leave blank if contact method is not available.</p>
		<input type="text" name="company_contact_email" class="regular-text" placeholder="e.g. office@mycompany.com" />
		<?php Section::end(); ?>
	</div>

	<div id="company_contact_link_section" style="display: none;">
		<?php Section::begin('company_contact_link_section', __('What is the link?', WPAUTOTERMS_SLUG)); ?>
		<p class="text-muted text-small text-note">Optional. Leave blank if contact method is not available.</p>
		<input type="text" name="company_contact_link" class="regular-text" placeholder="e.g. http://www.mycompany.com/contact" />
		<?php Section::end(); ?>
	</div>

	<div id="company_contact_phone_section" style="display: none;">
		<?php Section::begin('company_contact_phone_section', __('What is the phone number?', WPAUTOTERMS_SLUG)); ?>
		<p class="text-muted text-small text-note">Optional. Leave blank if contact method is not available.</p>
		<input type="text" name="company_contact_phone" class="regular-text" placeholder="e.g. 408.996.1010" />
		<?php Section::end(); ?>
	</div>

	<div id="company_contact_address_section" style="display: none;">
		<?php Section::begin('company_contact_address_section', __('What is the address?', WPAUTOTERMS_SLUG)); ?>
		<p class="text-muted text-small text-note">Optional. Leave blank if contact method is not available.</p>
		<input type="text" name="company_contact_address" class="regular-text" placeholder="e.g. 767 Fifth Avenue New York, NY 10153, United States" />
		<?php Section::end(); ?>
	</div>

	<script>
	wpAutoTermsDomReady(function() {
		var contactCheckboxes = document.querySelectorAll('input[name="company_contact[]"]');
		
		function updateContactSections() {
			contactCheckboxes.forEach(function(checkbox) {
				var sectionId = 'company_contact_' + checkbox.value.toLowerCase() + '_section';
				var section = document.getElementById(sectionId);
				if (section) {
					section.style.display = checkbox.checked ? 'block' : 'none';
				}
			});
		}

		contactCheckboxes.forEach(function(checkbox) {
			checkbox.addEventListener('change', updateContactSections);
		});

		// Set initial state
		updateContactSections();
	});
	</script>