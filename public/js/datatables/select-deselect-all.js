const selectAll = () => {
    $('#datatable').dataTable().api().rows().select();
}

const deselectAll = () => {
    $('#datatable').dataTable().api().rows().deselect();
}

const selector = document.querySelector('#datatable #selector');
const selectorCheckbox = selector.querySelector('input');

const selectDeselectAction = () => {
    if (selectorCheckbox.checked) {
        selectorCheckbox.checked = false;
        deselectAll();
    } else {
        selectorCheckbox.checked = true;
        selectAll();
    }
}

selector.addEventListener('click', () => {
    selectDeselectAction();
});

selectorCheckbox.addEventListener('click', () => {
    selectDeselectAction();
});
