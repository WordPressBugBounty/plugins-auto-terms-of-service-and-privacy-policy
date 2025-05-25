document.addEventListener('DOMContentLoaded', function () {

    var complianceKitsLink = getElementByXpath('//*[@id="menu-posts-wpautoterms_page"]/ul/li/a[contains(text(),\'Compliance Kits\')]');
    complianceKitsLink.classList.add('current');
    complianceKitsLink.parentNode.classList.add('current');

    var nameMappings = {
        'wpautoterms_cc_consent_type': 'consent_type',
        'wpautoterms_cc_website_name': 'website_name',
        'wpautoterms_cc_notice_banner_type': 'notice_banner_type',
        'wpautoterms_cc_color_palette': 'palette',
        'wpautoterms_cc_language': 'language',
        'wpautoterms_cc_notice_banner_reject_button_hide': 'notice_banner_reject_button_hide',
        'wpautoterms_cc_preferences_center_close_button_hide': 'preferences_center_close_button_hide',
        'wpautoterms_cc_page_refresh_confirmation_buttons': 'page_refresh_confirmation_buttons',
    };

    function listenForChanges() {
        Object.keys(nameMappings).forEach(function (key) {
            let configKey = nameMappings[key];
            let theElements = document.querySelectorAll('[name="' + key + '"]');

            Array.from(theElements).forEach(function (theElement) {
                theElement.addEventListener('change', function () {
                    window.previewFrame.postMessage(mapFields() , '*');
                });
            });
        });
    }

    function mapFields() {
        var config = {};
        Object.keys(nameMappings).forEach(function (key) {
            let configKey = nameMappings[key];
            let theElement = document.querySelectorAll('[name="' + key + '"]');
            if (theElement.length > 1) {
                theElement = document.querySelectorAll('[name="' + key + '"]:checked')[0];
            } else {
                theElement = theElement[0];
            }
            if(theElement) {
                if (theElement.type === 'checkbox') {
                    config[configKey] = theElement.checked;
                } else {
                    config[configKey] = theElement.value;
                }
            }
        });


        config.demo = 'true';

        return config;
    }

    mapFields();
    listenForChanges();

    // Send initial data to preview iframe when it loads
    function sendInitialDataToPreview() {
        console.log('Attempting to send initial data to preview...');
        
        var data = mapFields();
        console.log('Mapped fields data:', data);
        
        // Validate that we have some data to send
        if (!data || Object.keys(data).length <= 1) { // <= 1 because demo:true is always added
            console.log('No meaningful data to send, skipping');
            return;
        }
        
        var messageSent = false;
        
        // Try to get the iframe by name first
        var iframe = document.querySelector('iframe[name="previewFrame"]');
        if (iframe && iframe.contentWindow) {
            try {
                console.log('Found iframe via querySelector, sending data:', data);
                iframe.contentWindow.postMessage(data, '*');
                messageSent = true;
            } catch (e) {
                console.log('Error sending via iframe.contentWindow:', e);
            }
        }
        
        // Try window.previewFrame as fallback
        if (!messageSent && window.previewFrame) {
            try {
                console.log('Using window.previewFrame, sending data:', data);
                window.previewFrame.postMessage(data, '*');
                messageSent = true;
            } catch (e) {
                console.log('Error sending via window.previewFrame:', e);
            }
        }
        
        // Try frames collection
        if (!messageSent && window.frames && window.frames['previewFrame']) {
            try {
                console.log('Using frames collection, sending data:', data);
                window.frames['previewFrame'].postMessage(data, '*');
                messageSent = true;
            } catch (e) {
                console.log('Error sending via frames collection:', e);
            }
        }
        
        if (!messageSent) {
            console.log('No iframe found or all attempts failed');
        } else {
            console.log('Successfully sent initial data to preview');
        }
    }

    // Multiple approaches to ensure we send initial data
    function setupInitialDataSending() {
        // Approach 1: Try to send immediately if iframe exists
        sendInitialDataToPreview();
        
        // Approach 2: Wait for iframe to be available
        var checkIframe = setInterval(function() {
            var iframe = document.querySelector('iframe[name="previewFrame"]');
            if (iframe) {
                console.log('Iframe found, setting up load listener');
                clearInterval(checkIframe);
                
                // Add load event listener
                iframe.addEventListener('load', function() {
                    console.log('Iframe loaded, sending initial data');
                    setTimeout(sendInitialDataToPreview, 100); // Small delay to ensure iframe is ready
                });
                
                // Also try sending immediately in case it's already loaded
                if (iframe.contentDocument && iframe.contentDocument.readyState === 'complete') {
                    console.log('Iframe already loaded, sending data immediately');
                    setTimeout(sendInitialDataToPreview, 100);
                }
            }
        }, 100);
        
        // Stop checking after 5 seconds
        setTimeout(function() {
            clearInterval(checkIframe);
        }, 5000);
        
        // Approach 3: Try using frames collection (for named frames)
        setTimeout(function() {
            if (window.frames['previewFrame']) {
                console.log('Found frame via frames collection');
                window.previewFrame = window.frames['previewFrame'];
                sendInitialDataToPreview();
            }
        }, 500);
        
        // Approach 4: Use MutationObserver to watch for iframe creation
        if (window.MutationObserver) {
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        var iframe = document.querySelector('iframe[name="previewFrame"]');
                        if (iframe) {
                            console.log('Iframe detected via MutationObserver');
                            observer.disconnect();
                            setTimeout(function() {
                                iframe.addEventListener('load', sendInitialDataToPreview);
                                sendInitialDataToPreview();
                            }, 100);
                        }
                    }
                });
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
            
            // Stop observing after 10 seconds
            setTimeout(function() {
                observer.disconnect();
            }, 10000);
        }
    }

    // Start the setup process
    setupInitialDataSending();

    jQuery("[data-codemirror]").each(function (_, x) {
        var target = x.id;
        var cm = CodeMirror.fromTextArea(x, {
            lineNumbers: true,
            mode: "css",
            hintOptions: {hint: CodeMirror.hint.css},
            styleActiveLine: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            highlightSelectionMatches: {showToken: true, annotateScrollbar: true}
        });
    });


})
