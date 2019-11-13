/*
Import Note: This script file should be use to hold data of the current user that is login 
*/
//Getting the user information form the browser localStorage
const onsessionUser = JSON.parse(localStorage.getItem('nddc-tracker-user'));
//Check if this user is real or else redirect to login

console.log(onsessionUser)
let {token, user} = onsessionUser;
console.log(token)

let validSession;

let action = localStorage.getItem('action');

const checkUser = () => {
    //Redirect if not true
    !onsessionUser ?  location.replace('../login.html') : null;

    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.checkSession}`;
    console.log(url)

    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Authorization": `${token}`
        }
    })
    .then(res => {
        if(res) {
            if(res.status == 401 && action == 0){
                token = false;
            }else if (res.status == 200 && action == 1) {
                localStorage.rmoveItem('nddc-tracker-user');
                location.replace('../login.html');
            }else {
                console.log('hahaha')
            }
        }
    })

}
checkUser();
//Get the user info through object destructuring


