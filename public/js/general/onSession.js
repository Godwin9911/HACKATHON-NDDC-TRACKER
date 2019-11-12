/*
Import Note: This script file should be use to hold data of the current user that is login 
*/
//Getting the user information form the browser localStorage
const onsessionUser = JSON.parse(localStorage.getItem('nddc-tracker-user'));
//Check if this user is real or else redirect to login
const checkUser = () => {
    //Redirect if not true
    !onsessionUser ?  location.replace('../siginin.html') : null;
}
checkUser();
//Get the user info through object destructuring
console.log(onsessionUser)
const {token, user} = onsessionUser;


