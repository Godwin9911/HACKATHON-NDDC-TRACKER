/*
Import Note: The base_url.js hold every every third party base url origin and api's path for the application to work
    for example: the api origin or any api origin
    this url can been use in the application as a variable
*/
//const api_origin = 'http://127.0.0.1:8000/';
// const api_origin = 'https://hackathon-nddc.herokuapp.com/';

class Routes {

  get apiOrigin() {
    return "https://hackathon-nddc.herokuapp.com/";
  }

  get checkSession() {
    return "api/v1/check/session"
  }
  //Authentication Paths
  get register() {
    return "api/v1/register";
  }
  get login() {
    return "api/v1/login";
  }
  get verify() {
    return "api/v1/verify";
  }
  get forgotPassword() {
    return "api/v1/forgot/password";
  }
  get resetPassword() {
    return "api/v1/reset/password";
  }
  //Google Auth
  get googleAuth() {
    return "redirect/google";
  }
  get currentUser() {
    return "api/v1/user";
  }

  //Subcribers
  get subscribeSend() {
    return "api/v1/subscriber/create";
  }
  get subscribers() {
    return "api/v1/subscribers";
  }
  subscriberOne(id) {
    return `api/v1/subscribers/one/${id}`;
  }
  subscriberDelete(id) {
    return `api/v1/subscribers/delete/${id}`;
  }
 
  //Projects
  searchProject(query) {
    return `api/v1/project/search/${query}`;
  }
}