<?php
// Prevent plugin loading during WordPress bootstrap to avoid translation errors
define('WP_USE_THEMES', false);
define('WP_INSTALLING', true); // This prevents plugin loading

// Load WordPress 
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '../wp-load.php';

// Define the constants we need
if ( ! defined( 'WPAUTOTERMS_OPTION_PREFIX' ) ) {
    define( 'WPAUTOTERMS_OPTION_PREFIX', 'wpautoterms_' );
}
if ( ! defined( 'WPAUTOTERMS_COOKIE_CONSENT_VERSION' ) ) {
    define( 'WPAUTOTERMS_COOKIE_CONSENT_VERSION', '4.2.0' );
}

// Get preview data directly without using plugin classes
function get_preview_data_direct() {
    // Get selected version
    $selected_version = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_selected_version' );
    if ( ! $selected_version ) {
        $selected_version = WPAUTOTERMS_COOKIE_CONSENT_VERSION;
    }
    
    // Get cookie consent URL
    $cookie_consent_url = 'https://www.termsfeed.com/public/cookie-consent/' . $selected_version . '/cookie-consent.js';
    
    // Get configuration parameters
    $selected_version_with_dash = str_replace('.', '_', $selected_version);
    $configuration_parameters = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_configuration_parameters_' . $selected_version_with_dash );
    
    if ( $configuration_parameters && is_string( $configuration_parameters ) ) {
        $decoded = json_decode($configuration_parameters);
        if($decoded !== null) {
            // Convert objects that are represented as STRINGS to Real JS objects
            $string_fields_to_objects = ["callbacks"];
            foreach($string_fields_to_objects as $field) {
                $pattern = '/("'.$field.'": "\{)(.*)(}")/s';
                $replacement = '"'.$field.'": {$2}';
                $configuration_parameters = preg_replace($pattern, $replacement, $configuration_parameters);
            }
            
            // Add demo flag
            $decoded = json_decode($configuration_parameters, true);
            $decoded['demo'] = 'true';
            $configuration_parameters = json_encode($decoded);
        }
    } else {
        $configuration_parameters = '';
    }
    
    // Get custom CSS
    $custom_css = get_option( WPAUTOTERMS_OPTION_PREFIX . 'cc_custom_css' );
    if ( $custom_css === null || !is_string( $custom_css ) ) {
        $custom_css = '';
    }
    
    return array(
        'custom_css' => $custom_css,
        'cookie_consent_url' => $cookie_consent_url,
        'configuration_parameters' => $configuration_parameters
    );
}

$preview_data = get_preview_data_direct();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cookie Consent preview</title>
	<style type="text/css">
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            background-color: #fff;
        }
	</style>
	<script src="<?php echo esc_url( $preview_data['cookie_consent_url'] ); ?>" id='wpautoterms_js_cookie_consent-js'></script>
	<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            <?php if ( !empty( $preview_data['configuration_parameters'] ) ): ?>
            cookieconsent.run(<?php echo $preview_data['configuration_parameters']; ?>);
            <?php endif; ?>
        });
        var clearData = () => {
            return new Promise((resolve, reject) => {
                // Clone the container
                var container = document.getElementById("container");
                var cloned_container = container.cloneNode(true);

                console.log(cloned_container.children);

                // Remove all DOM data & append the container again
                document.body.innerHTML = '';
                document.body.appendChild(cloned_container);

                // Clear the preferencesCenterContainer to avoid having multiple preferences center tags
                if (window.cookieconsent && window.cookieconsent.cookieConsentObject) {
                    window.cookieconsent.cookieConsentObject.preferencesCenterContainer = null;
                }

                resolve(true);
            })

        }

        var initialize = (data) => {
            clearData().then((result) => {
                cookieconsent.run(data)
            })
        }

        window.onmessage = function (e) {
            if (e.data.demo) {
                console.log(e.data)
                initialize(e.data)
            }
        }

	</script>
	<?php if ( ! empty( $preview_data['custom_css'] ) ): ?>
	<style>
<?php echo $preview_data['custom_css']; ?>
	</style>
	<?php endif; ?>
</head>
<body>
<div id="container">
	<h2>This is a preview page.</h2>
	<p>
		You can click "OK" or "I agree". Change your cookies preferences through the Preferences Center:
	</p>
	<p>
		<button id="open_preferences_center" class="btn-outline">Open Preferences Center</button>
	</p>
</div>

</body>
</html>