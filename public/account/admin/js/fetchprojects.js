const routes = new Routes();
const url = `${ routes.apiOrigin}${ routes.allProjects }`;
const projectTableBody = document.querySelector("#project-table-body")
console.log(url)

const data = JSON.parse(localStorage.getItem('nddc-tracker-user'));
const {token} = data;
fetch(url, {
    method: "GET",
    mode: "cors",
    headers: {
        "Accept": "application/json",
        "Authorization": token
    }
 })
 .then(response => response.json())
 .then(data => {
    console.log(data.project);
    let projectDataObject = data.project;
    projectTableBody.innerHTML = '';
    projectDataObject.map(projectData => {
        console.log(projectData)
        projectTableBody.innerHTML += `

        <tr>
        <td>${projectData.PROJECT_TYPE}</td>
        <td>${projectData.LOCATION}</td>
        <td>${projectData.LGA}</td>
        <td>${projectData.PROJECT_DESCRIPTION}</td>
        <td>${projectData.BUDGET_COST}</td>
        <th>${projectData.COMMITMENT}</th>
        <th>${projectData.STATUS}</th>
        <th><a href="#" class="btn btn-primary btn-icon-split btn-sm">
          <span class="text">View</span>
        </a></th>
      </tr>
        `
    })
 })
 .catch(err => console.error(err))