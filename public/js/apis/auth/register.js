
const registerApi = (event, registerForm) => {
    event.preventDefault();
    const routes = new Routes();
    const submitBtn = event.target[2];
    const url = `${ routes.apiOrigin }${ routes.register }`;
    console.log(url);

    if(permit == true) {//Condition that check if validation is true
         submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
         //Convert form to formData
         const formData = new FormData(registerForm);
         //Catch error status code
         const errorHandling = (response) => {
            status = response.status;
            console.log(status)
            return response.json();
         }
         
        const getResponse = (data) => {
            let title;
            let result;
            
            const flashAlert = (title, result) => {
                submitBtn.innerHTML = 'Continue with email';
                Swal.fire({
                    title: `<h5>${title}</h5>`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            switch(status) {
                case 422:
                    title = 'Registration failed';
                    result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                    flashAlert(title,result);
                break;
                case 501:
                    title  = 'Registration error';
                    result = 'An error occured while creating an account, please try again';
                    flashAlert(title,result);
                break;
                case 201:
                    submitBtn.innerHTML = 'Continue with email';
                    permit = false;
                    Swal.fire({
                        title: `Registration Successful`,
                        html:  `<p style="color:lightgreen; font-size:17px;">Please check email a verification code has been sent to you to confirm account</p>`,
                        confirmButtonText: 'Close'
                    })  
                    //Display field as none after register 

                    //Display confirm code field as block
                    break;
                default:

            }
         }
         fetch(url, {
            method: "POST",
            mode: "cors",
            headers: {
                "Accept": "aplication/json"
            },
            body: formData
         })
         .then(response => errorHandling(response))
         .then(data => {
             if(data) {
                 console.log(data);
                 getResponse(data);
             }
         })
         .catch(err => {
             if(err) {
                submitBtn.innerHTML = 'Continue with email';
                Swal.fire({
                    title: 'Unexpected Error',
                    html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection or contact website owner, Thank you!</p>`,
                    confirmButtonText: 'Close'            
                })
             }
             console.error(err);
         })
    }

}

registerForm.addEventListener('submit', (event) => registerApi(event, registerForm))