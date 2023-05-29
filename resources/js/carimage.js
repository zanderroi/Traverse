
//UPDATED JS


  // JavaScript code to handle image preview and temporary storage

  const imageInput1 = document.getElementById('display_picture');
  const previewImage1 = document.getElementById('display_picture_img');
  const imageInput2 = document.getElementById('add_picture1');
  const previewImage2 = document.getElementById('add_picture1_img');
  const imageInput3 = document.getElementById('add_picture2');
  const previewImage3 = document.getElementById('add_picture2_img');
  const imageInput4 = document.getElementById('add_picture3');
  const previewImage4 = document.getElementById('add_picture3_img');

  let temporaryImage1 = null;
  let temporaryImage2 = null;
  let temporaryImage3 = null; 
  let temporaryImage4 = null;

  imageInput1.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage1.src = e.target.result;
        temporaryImage1 = file;
      };
      reader.readAsDataURL(file);
    }
  });
  imageInput2.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage2.src = e.target.result;
        temporaryImage2 = file;
      };
      reader.readAsDataURL(file);
    }
  });
  imageInput3.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage3.src = e.target.result;
        temporaryImage3 = file;
      };
      reader.readAsDataURL(file);
    }
  });
  imageInput4.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage4.src = e.target.result;
        temporaryImage4 = file;
      };
      reader.readAsDataURL(file);
    }
  });

