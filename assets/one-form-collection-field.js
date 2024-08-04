// Forms with inline tabs
const formNav = document.querySelectorAll('.nav-tabs .nav-link');
formNav.forEach(activeTab => {
    activeTab.addEventListener('click', e => {
        // From css #id we can select active tab with form (nav - id == tab - aria-labelledby)
        changeForm(e.target.id);
    })
});

function changeForm(id) {
    // Select current form for active tab
    const activeTab = `[aria-labelledby=${id}]`;
    const form = document.querySelector(activeTab + ' .only-one-form-in-collection .accordion');
    const buttonAddNewItem = document.querySelector(activeTab + ' .only-one-form-in-collection .field-collection-add-button');

    // If form exists, as edit page
    if (form) {
        const legend = document.querySelector(activeTab + ' legend');
        const formHeader = document.querySelector(activeTab + ' .accordion-header');
        // Change css style form
        legend.classList.add('d-none');
        formHeader.classList.add('d-none');
        form.classList.add('shadow-none');
        // Disable create new forms
        buttonAddNewItem.classList.add('d-none');

    } else {
        // Autoclick to the button for create new form
        buttonAddNewItem.click();
        changeForm(id);
    }
}