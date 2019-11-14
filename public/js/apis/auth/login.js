const useEmailForm = document.querySelector("#use-email-form");
const continueEmailLink = document.querySelector("#continue-email");


const routes = new Routes();
const key = document.querySelector('[data-key]').innerHTML;
if (key == 1) {
    continueEmailLink.addEventListener('click', () => {
        useEmailForm.classList.remove("d-none");
        continueEmailLink.classList.add("d-none");
    })
}
console.log(key)
console.log(permit)
let url;
const loginApi = (event, loginForm) => {
    event.preventDefault();
    console.log(permit)
    const submitBtn = event.target[2];
    if (key == 1) {
        url = `${routes.apiOrigin}${routes.login_1}`;
    } else if (key == 0) {
        url = `${routes.apiOrigin}${routes.login_0}`;
    }

    console.log(url);

    if (permit == true) {//Condition that check if validation is true
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
        //Convert form to formData
        const formData = new FormData(loginForm);
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
                submitBtn.innerHTML = 'Login';
                Swal.fire({
                    title: `<h5>${title}<h5>`,
                    html: `<p style="color:tomato; font-size:17px;">${result}</p>`,
                    confirmButtonText: 'Close'
                })
            }
            switch (status) {
                case 422:
                    title = 'Login failed';
                    result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                    flashAlert(title, result);
                    break;
                case 400:
                    title = 'Login error';
                    result = 'Invalid credentials';
                    flashAlert(title, result);
                    break;
                default:
                    //insert the data into broswer localStorage
                    localStorage.setItem('nddc-tracker-user', JSON.stringify(data));

                    console.log(data)

                    console.log(data.user.user_type)
                    console.log(key)

                    if (data.user.user_type == 'admin' && key == 0) {
                        location.replace(`${window.location.origin}/account/admin/index.html`);
                    } else {
                        location.replace(`${window.location.origin}/account/user/dashboard.html`);
                    }
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
                if (data) {
                    console.log(data);
                    getResponse(data);
                }
            })
            .catch(err => {
                if (err) {
                    submitBtn.innerHTML = 'Login';
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

loginForm.addEventListener('submit', (event) => loginApi(event, loginForm))