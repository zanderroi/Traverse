
document.addEventListener('DOMContentLoaded', function() {
const form = document.getElementById('wizard-form');
const stepIndicatorItems = document.querySelectorAll('.step-indicator-item');

function showStep(step) {
document.querySelectorAll('.step').forEach((element) => {
element.classList.add('hidden');
});
document.getElementById(`step-${step}`).classList.remove('hidden');
}

function nextStep(currentStep) {
showStep(currentStep + 1);
updateStepIndicator(currentStep + 1);
}

function prevStep(currentStep) {
showStep(currentStep - 1);
updateStepIndicator(currentStep - 1);
}

function updateStepIndicator(currentStep) {
stepIndicatorItems.forEach((item, index) => {
if (index === currentStep - 1) {
item.classList.add('active');
} else {
item.classList.remove('active');
}
});
}

form.addEventListener('submit', (e) => {
e.preventDefault();
// Perform form submission or other actions
});

showStep(1);
});
