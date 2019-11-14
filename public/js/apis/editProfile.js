const editProfileForm = document.querySelector('#edit-profile-form')
const changePasswordForm = document.querySelector('#change-password-form')
const fileName = document.querySelector('#file-name')
const responseText = document.querySelector('#response-text');

const validateExcel = (event, editProfileForm) => {
    event.preventDefault();
    console.log(event)
    //Convert form to formData
    const formData = new FormData(editProfileForm);

    const input = formData.get('image');
    console.log(input);
    fileName.innerHTML = input.name;
}

editProfileForm.addEventListener('change', (event) => validateExcel(event, editProfileForm))



const editProfileApi = (event, editProfileForm) => {
    event.preventDefault();
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
    const routes = new Routes();
    const editProfileUrl = `${routes.apiOrigin}${routes.editProfile}`;
    const formData = new FormData(editProfileForm);
    console.log(certified[0])
    fetch(editProfileUrl, {
        method: "POST",
        mode: "cors",
        headers: {
            "Accept": "application/json",
            "Authorization": certified[0]
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // requestStatus.classList.remove('d-none')
            $('#alertModal').modal('show');
            responseText.innerHTML = data.message;

        })
        .catch(err => console.error(err))
}


editProfileForm.addEventListener('submit', (event) => editProfileApi(event, editProfileForm, certified[0]))


// Change Password
const oldPwdInput = document.querySelector("#old-pwd-input");
const pwdInput = document.querySelector("#pwd-input");
const confirmPwdInput = document.querySelector("#confirm-pwd-input");
const changePasswordApi = (event, changePasswordForm) => {
    event.preventDefault();
    const routes = new Routes();
    const changePasswordUrl = `${routes.apiOrigin}${routes.changePassword}`;
    const formData = new FormData(changePasswordForm);
    console.log(certified[0])
    data = {
        old_password: oldPwdInput.value,
        password: pwdInput.value,
        password_confirmation: confirmPwdInput.value
    };
    const errorHandling = (response) => {
        status = response.status;
        console.log(status)
        return response.json();
    }
    fetch(changePasswordUrl, {
        method: "PUT",
        mode: "cors",
        headers: {
            "Accept": "application/json",
            "Authorization": certified[0],
            "Content-type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => errorHandling(response))
        .then(data => {
            console.log(data);
            $('#alertModal').modal('show');
            if (status == 422) {
                console.log(data)
                result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
                console.log(result)
                responseText.innerHTML = result;
            } else if (status == 200) {
                responseText.innerHTML = data.success;
            } else {
                responseText.innerHTML = "An Error Occured!";
            }
            // requestStatus.classList.remove('d-none')
        })
        .catch(err => {
            console.error(err.errors)
            $('#alertModal').modal('show');
            // responseText.innerHTML = data.errors.message;
            result = JSON.stringify(data.errors).split('"').join('').split('{').join('').split('}').join('');
            console.log(result)
        })
}


changePasswordForm.addEventListener('submit', (event) => changePasswordApi(event, changePasswordForm, certified[0]))

// Delete Account
const deleteAccountBtn = document.querySelector('#delete-account-btn');
const deleteAccountApi = (event) => {
    event.preventDefault();
    console.log("whatev")
    const routes = new Routes();
    const deleteAccountUrl = `${routes.apiOrigin}${routes.deleteAccount}`;
    console.log(certified[0])
    fetch(deleteAccountUrl, {
        method: "DELETE",
        mode: "cors",
        headers: {
            "Accept": "application/json",
            "Authorization": certified[0],
            "Content-type": "application/json"
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // requestStatus.classList.remove('d-none')
            location.replace(`${window.location.origin}`)
        })
        .catch(err => console.error(err))
}


deleteAccountBtn.addEventListener('click', (event) => deleteAccountApi(event, certified[0]))
