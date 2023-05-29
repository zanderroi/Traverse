
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
   // Create a new FormData object
  const formData = new FormData();
  
  // Add the temporary images to the FormData object
  formData.append('display_picture', imageInput.files[0]);
  formData.append('add_picture1', imageInput2.files[0]);
  formData.append('add_picture2', imageInput3.files[0]);
  formData.append('add_picture3', imageInput4.files[0]);

  // Send the AJAX request to save the images
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '/save-images'); // Replace '/save-images' with the actual URL to your server-side image upload endpoint
  xhr.onload = () => {
    if (xhr.status === 200) {
      // Images saved successfully, you can update the image elements with the saved images here
      console.log('Images saved successfully');
    } else {
      console.error('Error saving images');
    }
  };
  xhr.onerror = () => {
    console.error('Error saving images');
  };
  xhr.send(formData);
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


