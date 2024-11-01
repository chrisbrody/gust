function toggleEdit(goalId, label) {
    const displayElement = document.getElementById(goalId + '-display');
    const editElement = document.getElementById(goalId);

    // Toggle visibility based on current state
    if (displayElement.style.display !== 'none') {
        displayElement.style.display = 'none';
        editElement.style.display = 'block';
        editElement.focus();
    } else {
        // Update display text with textarea value or a custom message based on the label
        const newValue = editElement.value.trim();
        displayElement.textContent = newValue || `Click here to add ${label}`;

        displayElement.style.display = 'block';
        editElement.style.display = 'none';
    }
}
