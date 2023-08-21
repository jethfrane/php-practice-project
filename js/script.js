const editButton = document.getElementById('edit-button');
const actionHeader = document.getElementById('action-header');
const actionCells = document.getElementsByClassName('actions-cell');

editButton.addEventListener('click', function () {
    actionHeader.style.display = actionHeader.style.display === 'none' ? 'table-cell' : 'none';
    for (let cell of actionCells) {
        cell.style.display = actionHeader.style.display;
    }
});

// Rest of your JavaScript code

const searchInput = document.getElementById('search');
const searchResults = document.getElementById('search-results');

searchInput.addEventListener('input', function () {
    const searchTerm = searchInput.value.toLowerCase();
    const rows = searchResults.getElementsByTagName('tr');

    for (let row of rows) {
        const firstName = row.getElementsByTagName('td')[1].textContent.toLowerCase();
        const lastName = row.getElementsByTagName('td')[2].textContent.toLowerCase();
        const isVisible = firstName.includes(searchTerm) || lastName.includes(searchTerm);
        row.style.display = isVisible ? 'table-row' : 'none';
    }
});

// Function to change items per page
function changeItemsPerPage(select) {
    const selectedValue = select.options[select.selectedIndex].value;
    window.location.href = `?page=1&itemsPerPage=${selectedValue}`;
}