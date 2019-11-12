const googleBtn = document.querySelector('[data-google-login]');

const googleauthenticate = (event) => {
    event.preventDefault();
    const routes = new Routes();
    console.log(event)

    location.replace(`${routes.apiOrigin}${routes.googleAuth}`)
}

googleBtn.addEventListener('click', (event) => googleauthenticate(event, googleBtn))