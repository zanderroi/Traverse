window.nextStep = function(currentStep) {
    if (validateStep(currentStep)) {
      showStep(currentStep + 1);
      updateStepIndicator(currentStep + 1);
    }
  }
  
  window.prevStep = function(currentStep) {
    showStep(currentStep - 1);
    updateStepIndicator(currentStep - 1);
  }
  
  window.updateStepIndicator = function(currentStep) {
    const stepIndicatorItems = document.querySelectorAll('.step-indicator-item');
  
    stepIndicatorItems.forEach((item, index) => {
      if (index === currentStep - 1) {
        item.classList.add('active');
      } else {
        item.classList.remove('active');
      }
    });
  }
  
  const form = document.getElementById('wizard-form');
  
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    // Perform form validation for the current step
    const currentStep = getCurrentStep();
    if (validateStep(currentStep)) {
      if (currentStep < getTotalSteps()) {
        nextStep(currentStep);
      } else {
        // Handle form submission
        form.submit();
      }
    }
  });
  
  showStep(1);
  
  function getCurrentStep() {
    const steps = document.querySelectorAll('.step');
    for (let i = 0; i < steps.length; i++) {
      if (!steps[i].classList.contains('hidden')) {
        return i + 1;
      }
    }
    return 1;
  }
  
  function getTotalSteps() {
    const steps = document.querySelectorAll('.step');
    return steps.length;
  }
  
  function validateAge() {
    const birthdayInput = document.getElementById('birthday');
    const selectedDate = new Date(birthdayInput.value);
    const currentDate = new Date();
    const ageDiff = currentDate.getFullYear() - selectedDate.getFullYear();
  
    if (ageDiff < 18) {
      return false;
    }
  
    return true;
  }
  
  function validateStep(step) {
    const stepContainer = document.getElementById(`step-${step}`);
    const inputFields = stepContainer.querySelectorAll('input');
    let isValid = true;
  
    inputFields.forEach((field) => {
      const fieldName = field.name;
      const fieldValue = field.value.trim();
     if ( step == 1){

      if (fieldName === 'first_name') {
        if (fieldValue === '' || fieldValue.length > 20) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
  
      if (fieldName === 'last_name') {
        if (fieldValue === '' || fieldValue.length > 15) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
  
      if (fieldName === 'address') {
        if (fieldValue === '' || fieldValue.length > 50) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
  
      if (fieldName === 'phone_number') {
        if (fieldValue === '' || isNaN(fieldValue) || fieldValue.length !== 12) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
      
    }
    if ( step == 2){
      if (fieldName === 'email') {
        if (!validateEmail(fieldValue)) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
  
      if (fieldName === 'password') {
        if (fieldValue.length < 8) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
  
      if (fieldName === 'password_confirmation') {
        const passwordField = document.getElementById('password');
        const passwordValue = passwordField.value.trim();
  
        if (fieldValue !== passwordValue) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
    }
    if ( step == 3 ){
      if (fieldName === 'contactperson1_number') {
        if (fieldValue === '' || isNaN(fieldValue) || fieldValue.length !== 12) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
      if (fieldName === 'contactperson2_number') {
        if (fieldValue === '' || isNaN(fieldValue) || fieldValue.length !== 12) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
      if (fieldName === 'contactperson1') {
        if (fieldValue === '' || fieldValue.length > 50) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }
      if (fieldName === 'contactperson2') {
        if (fieldValue === '' || fieldValue.length > 50) {
          isValid = false;
          field.classList.add('border-red-500');
        } else {
          field.classList.remove('border-red-500');
        }
      }

      const govtidImageField = document.getElementById('govtid_image');
        const driversLicenseImageField = document.getElementById('driverslicense_image');
        const driversLicense2ImageField = document.getElementById('driverslicense2_image');
        const selfieImageField = document.getElementById('selfie_image');

        const maxFileSize = 2048; // Maximum file size in kilobytes (2MB)

        if (!govtidImageField.files || !govtidImageField.files[0] || govtidImageField.files[0].size > maxFileSize * 1024) {
        isValid = false;
        govtidImageField.classList.add('border-red-500');
        } else {
        govtidImageField.classList.remove('border-red-500');
        }

        if (!driversLicenseImageField.files || !driversLicenseImageField.files[0] || driversLicenseImageField.files[0].size > maxFileSize * 1024) {
        isValid = false;
        driversLicenseImageField.classList.add('border-red-500');
        } else {
        driversLicenseImageField.classList.remove('border-red-500');
        }

        if (!driversLicense2ImageField.files || !driversLicense2ImageField.files[0] || driversLicense2ImageField.files[0].size > maxFileSize * 1024) {
        isValid = false;
        driversLicense2ImageField.classList.add('border-red-500');
        } else {
        driversLicense2ImageField.classList.remove('border-red-500');
        }

        if (!selfieImageField.files || !selfieImageField.files[0] || selfieImageField.files[0].size > maxFileSize * 1024) {
        isValid = false;
        selfieImageField.classList.add('border-red-500');
        } else {
        selfieImageField.classList.remove('border-red-500');
        }
    }
    });
    
  
    if (step === 1 && !validateAge()) {
      isValid = false;
      alert("You must be at least 18 years old.");
    }
  
    return isValid;
  }
  
  function validateEmail(email) {
    // Regular expression pattern for email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
  
  function showStep(step) {
    document.querySelectorAll('.step').forEach((element) => {
      element.classList.add('hidden');
    });
    document.getElementById(`step-${step}`).classList.remove('hidden');
  }
  