const routes = new Routes();
const url = `${ routes.apiOrigin}${ routes.forgotPassword}`;
const forgotForm = document.querySelector('#forgot-form')
const requestStatus = document.querySelectorAll('.request-status')[0]

forgotForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(forgotForm);

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
        requestStatus.classList.remove('d-none');
        
        setTimeout(() => {
            location.replace("reset-password.html")
        }, 3000);
        })
     .catch(err => console.error(err))
})