<?php

use wpautoterms\admin\form\Section;
use wpautoterms\admin\form\Controls;
?>

<?php Section::begin('entity_type_section', __('Entity type', WPAUTOTERMS_SLUG)); ?>
<?php
Controls::radio('entity_type', array(
    'business' => __('I\'m a business', WPAUTOTERMS_SLUG),
    'individual' => __('I\'m an individual', WPAUTOTERMS_SLUG),
));
?>
<?php Section::end(); ?>

<?php Section::begin('company_name_section', __('What is the name of the business?', WPAUTOTERMS_SLUG)); ?>
    <p class="text-muted text-small text-note">Leave blank if website is not operated by a registered entity (i.e. Corporation, Limited Liability Company, Non-profit, Partnership, Sole Proprietor)</p>
    <input type="text" name="company_name" class="regular-text" value="<?php echo do_shortcode('[wpautoterms company_name]'); ?>" placeholder="Enter your company name" />
<?php Section::end(); ?>

<?php Section::begin('company_address_section', __('What is the address of the business? ', WPAUTOTERMS_SLUG)); ?>
    <p class="text-muted text-small text-note">Leave blank if website is not operated by a registered entity (i.e. Corporation, Limited Liability Company, Non-profit, Partnership, Sole Proprietor)</p>
    <input type="text" name="company_address" class="regular-text" value="<?php echo do_shortcode('[wpautoterms company_address]'); ?>" placeholder="Enter your company address" />
<?php Section::end(); ?>

<script>
wpAutoTermsDomReady(function() {
    // Handle entity type selection
    var entityTypeRadios = document.getElementsByName('entity_type');
    var companyNameSection = document.getElementById('company_name_section');
    var companyAddressSection = document.getElementById('company_address_section');

    function updateCompanySections() {
        var selectedValue = '';
        for (var i = 0; i < entityTypeRadios.length; i++) {
            if (entityTypeRadios[i].checked) {
                selectedValue = entityTypeRadios[i].value;
                break;
            }
        }

        if (companyNameSection && companyAddressSection) {
            if (selectedValue === 'business') {
                companyNameSection.style.display = 'block';
                companyAddressSection.style.display = 'block';
            } else {
                companyNameSection.style.display = 'none';
                companyAddressSection.style.display = 'none';
            }
        }
    }

    // Add change event listeners to radio buttons
    for (var i = 0; i < entityTypeRadios.length; i++) {
        entityTypeRadios[i].addEventListener('change', updateCompanySections);
    }

    // Set initial state
    entityTypeRadios[1].checked = true; // Default to individual
    updateCompanySections();
});
</script>