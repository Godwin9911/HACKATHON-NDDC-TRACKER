const parsedUrl = new URL(window.location.href);
const getUrlParam = parsedUrl.searchParams

const query = getUrlParam.get('query');
console.log(query);

const projectResults = [];
//Get the Dom
const projectDOM = document.querySelector('[data-project-dom]');

const fetchProjects = () => {
    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.searchProject(query)}`;
    console.log(url)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        projectResults.push(data.search);
        console.log(projectResults);
        displayProjectResult();
    })
    .catch(err =>{
        console.log(err);
    })
}

const displayProjectResult = () => {

    if(projectResults) {
        projectDOM.innerHTML = '';
        projectResults[0].map(projectResult => {
            console.log(projectResult)
            const {id, AMOUNT_APPROVED_2016, AMOUNT_APPROVED_2017, contractor, BUDGET_COST, COMMITMENT, LGA, LOCATION, PROJECT_DESCRIPTION, PROJECT_TYPE, STATUS, project_image, comments_count, created_at, projectlikes} = projectResult;
            if(token){
                 delete_save = `<span class="col-12 col-md-3 px-0 mt-2 grey mt-2" id="deleteSaveProject${id}">Delete from saved</span>`;
            }
            console.log(id)
  
            projectDOM.innerHTML += `
                    <div class="col-12 projects-listed scroller">
                    <div class="col-12 mb-3 project row mx-0 p-4">
                        <div class="col-12 col-md-5 px-0 project-image">
                            <img src="../../images/welcome-bg.png" alt="">
                        </div>
                        <div class="col-12 col-md-7 project-details">
                            <div class="col-12 title-removefrom row mx-0">
                                <h3 class="grey bold px-0 col-12 col-md-9 mt-2" onclick="location.href='project.html'">${PROJECT_DESCRIPTION}</h3>
                                ${delete_save}
                            </div>
                            <div class="col-12 contractor-name">
                                <h6 class="grey">${contractor ? contractor : 'Not Specified'}</h6>
                            </div>
                            <div class="col-12 activity-status">
                                <span class="grey">Activity Status</span>
                                <span class="status-designed p-1 br-10px">${STATUS}</span>
                            </div>
                            <div class="col-12 full-desc mt-2">
                                <p class="grey scroller">${PROJECT_DESCRIPTION}!</p>
                            </div>
                            <div class="col-12 project-stats row mx-0">
                                <div class="col-12 col-md-6 px-0">
                                    <p class="grey mb-1">Project ID: <span class="stat-value">Nddc${Math.random()}${id}</span></p>
                                </div>
                                <div class="col-12 col-md-6 px-0">
                                    <p class="grey mb-1">Total Budget: <span class="stat-value">N${BUDGET_COST}</span></p>
                                </div>
                                <div class="col-12 col-md-6 px-0">
                                    <p class="grey mb-1">Start Date: <span class="stat-value">${created_at}</span></p>
                                </div>
                                <div class="col-12 col-md-6 px-0">
                                    <p class="grey mb-1">Location/LGA: <span class="stat-value">${LOCATION}/${LGA}</span></p>
                                </div>
                            </div>
                            <div class="col-12 thumbs-comments row mx-0 mt-3">
                                <div class="col px-0 text-center">
                                    <span class="grey"><i class="fa fas fa-2x fa-thumbs-up mr-2"></i>200</span>
                                </div>
                                <div class="col px-0 text-center">
                                    <span class="grey"><i class="fa fas fa-2x fa-thumbs-down mr-2"></i>52</span>
                                </div>
                                <div class="col px-0 text-center">
                                    <span class="grey"><i class="fa fas fa-2x fa-comments mr-2"></i>200</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

        })
    }
}
fetchProjects();