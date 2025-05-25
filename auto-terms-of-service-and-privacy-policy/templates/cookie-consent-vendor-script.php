<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( ! empty( $vendor_script_name ) ) {
	echo "<!-- Cookie Consent by TermsFeed https://www.TermsFeed.com - $vendor_script_name -->\n";
} ?>
<?php if ( ! empty( $vendor_script_code ) ) {
	echo "$vendor_script_code";
} ?>
<?php if ( ! empty( $vendor_script_name ) ) {
	echo "<!-- End of Cookie Consent by TermsFeed https://www.TermsFeed.com - $vendor_script_name -->\n";
} ?>