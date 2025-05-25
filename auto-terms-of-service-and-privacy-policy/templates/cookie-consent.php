<?php

use \wpautoterms\frontend\cookie_consent\Cookie_Consent_Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( ! empty( $custom_css ) ) {
	echo <<<EOT
<style id="termsfeed-autoterms-cookie-consent-style">
/* TermsFeed AutoTerms (WP AutoTerms) plugin */
$custom_css
</style>
EOT;
} ?>

<!-- Cookie Consent by TermsFeed https://www.TermsFeed.com -->
<script type="text/javascript" charset="UTF-8" id="termsfeed-autoterms-cookie-consent-script">
document.addEventListener('DOMContentLoaded', function () {
	<?php if ( ! empty( $configuration_parameters ) ) {
		echo "cookieconsent.run($configuration_parameters);\n";
	} ?>
});
</script>

<noscript>Free cookie consent management tool by <a href="https://www.termsfeed.com/">TermsFeed</a></noscript>
<!-- End Cookie Consent by TermsFeed https://www.TermsFeed.com -->

<?php Cookie_Consent_Main::show_vendor_scripts(); ?>
