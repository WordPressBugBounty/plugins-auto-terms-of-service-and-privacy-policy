document.addEventListener('DOMContentLoaded', function () {
    var complianceKitsLink = getElementByXpath('//*[@id="menu-posts-wpautoterms_page"]/ul/li/a[contains(text(),\'Compliance Kits\')]');
    complianceKitsLink.classList.add('current');
    complianceKitsLink.parentNode.classList.add('current');

    var vendorScriptsInput = document.querySelector('input[name="wpautoterms_cc_vendor_scripts_b64"]');
    var addVendorScriptButton = document.querySelector('#add-vendor-script');
    var vendorScripts = [];

    function deleteVendorScript(id) {
        vendorScripts = vendorScripts.filter((item) => item.id !== id);
        renderVendorScripts(vendorScripts);
        saveObjectToInput(vendorScripts, vendorScriptsInput);
    }


    var initVendorScripts = function () {
        return new Promise(function (resolve, reject) {
            if (vendorScriptsInput) {
                try {
                    vendorScripts = JSON.parse(b64_to_utf8(vendorScriptsInput.value));
                } catch (e) {
                    vendorScripts = [];
                    saveObjectToInput(vendorScripts, vendorScriptsInput);
                }
                resolve(vendorScripts);
            }
        });
    };

    var addVendorScript = function (items) {
        try {
            var {script_name, script_type, script_code} = items;

            vendorScripts.push(
                {
                    id: getUniqueID(),
                    script_name: script_name.value,
                    script_type: script_type.value,
                    script_code: script_code.value
                }
            );
            saveObjectToInput(vendorScripts, vendorScriptsInput);
            renderVendorScripts();

            Object.keys(items).forEach((key) => {
                items[key].value = '';
                items[key].checked = false;

            });

        } catch (e) {
        }

    }

    addVendorScriptButton.addEventListener('click', function (e) {
        var script_name = document.querySelector('input[name="wpautoterms_vendor_script_name"]');
        var script_type = document.querySelector('input[name="wpautoterms_vendor_script_type"]:checked');
        var script_code = document.querySelector('textarea[name="wpautoterms_vendor_script_code"]');

        addVendorScript({script_name, script_type, script_code});
    });
    var addShakeEffect = function (vendorScriptId) {
        var theRow = document.querySelector('tr[data-vendor-id="' + vendorScriptId + '"]')
        theRow.classList.add('shake-now');
        setTimeout(function () {
            theRow.classList.remove('shake-now');
        }, 1000);
    }
    var moveButtons = function (vendorScript, direction = 'up') {
        var scripts = vendorScripts;

        var theButton = document.createElement('button');
        theButton.type = 'button';
        theButton.className = 'button button-primary button-small mr-1';
        var index = scripts.findIndex((item) => item.id === vendorScript.id);
        switch (direction) {
            default:
            case 'up':
                theButton.innerHTML = 'Move Up';
                theButton.addEventListener('click', function () {

                    if (index > 0) {
                        var temp = scripts[index - 1];
                        scripts[index - 1] = scripts[index];
                        scripts[index] = temp;
                        renderVendorScripts(scripts);
                        saveObjectToInput(scripts, vendorScriptsInput);
                        addShakeEffect(vendorScript.id);
                    }
                });

                if (index > 0) {
                    return theButton;
                }
                break;
            case 'down':
                theButton.innerHTML = 'Move Down';
                theButton.addEventListener('click', function () {
                    if (index < scripts.length - 1) {
                        var temp = scripts[index + 1];
                        scripts[index + 1] = scripts[index];
                        scripts[index] = temp;
                        renderVendorScripts(scripts);
                        saveObjectToInput(scripts, vendorScriptsInput);
                        addShakeEffect(vendorScript.id);
                    }
                })
                if (index < scripts.length - 1) {
                    return theButton;
                }
                break;
        }
        return document.createElement('div');
    }

    var renderVendorScripts = function (vendorScriptsPassed) {
        var scripts = vendorScripts;
        if (vendorScriptsPassed) {
            scripts = vendorScriptsPassed;
        }

        var table = document.querySelector('#vendor-scripts table');
        var tableBody = document.querySelector('#vendor-scripts table tbody');

        tableBody.innerHTML = '';
        scripts.forEach((vendorScript) => {
            var tr = document.createElement('tr');
            tr.setAttribute('data-vendor-id', vendorScript.id)
            var td = document.createElement('td');
            td.innerHTML = vendorScript.script_name;
            tr.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = vendorScript.script_type;
            tr.appendChild(td);
            td = document.createElement('td');
            td.innerHTML = '<textarea disabled cols="30" rows="10">' + vendorScript.script_code + '</textarea>';
            tr.appendChild(td);
            td = document.createElement('td');
            td.appendChild(moveButtons(vendorScript, 'down'));
            td.appendChild(moveButtons(vendorScript, 'up'));
            tr.appendChild(td);
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'button button-cancel button-small';
            deleteButton.innerHTML = 'Delete';
            deleteButton.onclick = function () {
                var pleaseConfirm = confirm('Are you sure you want to delete this Vendor Script?');
                if (pleaseConfirm) {
                    return deleteVendorScript(vendorScript.id);
                }
            }
            td = document.createElement('td');
            td.appendChild(deleteButton);
            tr.appendChild(td);
            tableBody.appendChild(tr);
        });

        if (scripts.length > 0) {
            table.classList.remove('hidden');
        }

    }


    initVendorScripts().then(function (vendorScripts) {
        renderVendorScripts(vendorScripts);

    });

});