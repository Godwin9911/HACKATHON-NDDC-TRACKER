const routes = new Routes();
const editProfileUrl = `${routes.apiOrigin}${routes.editProfile}`;
const editProfileForm = document.querySelector('#edit-profile-form')
const fileName = document.querySelector('#file-name')

const validateExcel = (event, editProfileForm) => {
    event.preventDefault();
    console.log(event)
    console.log('hshssh')
    //Convert form to formData
    const formData = new FormData(editProfileForm);

    const input = formData.get('image');
    console.log(input);
    fileName.innerHTML = input.name;
}

editProfileForm.addEventListener('change', (event) => validateExcel(event, editProfileForm))






editProfileForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(editProfileForm);

    fetch(url, {
        method: "POST",
        mode: "cors",
        headers: {
            "Accept": "aplication/json"
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            requestStatus.classList.remove('d-none')
            setTimeout(() => {
                location.replace("login.html")
            }, 3000);
        })
        .catch(err => console.error(err))
})