// document.addEventListener('DOMContentLoaded', () => {
//     // Get the filter select element
//     const filterSelect = document.getElementById('filterOption');
    
//     // Get the table body element
//     const tableBody = document.getElementById('carsContainer');
    
//     // Get the table header element
//     const tableHeader = document.getElementById('carsHeader');
    
//     // Listen for the change event on the filter select element
//     filterSelect.addEventListener('change', () => {
//       const selectedOption = filterSelect.value;
      
//       // Make an AJAX request to fetch the filtered data
//       fetch(`/cars/details?filter=${selectedOption}`)
//         .then(response => response.text())
//         .then(data => {
//           // Clear the table body
//           while (tableBody.firstChild) {
//             tableBody.firstChild.remove();
//           }
//                   // Clear the table head except the first row
//         while (tableHeader.firstChild) {
//             tableHeader.firstChild.remove();
//           }
  
    
//           // Create a new temporary element to hold the new rows
//           const tempElement = document.createElement('div');
//           tempElement.innerHTML = data;
    
//           // Get the new table rows from the temporary element
//           const newRows = Array.from(tempElement.querySelectorAll('tr'));
    
//           // Append the new rows to the table body
//           newRows.forEach(row => {
//             tableBody.appendChild(row);
//           });
//         })
//         .catch(error => {
//           console.error('Error:', error);
//         });
//     });
//   });
  
document.addEventListener('DOMContentLoaded', () => {
    // Get the filter select element
    const filterSelect = document.getElementById('filterOption');
  
    // Get the table body element
    const tableBody = document.getElementById('carsContainer');
  
    // Get the table header element
    const tableHeader = document.getElementById('carsHeader');
  
    // Get the search input element
    const searchInput = document.getElementById('searchInput');
  
    // Listen for the change event on the filter select element
    filterSelect.addEventListener('change', () => {
      filterCars();
    });
  
    // Listen for the input event on the search input element
    searchInput.addEventListener('input', () => {
      filterCars();
    });
  
    function filterCars() {
      const selectedOption = filterSelect.value;
      const searchValue = searchInput.value.toLowerCase();
  
      // Make an AJAX request to fetch the filtered data
      fetch(`/cars/details?filter=${selectedOption}`)
        .then(response => response.text())
        .then(data => {
          // Clear the table body
          while (tableBody.firstChild) {
            tableBody.firstChild.remove();
          }
          
  
          // Create a new temporary element to hold the new rows
          const tempElement = document.createElement('div');
          tempElement.innerHTML = data;
  
          // Get the new table rows from the temporary element
          const newRows = Array.from(tempElement.querySelectorAll('tr'));
  
          // Filter the new rows based on the search value
          const filteredRows = newRows.filter(row => {
            const columns = Array.from(row.querySelectorAll('td'));
            return columns.some(column => column.textContent.toLowerCase().includes(searchValue));
          });
  
          // Append the filtered rows to the table body
          filteredRows.forEach(row => {
            tableBody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  });
  