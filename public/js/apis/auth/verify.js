
const verifyApi = (event, verifyForm) => {
    event.preventDefault();
    const routes = new Routes();
    const submitBtn = event.target[1];
    const url = `${ routes.apiOrigin }${ routes.verify }`;
    console.log(url);

    if(permit_verify == true) {//Condition that check if validation is true
         submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
         //Convert form to formData
         const formData = new FormData(verifyForm);
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
                submitBtn.innerHTML = 'Verify Account';
                Swal.fire({
                    title: `<h5>${title}</h5>`,
                    html:  `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })       
            }
            switch(status) {
                case 422:
                    title = 'Verification failed';
                    result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                    flashAlert(title,result);
                break;
                case 400:
                    title  = 'Verification error';
                    result = 'Invalid credentials';
                    flashAlert(title,result);
                break;
                case 200:
                    submitBtn.innerHTML = 'Verify Account';
                    Swal.fire({
                        title: `<h5>Account Confirmation Successful</h5>`,
                    })  
                    setTimeout(() => {
                        //insert the data into broswer localStorage
                        localStorage.setItem('nddc-tracker-user', JSON.stringify(data));
                        if(data.user.user_type === 'community_member'){
                            location.replace('account/user/dashboard.html');
                        }else if(data.user.user_type === 'reviewer') {
                            location.replace('account/reviewer/dashboard.html');
                        }else if(data.user.user_type === 'contractor') {
                            location.replace('account/contractor/dashboard.html');
                        }
                    }, 3000)
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
                submitBtn.innerHTML = 'Verify Account';
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

verifyForm.addEventListener('submit', (event) => verifyApi(event, verifyForm))