const routes = new Routes();
const url = `${ routes.apiOrigin}${ routes.resetPassword}`;
const resetForm = document.querySelector('#reset-form')
const requestStatus = document.querySelectorAll('.request-status')[0]

resetForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(resetForm);

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