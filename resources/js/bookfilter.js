// Get the filter option element
const filterOption = document.getElementById('filterOption');

// Get the search input element
const searchInput = document.getElementById('searchInput');

// Get all the rows in the table
const rows = document.querySelectorAll('tbody tr');

// Add event listener to the filter option
filterOption.addEventListener('change', () => {
  const selectedValue = filterOption.value;

  // Loop through each row and show/hide based on the filter option
  rows.forEach(row => {
    const returnedAt = row.querySelector('td:nth-child(6)').dataset.returnedAt;

    if (selectedValue === 'all') {
      row.style.display = '';
    } else if (selectedValue === 'on_going') {
      if (!returnedAt || returnedAt === 'null') {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    } else if (selectedValue === 'done') {
      if (returnedAt && returnedAt !== 'null') {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    }
  });
});

// Add event listener to the search input
searchInput.addEventListener('input', () => {
  const searchTerm = searchInput.value.toLowerCase();

  // Loop through each row and show/hide based on the search term
  rows.forEach(row => {
    const bookingId = row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase();
    const customerName = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
    const carDetails = row.querySelector('td:nth-child(3)').textContent.trim().toLowerCase();
    const pickupDate = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
    const returnDate = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
    const bookingStatus = row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase();
    const totalRentalFee = row.querySelector('td:nth-child(7)').textContent.trim().toLowerCase();
    const notes = row.querySelector('td:nth-child(8)').textContent.trim().toLowerCase();

    if (
      bookingId.includes(searchTerm) ||
      customerName.includes(searchTerm) ||
      carDetails.includes(searchTerm) ||
      pickupDate.includes(searchTerm) ||
      returnDate.includes(searchTerm) ||
      bookingStatus.includes(searchTerm) ||
      totalRentalFee.includes(searchTerm) ||
      notes.includes(searchTerm)
    ) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
