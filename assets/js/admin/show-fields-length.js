window.onload = () => {
    // Load all inputs and textareas in whole form, all panels seo, og tags, nastaveni...
    const inputs = document.querySelectorAll('*:is(input, textarea)');
    const separator = '-';

    inputs.forEach( input => {
        const inputMaxLength = input.dataset.maxLength;
        // If is set max lenght in dataset attribute, calculate text length
        if (inputMaxLength) {
            // Load text length after load form
            getFormLength(input, input.id, inputMaxLength, separator);
            // Recalculate text length if text is edited
            input.addEventListener('input', e => {
                getFormLength(input, input.id, inputMaxLength, separator);
            });
        }
    });
}

/**
 * Show after label actual length of text in html field
 * 
 * @param {string} input input, textarea
 * @param {string} fieldName for id="Page_seo_title" is label with css for="Page_seo_title"
 * @param {number} maxLength when green color will be changed to the red
 */
function getFormLength(input, fieldName, maxLength, separator = '-') {
    const labelForm = document.querySelector(`label[for*="${fieldName}"]`);
    // Select only first element from label title, stop cycle reapeat result
    const labelTitle = labelForm.innerHTML.split(separator)[0];
    // Show actual length after label title
    labelForm.innerHTML = maxLengthResult(labelTitle, input.value.length, maxLength, separator);
}

function maxLengthResult(title, currentLength, maxLength, separator = '-') {
    let color = 'success';
    let lengthSufixInflection = 'znaků';

    if (currentLength > maxLength) {
        color = 'danger';
    }

    if (currentLength == 1) {
        lengthSufixInflection = 'znak';
    }
    
    if (currentLength > 1 && currentLength < 5) {
        lengthSufixInflection = 'znaky';
    }

    return `${title} ${separator} <span class="text-${color}"> aktuální délka je: ${currentLength} ${lengthSufixInflection}</span>`;
}