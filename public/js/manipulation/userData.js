const userInfo = JSON.parse(localStorage.getItem("nddc-tracker-user"));
console.log(userInfo);
const {user, image_link} = userInfo;
console.log(user)
let {name,city, user_mode, image} = user;
console.log(name, city)
if (name == null) {
    name = 'Hello Member'
}
if (city == null) {
    city = 'Location: Not set yet'
}

const dataConName = document.querySelector('#data-con-name')
const dataConCity = document.querySelector('#data-con-city')
const dataUserImage = document.querySelector('#user-image')
const navUserImage = document.querySelector('#nav-user-image')
const navName = document.querySelector('#nav-name')

dataConName.innerHTML = name;
dataConCity.innerHTML = city;

navName.innerHTML = name;

console.log(user_mode)
if (user_mode == 'nddc-tracker') {
    dataUserImage.src = `${image_link}${image}`
    navUserImage.src = `${image_link}${image}`
}