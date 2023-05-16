// Get the pickup date element and add an event listener to it
const pickupDateElement = document.getElementById("pickup_date_time");
pickupDateElement.addEventListener("change", handleDateChange);

// Define a function that will handle the date change event
function handleDateChange() {
    // Get the selected pickup date
    const pickupDate = new Date(pickupDateElement.value);
  
    // Calculate the three-day range after the pickup date
    const minDate = new Date(pickupDate.getTime() + (24 * 60 * 60 * 1000)); // Add one day to the pickup date
    const maxDate = new Date(pickupDate.getTime() + (3 * 24 * 60 * 60 * 1000)); // Add three days to the pickup date
  
    // Format the minimum and maximum dates as strings in the format expected by the input field (YYYY-MM-DDTHH:mm)
    const formattedMinDate = formatDate(minDate);
    const formattedMaxDate = formatDate(maxDate);
  
    // Set the minimum and maximum values of the return date input field
    const returnDateElement = document.getElementById("return_date_time");
    returnDateElement.min = formattedMinDate;
    returnDateElement.max = formattedMaxDate;
}

// Helper function to format the date as YYYY-MM-DDTHH:mm
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    const hours = String(date.getHours()).padStart(2, "0");
    const minutes = String(date.getMinutes()).padStart(2, "0");
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}
