// Clear localStorage
localStorage.clear();

// Check if the modal should be shown
if (!localStorage.getItem('avoidModal')) {
  // Get the modal element
  const modal = document.getElementById('popupModal');

  // Get the close button and add a click event listener to close the modal
  const closeModalBtn = document.getElementById('closeModalBtn');
  closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Enable scrolling on the body
  });

  // Get the avoid modal checkbox and add a change event listener to handle avoiding the modal
  const avoidModalCheckbox = document.getElementById('avoidModalCheckbox');
  avoidModalCheckbox.addEventListener('change', () => {
    if (avoidModalCheckbox.checked) {
      localStorage.setItem('avoidModal', 'true');
    } else {
      localStorage.removeItem('avoidModal');
    }
  });

  // Display the modal
  modal.style.display = 'block';
  document.body.style.overflow = 'hidden'; // Disable scrolling on the body
} else {
  // If the avoidModal value is set, hide the modal
  const modal = document.getElementById('popupModal');
  modal.style.display = 'none';
  document.body.style.overflow = 'auto'; // Enable scrolling on the body
}
