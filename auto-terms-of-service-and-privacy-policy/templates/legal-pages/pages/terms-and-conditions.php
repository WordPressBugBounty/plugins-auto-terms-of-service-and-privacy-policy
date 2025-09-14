<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<?php
    // Default values
    $agreement_for = array('Website');
    $age_restrictions = 'Yes';
    $age_restrictions_minimum_years = 18;
?>

<h1>Terms and Conditions</h1>

<p>Last updated: [wpautoterms last_updated_date]</p>

<p>Please read these Terms and Conditions carefully before using Our Service.</p>

<h2>Interpretation and Definitions</h2>

<h3>Interpretation</h3>

<p>The words whose initial letters are capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>

<h3>Definitions</h3>

<p>For the purposes of these Terms and Conditions:</p>

<?php if (in_array("App", $agreement_for)): ?>
<ul>
    <li><strong>Application</strong> means the software program provided by the Company downloaded by You on any electronic device, named <?php echo esc_html($app_name); ?></li>
    <li><strong>Application Store</strong> means the digital distribution service operated and developed by Apple Inc. (Apple App Store) or Google Inc. (Google Play Store) in which the Application has been downloaded.</li>
</ul>
<?php endif; ?>

<ul>
    <li><strong>Affiliate</strong> means an entity that controls, is controlled by, or is under common control with a party, where "control" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</li>
    
    <?php if (isset($user_accounts) && $user_accounts == 'Yes'): ?>
    <li><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</li>
    <?php endif; ?>
    
    <li><strong>Country</strong> refers to: <?php if (isset($state_name) && !empty($state_name)) { ?><?php echo esc_html($state_name); ?>, <?php } ?><?php if(isset($country_name)) { ?><?php echo esc_html($country_name); ?><?php } ?></li>

    <li><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to <?php if (!empty($company_name) && !empty($company_address)) { ?><?php echo esc_html($company_name); ?>, <?php echo esc_html($company_address); ?><?php } else { ?>[wpautoterms site_name]<?php } ?>.</li>

    <?php if (isset($user_content) && $user_content == 'Yes'): ?>
    <li><strong>Content</strong> refers to content such as text, images, or other information that can be posted, uploaded, linked to or otherwise made available by You, regardless of the form of that content.</li>
    <?php endif; ?>

    <li><strong>Device</strong> means any device that can access the Service such as a computer, a cell phone or a digital tablet.</li>

    <?php if (isset($user_feedback) && $user_feedback == 'Yes'): ?>
    <li><strong>Feedback</strong> means feedback, innovations or suggestions sent by You regarding the attributes, performance or features of our Service.</li>
    <?php endif; ?>

    <?php if (isset($subscriptions_free_trial) && $subscriptions_free_trial == 'Yes'): ?>
    <li><strong>Free Trial</strong> refers to a limited period of time that may be free when purchasing a Subscription.</li>
    <?php endif; ?>

    <?php if (isset($ecommerce) && $ecommerce == 'Yes'): ?>
    <li><strong>Goods</strong> refer to the items offered for sale on the Service.</li>
    <?php endif; ?>

    <?php if (isset($in_app_purchases) && $in_app_purchases == 'Yes'): ?>
    <li><strong>In-app Purchase</strong> refers to the purchase of a product, item, service or Subscription made through the Application and subject to these Terms and Conditions and/or the Application Store's own terms and conditions.</li>
    <?php endif; ?>

    <?php if (isset($ecommerce) && $ecommerce == 'Yes'): ?>
    <li><strong>Orders</strong> mean a request by You to purchase Goods from Us.</li>
    <?php endif; ?>

    <?php if (isset($promotions) && $promotions == 'Yes'): ?>
    <li><strong>Promotions</strong> refer to contests, sweepstakes or other promotions offered through the Service.</li>
    <?php endif; ?>

    <?php
    if (count($agreement_for) == 1) {
        if (in_array("Website", $agreement_for)) {
            echo '<li><strong>Service</strong> refers to the Website.</li>';
        } elseif (in_array("App", $agreement_for)) {
            echo '<li><strong>Service</strong> refers to the Application.</li>';
        }
    } else {
        echo '<li><strong>Service</strong> refers to the Application or the Website or both.</li>';
    }
    ?>

    <?php if (isset($subscriptions) && $subscriptions == 'Yes'): ?>
    <li><strong>Subscriptions</strong> refer to the services or access to the Service offered on a subscription basis by the Company to You.</li>
    <?php endif; ?>

    <li><strong>Terms and Conditions</strong> (also referred as "Terms") mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service. <?php if (isset($is_free) && $is_free == 'Yes'): ?>This Terms and Conditions agreement has been created with the help of the <a href="https://www.termsfeed.com/terms-conditions-generator/">TermsFeed Terms and Conditions Generator</a>.<?php endif; ?></li>

    <li><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</li>

    <?php if (in_array("Website", $agreement_for)): ?>
    <li><strong>Website</strong> refers to [wpautoterms site_name], accessible from <a href="[wpautoterms site_url]">[wpautoterms site_url]</a></li>
    <?php endif; ?>

    <li><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>
</ul>

<h2>Acknowledgment</h2>

<p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>

<p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>

<p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.</p>

<?php if (isset($age_restrictions) && $age_restrictions == 'Yes'): ?>
<p>You represent that you are over the age of <?php echo esc_html($age_restrictions_minimum_years); ?>. The Company does not permit those under <?php echo esc_html($age_restrictions_minimum_years); ?> to use the Service.</p>
<?php endif; ?>

<p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>

<?php if (isset($ecommerce) && $ecommerce == 'Yes'): ?>
<h2>Placing Orders for Goods</h2>

<p>By placing an Order for Goods through the Service, You warrant that You are legally capable of entering into binding contracts.</p>

<h3>Your Information</h3>

<p>If You wish to place an Order for Goods available on the Service, You may be asked to supply certain information relevant to Your Order including, without limitation, Your name, Your email, Your phone number, Your credit card number, the expiration date of Your credit card, Your billing address, and Your shipping information.</p>

<p>You represent and warrant that: (i) You have the legal right to use any credit or debit card(s) or other payment method(s) in connection with any Order; and that (ii) the information You supply to us is true, correct and complete.</p>

<p>By submitting such information, You grant us the right to provide the information to payment processing third parties for purposes of facilitating the completion of Your Order.</p>

<h3>Order Cancellation</h3>

<p>We reserve the right to refuse or cancel Your Order at any time for certain reasons including but not limited to:</p>

<ul>
    <li>Goods availability</li>
    <li>Errors in the description or prices for Goods</li>
    <li>Errors in Your Order</li>
</ul>

<p>We reserve the right to refuse or cancel Your Order if fraud or an unauthorized or illegal transaction is suspected.</p>

<h4>Your Order Cancellation Rights</h4>

<p>Any Goods you purchase can only be returned in accordance with these Terms and Conditions and Our Returns Policy.</p>

<p>Our Returns Policy forms a part of these Terms and Conditions. Please read our Returns Policy to learn more about your right to cancel Your Order.</p>

<p>Your right to cancel an Order only applies to Goods that are returned in the same condition as You received them. You should also include all of the product's instructions, documents and wrappings. Goods that are damaged or not in the same condition as You received them or which are worn simply beyond opening the original packaging will not be refunded. You should therefore take reasonable care of the purchased Goods while they are in Your possession.</p>

<p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.</p>

<p>You will not have any right to cancel an Order for the supply of any of the following Goods:</p>

<ul>
    <li>The supply of Goods made to Your specifications or clearly personalized.</li>
    <li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.</li>
    <li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.</li>
    <li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.</li>
    <li>The supply of digital content which is not supplied on a tangible medium if the performance has begun with Your prior express consent and You have acknowledged Your loss of cancellation right.</li>
</ul>

<h3>Availability, Errors and Inaccuracies</h3>

<p>We are constantly updating Our offerings of Goods on the Service. The Goods available on Our Service may be mispriced, described inaccurately, or unavailable, and We may experience delays in updating information regarding our Goods on the Service and in Our advertising on other websites.</p>

<p>We cannot and do not guarantee the accuracy or completeness of any information, including prices, product images, specifications, availability, and services. We reserve the right to change or update information and to correct errors, inaccuracies, or omissions at any time without prior notice.</p>

<h3>Prices Policy</h3>

<p>The Company reserves the right to revise its prices at any time prior to accepting an Order.</p>

<p>The prices quoted may be revised by the Company subsequent to accepting an Order in the event of any occurrence affecting delivery caused by government action, variation in customs duties, increased shipping charges, higher foreign exchange costs and any other matter beyond the control of the Company. In that event, You will have the right to cancel Your Order.</p>

<h3>Payments</h3>

<p>All Goods purchased are subject to a one-time payment. Payment can be made through various payment methods we have available, such as Visa, MasterCard, Affinity Card, American Express cards or online payment methods (PayPal, for example).</p>

<p>Payment cards (credit cards or debit cards) are subject to validation checks and authorization by Your card issuer. If we do not receive the required authorization, We will not be liable for any delay or non-delivery of Your Order.</p>
<?php endif; ?>

<?php if (isset($subscriptions) && $subscriptions == 'Yes'): ?>
<h2>Subscriptions</h2>

<h3>Subscription period</h3>

<p>The Service or some parts of the Service are available only with a paid Subscription. You will be billed in advance on a recurring and periodic basis (such as daily, weekly, monthly or annually), depending on the type of Subscription plan you select when purchasing the Subscription.</p>

<p>At the end of each period, Your Subscription will automatically renew under the exact same conditions unless You cancel it or the Company cancels it.</p>

<h3>Subscription cancellations</h3>

<p>You may cancel Your Subscription renewal either through Your Account settings page or by contacting the Company. You will not receive a refund for the fees You already paid for Your current Subscription period and You will be able to access the Service until the end of Your current Subscription period.</p>

<?php if (isset($in_app_purchases) && $in_app_purchases == 'Yes'): ?>
<p>If the Subscription has been made through an In-app Purchase, You can cancel the renewal of Your Subscription with the Application Store.</p>
<?php endif; ?>

<h3>Billing</h3>

<p>You shall provide the Company with accurate and complete billing information including full name, address, state, zip code, telephone number, and a valid payment method information.</p>

<p>Should automatic billing fail to occur for any reason, the Company will issue an electronic invoice indicating that you must proceed manually, within a certain deadline date, with the full payment corresponding to the billing period as indicated on the invoice.</p>

<?php if (isset($in_app_purchases) && $in_app_purchases == 'Yes'): ?>
<p>If the Subscription has been made through an In-app Purchase, all billing is handled by the Application Store and is governed by the Application Store's own terms and conditions.</p>
<?php endif; ?>

<h3>Fee Changes</h3>

<p>The Company, in its sole discretion and at any time, may modify the Subscription fees. Any Subscription fee change will become effective at the end of the then-current Subscription period.</p>

<p>The Company will provide You with reasonable prior notice of any change in Subscription fees to give You an opportunity to terminate Your Subscription before such change becomes effective.</p>

<p>Your continued use of the Service after the Subscription fee change comes into effect constitutes Your agreement to pay the modified Subscription fee amount.</p>

<h3>Refunds</h3>

<p>Except when required by law, paid Subscription fees are non-refundable.</p>

<p>Certain refund requests for Subscriptions may be considered by the Company on a case-by-case basis and granted at the sole discretion of the Company.</p>

<?php if (isset($in_app_purchases) && $in_app_purchases == 'Yes'): ?>
<p>If the Subscription has been made through an In-app purchase, the Application Store's refund policy will apply. If You wish to request a refund, You may do so by contacting the Application Store directly.</p>
<?php endif; ?>

<?php if (isset($subscriptions_free_trial) && $subscriptions_free_trial == 'Yes'): ?>
<h3>Free Trial</h3>

<p>The Company may, at its sole discretion, offer a Subscription with a Free Trial for a limited period of time.</p>

<p>You may be required to enter Your billing information in order to sign up for the Free Trial.</p>

<p>If You do enter Your billing information when signing up for a Free Trial, You will not be charged by the Company until the Free Trial has expired. On the last day of the Free Trial period, unless You canceled Your Subscription, You will be automatically charged the applicable Subscription fees for the type of Subscription You have selected.</p>

<p>At any time and without notice, the Company reserves the right to (i) modify the terms and conditions of the Free Trial offer, or (ii) cancel such Free Trial offer.</p>
<?php endif; ?>
<?php endif; ?>

<?php if (isset($in_app_purchases) && $in_app_purchases == 'Yes'): ?>
<h2>In-app Purchases</h2>

<p>The Application may include In-app Purchases that allow you to buy products, services or Subscriptions.</p>

<p>More information about how you may be able to manage In-app Purchases using your Device may be set out in the Application Store's own terms and conditions or in your Device's Help settings.</p>

<p>In-app Purchases can only be consumed within the Application. If you make a In-app Purchase, that In-app Purchase cannot be cancelled after you have initiated its download. In-app Purchases cannot be redeemed for cash or other consideration or otherwise transferred.</p>

<p>If any In-app Purchase is not successfully downloaded or does not work once it has been successfully downloaded, we will, after becoming aware of the fault or being notified to the fault by You, investigate the reason for the fault. We will act reasonably in deciding whether to provide You with a replacement In-app Purchase or issue You with a patch to repair the fault. In no event will We charge You to replace or repair the In-app Purchase. In the unlikely event that we are unable to replace or repair the relevant In-app Purchase or are unable to do so within a reasonable period of time and without significant inconvenience to You, We will authorize the Application Store to refund You an amount up to the cost of the relevant In-app Purchase. Alternatively, if You wish to request a refund, You may do so by contacting the Application Store directly.</p>

<p>You acknowledge and agree that all billing and transaction processes are handled by the Application Store from where you downloaded the Application and are governed by that Application Store's own terms and conditions.</p>

<p>If you have any payment related issues with In-app Purchases, then you need to contact the Application Store directly.</p>
<?php endif; ?>

<?php if (isset($promotions) && $promotions == 'Yes'): ?>
<h2>Promotions</h2>

<p>Any Promotions made available through the Service may be governed by rules that are separate from these Terms.</p>

<p>If You participate in any Promotions, please review the applicable rules as well as our Privacy policy. If the rules for a Promotion conflict with these Terms, the Promotion rules will apply.</p>
<?php endif; ?>

<?php if (isset($user_accounts) && $user_accounts == 'Yes'): ?>
<h2>User Accounts</h2>

<p>When You create an account with Us, You must provide Us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of Your account on Our Service.</p>

<p>You are responsible for safeguarding the password that You use to access the Service and for any activities or actions under Your password, whether Your password is with Our Service or a Third-Party Social Media Service.</p>

<p>You agree not to disclose Your password to any third party. You must notify Us immediately upon becoming aware of any breach of security or unauthorized use of Your account.</p>

<p>You may not use as a username the name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of another person or entity other than You without appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.</p>
<?php endif; ?>

<?php if (isset($user_content) && $user_content == 'Yes'): ?>
<h2>Content</h2>

<h3>Your Right to Post Content</h3>

<p>Our Service allows You to post Content. You are responsible for the Content that You post to the Service, including its legality, reliability, and appropriateness.</p>

<p>By posting Content to the Service, You grant Us the right and license to use, modify, publicly perform, publicly display, reproduce, and distribute such Content on and through the Service. You retain any and all of Your rights to any Content You submit, post or display on or through the Service and You are responsible for protecting those rights. You agree that this license includes the right for Us to make Your Content available to other users of the Service, who may also use Your Content subject to these Terms.</p>

<p>You represent and warrant that: (i) the Content is Yours (You own it) or You have the right to use it and grant Us the rights and license as provided in these Terms, and (ii) the posting of Your Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any person.</p>

<h3>Content Restrictions</h3>

<p>The Company is not responsible for the content of the Service's users. You expressly understand and agree that You are solely responsible for the Content and for all activity that occurs under Your account, whether done so by You or any third person using Your account.</p>

<p>You may not transmit any Content that is unlawful, offensive, upsetting, intended to disgust, threatening, libelous, defamatory, obscene or otherwise objectionable. Examples of such objectionable Content include, but are not limited to, the following:</p>

<ul>
    <li>Unlawful or promoting unlawful activity.</li>
    <li>Defamatory, discriminatory, or mean-spirited content, including references or commentary about religion, race, sexual orientation, gender, national/ethnic origin, or other targeted groups.</li>
    <li>Spam, machine – or randomly – generated, constituting unauthorized or unsolicited advertising, chain letters, any other form of unauthorized solicitation, or any form of lottery or gambling.</li>
    <li>Containing or installing any viruses, worms, malware, trojan horses, or other content that is designed or intended to disrupt, damage, or limit the functioning of any software, hardware or telecommunications equipment or to damage or obtain unauthorized access to any data or other information of a third person.</li>
    <li>Infringing on any proprietary rights of any party, including patent, trademark, trade secret, copyright, right of publicity or other rights.</li>
    <li>Impersonating any person or entity including the Company and its employees or representatives.</li>
    <li>Violating the privacy of any third person.</li>
    <li>False information and features.</li>
</ul>

<p>The Company reserves the right, but not the obligation, to, in its sole discretion, determine whether or not any Content is appropriate and complies with these Terms, refuse or remove this Content. The Company further reserves the right to make formatting and edits and change the manner of any Content. The Company can also limit or revoke the use of the Service if You post such objectionable Content.</p>

<p>As the Company cannot control all content posted by users and/or third parties on the Service, you agree to use the Service at your own risk. You understand that by using the Service You may be exposed to content that You may find offensive, indecent, incorrect or objectionable, and You agree that under no circumstances will the Company be liable in any way for any content, including any errors or omissions in any content, or any loss or damage of any kind incurred as a result of your use of any content.</p>

<h3>Content Backups</h3>

<p>Although regular backups of Content are performed, the Company does not guarantee there will be no loss or corruption of data.</p>

<p>Corrupt or invalid backup points may be caused by, without limitation, Content that is corrupted prior to being backed up or that changes during the time a backup is performed.</p>

<p>The Company will provide support and attempt to troubleshoot any known or discovered issues that may affect the backups of Content. But You acknowledge that the Company has no liability related to the integrity of Content or the failure to successfully restore Content to a usable state.</p>

<p>You agree to maintain a complete and accurate copy of any Content in a location independent of the Service.</p>
<?php endif; ?>

<?php if (isset($user_content) && $user_content == 'Yes'): ?>
<h2>Copyright Policy</h2>

<h3>Intellectual Property Infringement</h3>

<p>We respect the intellectual property rights of others. It is Our policy to respond to any claim that Content posted on the Service infringes a copyright or other intellectual property infringement of any person.</p>

<p>If You are a copyright owner, or authorized on behalf of one, and You believe that the copyrighted work has been copied in a way that constitutes copyright infringement that is taking place through the Service, You must submit Your notice in writing to the attention of our copyright agent via email at <?php echo esc_html($copyright_policy_agent_email); ?> and include in Your notice a detailed description of the alleged infringement.</p>

<p>You may be held accountable for damages (including costs and attorneys' fees) for misrepresenting that any Content is infringing Your copyright.</p>

<?php if (isset($dmca_notice) && $dmca_notice == 'Yes'): ?>
<h3>DMCA Notice and DMCA Procedure for Copyright Infringement Claims</h3>

<p>You may submit a notification pursuant to the Digital Millennium Copyright Act (DMCA) by providing our Copyright Agent with the following information in writing (see 17 U.S.C 512(c)(3) for further detail):</p>

<ul>
    <li>An electronic or physical signature of the person authorized to act on behalf of the owner of the copyright's interest.</li>
    <li>A description of the copyrighted work that You claim has been infringed, including the URL (i.e., web page address) of the location where the copyrighted work exists or a copy of the copyrighted work.</li>
    <li>Identification of the URL or other specific location on the Service where the material that You claim is infringing is located.</li>
    <li>Your address, telephone number, and email address.</li>
    <li>A statement by You that You have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law.</li>
    <li>A statement by You, made under penalty of perjury, that the above information in Your notice is accurate and that You are the copyright owner or authorized to act on the copyright owner's behalf.</li>
</ul>

<p>You can contact our copyright agent via email at <?php echo esc_html($copyright_policy_agent_email); ?>. Upon receipt of a notification, the Company will take whatever action, in its sole discretion, it deems appropriate, including removal of the challenged content from the Service.</p>
<?php endif; ?>
<?php endif; ?>

<?php if (isset($intellectual_property) && $intellectual_property == 'Yes'): ?>
<h2>Intellectual Property</h2>

<p>The Service and its original content (excluding Content provided by You or other users), features and functionality are and will remain the exclusive property of the Company and its licensors.</p>

<p>The Service is protected by copyright, trademark, and other laws of both the Country and foreign countries.</p>

<p>Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of the Company.</p>
<?php endif; ?>

<?php if (isset($user_feedback) && $user_feedback == 'Yes'): ?>
<h2>Your Feedback to Us</h2>

<p>You assign all rights, title and interest in any Feedback You provide the Company. If for any reason such assignment is ineffective, You agree to grant the Company a non-exclusive, perpetual, irrevocable, royalty free, worldwide right and license to use, reproduce, disclose, sub-license, distribute, modify and exploit such Feedback without restriction.</p>
<?php endif; ?>

<h2>Links to Other Websites</h2>

<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by the Company.</p>

<p>The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>

<p>We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services that You visit.</p>

<h2>Termination</h2>

<?php if (isset($user_accounts) && $user_accounts == 'Yes'): ?>
<p>We may terminate or suspend Your Account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>

<p>Upon termination, Your right to use the Service will cease immediately. If You wish to terminate Your Account, You may simply discontinue using the Service.</p>
<?php elseif (!isset($user_accounts) || $user_accounts != 'Yes'): ?>
<p>We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>

<p>Upon termination, Your right to use the Service will cease immediately.</p>
<?php elseif (isset($user_accounts) && $user_accounts == 'Yes' && (!isset($subscriptions) || $subscriptions != 'Yes')): ?>
<p>We may terminate or suspend Your Account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>

<p>Upon termination, Your right to use the Service will cease immediately. If You wish to terminate Your Account, You may simply discontinue using the Service.</p>

<p>For any termination of a Subscription, We will refund any prepaid fees covering the remainder of the term of the Subscription after the effective date of termination. In no event will any termination relieve You of the obligation to pay any fees payable to Us for the period prior to the effective date of termination.</p>
<?php endif; ?>

<h2>Limitation of Liability</h2>

<p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven't purchased anything through the Service.</p>

<p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>

<p>Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party's liability will be limited to the greatest extent permitted by law.</p>

<h2>"AS IS" and "AS AVAILABLE" Disclaimer</h2>

<p>The Service is provided to You "AS IS" and "AS AVAILABLE" and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>

<p>Without limiting the foregoing, neither the Company nor any of the company's provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>

<p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>

<h2>Governing Law</h2>

<p>The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>

<h2>Disputes Resolution</h2>

<p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>

<?php if (isset($compliance_for_eu_users) && $compliance_for_eu_users == 'Yes'): ?>
<h2>For European Union (EU) Users</h2>

<p>If You are a European Union consumer, you will benefit from any mandatory provisions of the law of the country in which You are resident.</p>
<?php endif; ?>

<?php if (isset($subscriptions) && $subscriptions == 'Yes'): ?>
<?php if (isset($compliance_us_end_user_provisions) && $compliance_us_end_user_provisions == 'Yes'): ?>
<h2>United States Federal Government End Use Provisions</h2>
<p>If You are a U.S. federal government end user, our Service is a "Commercial Item" as that term is defined at 48 C.F.R. §2.101.</p>
<?php endif; ?>
<?php endif; ?>

<?php if (isset($compliance_us_legal_compliance) && $compliance_us_legal_compliance == 'Yes'): ?>
<h2>United States Legal Compliance</h2>

<p>You represent and warrant that (i) You are not located in a country that is subject to the United States government embargo, or that has been designated by the United States government as a "terrorist supporting" country, and (ii) You are not listed on any United States government list of prohibited or restricted parties.</p>
<?php endif; ?>

<h2>Severability and Waiver</h2>

<h3>Severability</h3>

<p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>

<h3>Waiver</h3>

<p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under these Terms shall not affect a party's ability to exercise such right or require such performance at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.</p>

<h2>Translation Interpretation</h2>

<p>These Terms and Conditions may have been translated if We have made them available to You on our Service. You agree that the original English text shall prevail in the case of a dispute.</p>

<h2>Changes to These Terms and Conditions</h2>

<p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>

<p>By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.</p>

<?php
if(
    (isset($company_contact_email) && !empty($company_contact_email)) ||
    (isset($company_contact_link) && !empty($company_contact_link)) ||
    (isset($company_contact_phone) && !empty($company_contact_phone)) ||
    (isset($company_contact_address) && !empty($company_contact_address))
) {
?>
<h2>Contact Us</h2>

<p>If you have any questions about these Terms and Conditions, You can contact us:</p>

<ul>
<?php if(isset($company_contact_email) && !empty($company_contact_email)) { ?><li>By email: <?php echo esc_html($company_contact_email); ?></li><?php } ?>
<?php if(isset($company_contact_link) && !empty($company_contact_link)) { ?><li>By visiting this page on our website: <?php echo esc_html($company_contact_link); ?></li><?php } ?>
<?php if(isset($company_contact_phone) && !empty($company_contact_phone)) { ?><li>By phone:: <?php echo esc_html($company_contact_phone); ?></li><?php } ?>
<?php if(isset($company_contact_address) && !empty($company_contact_address)) { ?><li>By mail: <?php echo esc_html($company_contact_address); ?></li><?php } ?>
</ul>
<?php } ?>
