//This handles the validation of the register form
//Get the register form 
const verifyForm   = document.querySelector('[data-verify-form]');
//Get the error field
let codeError    = document.querySelector('#codeError');

const validateVerifyForm = (verifyForm) => {
    console.log('jjj')
    //Clear the error field 
    codeError.innerHTML = '';
    //Convert form to formData
    const formData = new FormData(verifyForm);
    //Throw error if field is empty
    if(formData.get('verifycode') == '') {

        codeError.innerHTML = 'Please email field is required';
        permit = false;
        return false;
    }
    permit = true;
}
verifyForm.addEventListener('change', () => validateVerifyForm(verifyForm));
//Next the register api found 

