const editProfileForm = document.querySelector('#edit-profile-form')
const fileName = document.querySelector('#file-name')

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
        })
        .catch(err => console.error(err))
}


editProfileForm.addEventListener('submit', (event) => editProfileApi(event, editProfileForm, certified[0]))