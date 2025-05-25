function utf8_to_b64(str) {
    return window.btoa(unescape(encodeURIComponent(str)));
}

function b64_to_utf8(str) {
    return decodeURIComponent(escape(window.atob(str)));
}

function saveObjectToInput(object, input) {
    input.value = utf8_to_b64(JSON.stringify(object));
}

function getUniqueID() {
    return Date.now().toString(36) + Math.random().toString(36).substring(2)
}

function getElementByXpath(path) {
    return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}

document.addEventListener('DOMContentLoaded', function() {
   //

});