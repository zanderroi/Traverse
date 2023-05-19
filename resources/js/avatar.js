
  // JavaScript code to handle image preview and temporary storage

  const imageInput = document.getElementById('image-input');
  const previewImage = document.getElementById('preview-image');
  const confirmButton = document.getElementById('confirm-button');
  let temporaryImage = null;

  imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage.src = e.target.result;
        temporaryImage = file;
      };
      reader.readAsDataURL(file);
    }
  });

  confirmButton.addEventListener('click', () => {
    if (temporaryImage) {
      // TODO: Save the temporary image to the database
      // You can use AJAX or submit a form to send the image data to the server
      // Once the image is saved, you can update the profile picture on the page
      // with the saved image and close the modal if needed.
    }
  });


  //Modal Script
  // Get the modal element
  const modal = document.getElementById('small-modal');

  // Get the button that opens the modal
  const modalToggleButtons = document.querySelectorAll('[data-modal-toggle="small-modal"]');

  // Get the button that closes the modal
  const modalHideButtons = document.querySelectorAll('[data-modal-hide="small-modal"]');

  // Function to show the modal
  const showModal = () => {
    modal.classList.remove('hidden');
  };

  // Function to hide the modal
  const hideModal = () => {
    modal.classList.add('hidden');
  };

  // Attach event listeners to the toggle buttons
  modalToggleButtons.forEach(button => {
    button.addEventListener('click', showModal);
  });

  // Attach event listeners to the hide buttons
  modalHideButtons.forEach(button => {
    button.addEventListener('click', hideModal);
  });


