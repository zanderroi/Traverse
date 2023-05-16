
// get the pickup date element and add an event listener to it
const pickupDateElement = document.getElementById("pickup_date_time");
pickupDateElement.addEventListener("change", handleDateChange);

// define a function that will handle the date change event
function handleDateChange() {
    // get the selected pickup date
    const pickupDate = new Date(pickupDateElement.value);
  
    // calculate the return date (pickup date + 3 days)
    const returnDate = new Date(pickupDate.getTime() + (3 * 24 * 60 * 60 * 1000));
  
    // format the return date as a string in the format expected by the input field (YYYY-MM-DDTHH:mm)
    const formattedReturnDate = returnDate.toISOString().slice(0, 16);
  
    // set the minimum and maximum values of the return date input field
    const returnDateElement = document.getElementById("return_date_time");
    returnDateElement.min = formattedReturnDate;
    returnDateElement.max = formattedReturnDate;
}
