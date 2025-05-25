function getElementByXpath(path) {
    return document.evaluate(path, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
}

document.addEventListener('DOMContentLoaded', function () {
    var settingsLink = getElementByXpath('//*[@id="menu-posts-wpautoterms_page"]/ul/li/a[contains(text(),\'Settings\')]');
    settingsLink.classList.add('current');
    settingsLink.parentNode.classList.add('current');
});