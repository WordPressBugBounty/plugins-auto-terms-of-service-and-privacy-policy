
document.addEventListener('DOMContentLoaded', function () {
    var complianceKitsLink = getElementByXpath('//*[@id="menu-posts-wpautoterms_page"]/ul/li/a[contains(text(),\'Compliance Kits\')]');
    complianceKitsLink.classList.add('current');
    complianceKitsLink.parentNode.classList.add('current');
});