<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php
    // Default values
    $agreement_for = array('Website');
?>

<h1>Cookies Policy</h1>

<p>Last updated: [wpautoterms last_updated_date]</p>

<p>This Cookies Policy explains what Cookies are and how We use them. You should read this policy so You can understand what type of cookies We use, or the information We collect using Cookies and how that information is used. <?php if (isset($is_free) && $is_free == 'Yes'): ?>This Cookies Policy has been created with the help of the <a href="https://www.termsfeed.com/cookies-policy-generator/">TermsFeed Cookies Policy Generator</a>.<?php endif; ?></p>

<p>Cookies do not typically contain any information that personally identifies a user, but personal information that we store about You may be linked to the information stored in and obtained from Cookies. For further information on how We use, store and keep your personal data secure, see our Privacy Policy.</p>

<p>We do not store sensitive personal information, such as mailing addresses, account passwords, etc. in the Cookies We use.</p>

<h2>Interpretation and Definitions</h2>

<h3>Interpretation</h3>

<p>The words whose initial letters are capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>

<h3>Definitions</h3>

<p>For the purposes of this Cookies Policy:</p>

<ul>
    <li>
        <p><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to <?php if (!empty($company_name) && !empty($company_address)) { ?><?php echo esc_html($company_name); ?>, <?php echo esc_html($company_address); ?><?php } else { ?>[wpautoterms site_name]<?php } ?>.</p>
    </li>
    <li>
        <p><strong>Cookies</strong> means small files that are placed on Your computer, mobile device or any other device by a website, containing details of your browsing history on that website among its many uses.</p>
    </li>
    <li>
        <p><strong>Website</strong> refers to [wpautoterms site_name], accessible from <a href="[wpautoterms site_url]">[wpautoterms site_url]</a></p>
    </li>
    <li>
        <p><strong>You</strong> means the individual accessing or using the Website, or a company, or any legal entity on behalf of which such individual is accessing or using the Website, as applicable.</p>
    </li>
</ul>

<h2>The use of the Cookies</h2>

<h3>Type of Cookies We Use</h3>

<p>Cookies can be "Persistent" or "Session" Cookies. Persistent Cookies remain on your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close your web browser.</p>

<p>We use both session and persistent Cookies for the purposes set out below:</p>

<ul>
    <li>
        <p><strong>Necessary / Essential Cookies</strong></p>
        <p>Type: Session Cookies</p>
        <p>Administered by: Us</p>
        <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
    </li>

    <?php if (isset($cookies_notice) && $cookies_notice == 'Yes'): ?>
    <li>
        <p><strong>Cookies Policy / Notice Acceptance Cookies</strong></p>
        <p>Type: Persistent Cookies</p>
        <p>Administered by: Us</p>
        <p>Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>
    </li>
    <?php endif; ?>

    <li>
        <p><strong>Functionality Cookies</strong></p>
        <p>Type: Persistent Cookies</p>
        <p>Administered by: Us</p>
        <p>Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>
    </li>

    <?php if (isset($cookies_tracking) && $cookies_tracking == 'Yes'): ?>
    <li>
        <p><strong>Tracking and Performance Cookies</strong></p>
        <p>Type: Persistent Cookies</p>
        <p>Administered by: Third Parties</p>
        <p>Purpose: These Cookies are used to track information about traffic to the Website and how users use the Website. The information gathered via these Cookies may directly or indirectly identify you as an individual visitor. This is because the information collected is typically linked to a pseudonymous identifier associated with the device you use to access the Website. We may also use these Cookies to test new pages, features or functionality of the Website to see how our users react to them.</p>
    </li>
    <?php endif; ?>

    <?php if (isset($cookies_advertising) && $cookies_advertising == 'Yes'): ?>
    <li>
        <p><strong>Targeting and Advertising Cookies</strong></p>
        <p>Type: Persistent Cookies</p>
        <p>Administered by: Third Parties</p>
        <p>Purpose: These Cookies track your browsing habits to enable Us to show advertising which is more likely to be of interest to You. These Cookies use information about your browsing history to group You with other users who have similar interests. Based on that information, and with Our permission, third party advertisers can place Cookies to enable them to show adverts which We think will be relevant to your interests while You are on third party websites.</p>
    </li>
    <?php endif; ?>

    <?php if (isset($cookies_social_media) && $cookies_social_media == 'Yes'): ?>
    <li>
        <p><strong>Social Media Cookies</strong></p>
        <p>Type: Persistent Cookies</p>
        <p>Administered by: Third Parties</p>
        <p>Purpose: In addition to Our own Cookies, We may also use various third party plug-ins from social media networking websites such as Facebook, Instagram, Twitter or Google+ to report usage statistics of the Website and to provide social media features. These third party plug-ins may store Cookies. We do not control these Social Media Cookies. Please refer to the relevant social media networking's website privacy policies for information about their cookies.</p>
    </li>
    <?php endif; ?>
</ul>

<h3>Your Choices Regarding Cookies</h3>

<p>If You prefer to avoid the use of Cookies on the Website, first You must disable the use of Cookies in your browser and then delete the Cookies saved in your browser associated with this website. You may use this option for preventing the use of Cookies at any time.</p>

<p>If You do not accept Our Cookies, You may experience some inconvenience in your use of the Website and some features may not function properly.</p>

<p>If You'd like to delete Cookies or instruct your web browser to delete or refuse Cookies, please visit the help pages of your web browser.</p>

<ul>
    <li>For the Chrome web browser, please visit this page from Google: <a href="https://support.google.com/accounts/answer/32050">https://support.google.com/accounts/answer/32050</a></li>
    <li>For the Internet Explorer web browser, please visit this page from Microsoft: <a href="http://support.microsoft.com/kb/278835">http://support.microsoft.com/kb/278835</a></li>
    <li>For the Firefox web browser, please visit this page from Mozilla: <a href="https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored">https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</a></li>
    <li>For the Safari web browser, please visit this page from Apple: <a href="https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac">https://support.apple.com/guide/safari/manage-cookies-and-website-data-sfri11471/mac</a></li>
</ul>

<p>For any other web browser, please visit your web browser's official web pages.</p>

<h3>More Information about Cookies</h3>

<p>You can learn more about cookies here: <a href="https://www.termsfeed.com/blog/cookies/">All About Cookies by TermsFeed</a>.</p>

<?php
if(
    (isset($company_contact_email) && !empty($company_contact_email)) ||
    (isset($company_contact_link) && !empty($company_contact_link)) ||
    (isset($company_contact_phone) && !empty($company_contact_phone)) ||
    (isset($company_contact_address) && !empty($company_contact_address))
) {
?>
<h2>Contact Us</h2>

<p>If you have any questions about this Cookies Policy, You can contact us:</p>

<ul>
<?php if(isset($company_contact_email) && !empty($company_contact_email)) { ?><li>By email: <?php echo esc_html($company_contact_email); ?></li><?php } ?>
<?php if(isset($company_contact_link) && !empty($company_contact_link)) { ?><li>By visiting this page on our website: <?php echo esc_html($company_contact_link); ?></li><?php } ?>
<?php if(isset($company_contact_phone) && !empty($company_contact_phone)) { ?><li>By phone:: <?php echo esc_html($company_contact_phone); ?></li><?php } ?>
<?php if(isset($company_contact_address) && !empty($company_contact_address)) { ?><li>By mail: <?php echo esc_html($company_contact_address); ?></li><?php } ?>
</ul>
<?php } ?>