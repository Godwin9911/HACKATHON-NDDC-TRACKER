const routes = new Routes();
const url = `${ routes.apiOrigin}${ routes.getAdminStats }`;
console.log(url)

fetch(url, {
    method: "GET",
    mode: "cors",
    headers: {
        "Accept": "aplication/json",
        "Authorization": token
    }
 })
 .then(response => response.json())
 .then(data => console.log(data))
 .catch(err => console.error(err))