(function () {
    var handlers = [];
    var ran = false;

    function runHandlers() {
        if (ran) {
            return;
        }
        ran = true;
        for (var k in handlers) {
            handlers[k](jQuery);
        }
    }

    // Check if wp.domReady is available (may not be when WP Rocket defers scripts)
    if (typeof wp !== 'undefined' && typeof wp.domReady === 'function') {
        wp.domReady(runHandlers);
    } else {
        // Fallback to jQuery ready if wp is not available yet
        jQuery(document).ready(runHandlers);
    }

    function wpAutoTermsDomReady(fn) {
        if (ran) {
            fn(jQuery);
        } else {
            handlers.push(fn);
        }
    }

    window.wpAutoTermsDomReady = wpAutoTermsDomReady;
    var oldErrorHandler = window.onerror;
    window.onerror = function () {
        runHandlers();
        if (oldErrorHandler) {
            oldErrorHandler.apply(null, arguments);
        }
    }
    jQuery.readyException = runHandlers;
})();
