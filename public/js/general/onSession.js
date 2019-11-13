/*
Import Note: This script file should be use to hold data of the current user that is login 
*/
//Getting the user information form the browser localStorage
const onsessionUser = JSON.parse(localStorage.getItem('nddc-tracker-user'));
//Check if this user is real or else redirect to login
let validSession;
let token;
let user;

let action = localStorage.getItem('action');

const checkUser = (token) => {
    //Redirect if not true
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
            }else if (res.status == 401 && action == 1) {
                localStorage.removeItem('nddc-tracker-user');
                location.replace('../login.html');
            }else {
                console.log('hahaha')
                token = token;
                user = user;
                console.log(token)
              
            }
        }
    })

}

if(!onsessionUser){
    token = false;
    console.log(token)
}else {
    let {token, user} = onsessionUser;
    checkUser(token, user);
}

//Get the user info through object destructuring


