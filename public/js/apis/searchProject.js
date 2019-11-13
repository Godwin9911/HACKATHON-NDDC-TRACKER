const parsedUrl = new URL(window.location.href);
const getUrlParam = parsedUrl.searchParams

let query;
query = getUrlParam.get('query');
console.log(query);

if(query) {
    document.querySelector('[data-search-placeholder-box]').style.display = 'block'
}else {
    query = 'Rivers';
}

const searchPlaceHolder = document.querySelector('[data-search-placeholder]');
searchPlaceHolder.textContent = query;

let delete_save;
let projectResults = [];
//Get the Dom
const projectDOM = document.querySelector('[data-project-dom]');

const fetchProjects = (query="Rivers,Bayelsa,Cross,Delta") => {
    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.searchProject(query)}`;
    console.log(url)
    projectDOM.innerHTML = `<div class="col-1 spinner-con text-center" style="top: 20%;">
                                <div class="spinner-border mt-3" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>`;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        data.search.map(x => projectResults.push(...x));
        console.log(projectResults);
        displayProjectResult();
    })
    .catch(err =>{
        console.log(err);
    })
}

const displayProjectResult = () => {

    if(projectResults.length != 0) {
        projectDOM.innerHTML = ``;
        
            projectResults.map(projectResult => {
            let like_count = 0;
            let unlike_count = 0;
            const {id, AMOUNT_APPROVED_2016, AMOUNT_APPROVED_2017, contractor, BUDGET_COST, COMMITMENT, LGA, LOCATION, PROJECT_DESCRIPTION, PROJECT_TYPE, STATUS, project_image, comments_count, created_at, projectlikes} = projectResult;
            if(certified[0]){
               delete_save = `<span class="col-12 col-md-3 px-0 mt-2 grey mt-2" id="deleteSaveProject${id}">Delete from saved</span>`;
            }else {
                delete_save = '';
            }

            projectDOM.innerHTML += `
                    <div class="col-12 projects-listed scroller">
                    <div class="col-12 mb-3 project row mx-0 p-4">
                        <div class="col-12 col-md-5 px-0 project-image">
                            <img src="../../images/welcome-bg.png" alt="">
                        </div>
                        <div class="col-12 col-md-7 project-details">
                            <div class="col-12 title-removefrom row mx-0 scroller" style="cursor:pointer;">
                                <h5 class="grey bold px-0 col-12 col-md-9 mt-2 hover-fly" onclick="location.href='project.html?id=${id}'">${PROJECT_DESCRIPTION}</h5>
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
                                    <p class="grey mb-1">Project ID: <span class="stat-value">Nddc/${id}</span></p>
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
                                    <span class="grey"><i class="fa fas fa-2x fa-thumbs-up mr-2"></i><span id="view_like_count${id}">${like_count}<span></span>
                                </div>
                                <div class="col px-0 text-center">
                                    <span class="grey"><i class="fa fas fa-2x fa-thumbs-down mr-2"></i><span id="view_unlike_count${id}">${unlike_count}<span></span>
                                </div>
                                <div class="col px-0 text-center">
                                    <span class="grey"><i class="fa fas fa-2x fa-comments mr-2"></i><span>${comments_count}<span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            if(projectlikes) {
                projectlikes.map((current) => {
                    if(current.status == 'unlike'){
                        unlike_count+=1
                    }
                    if(current.status == 'like'){
                        like_count+=1
                    }
                });
            }
            document.querySelector(`#view_like_count${id}`).textContent = like_count;
            document.querySelector(`#view_unlike_count${id}`).textContent = unlike_count;

        })
    }else {
        projectDOM.innerHTML = `<h3 style="text-align:center;">No Search result was found!<h3>`
    }
}
fetchProjects(query);


    const customFiterBoxs = Array.from(document.querySelectorAll('.client-search'));

    const customFiter = (event, x) => {
        if(x.checked == true) {
            query += `,${x.value}`;
            console.log(query)
        }else {
            query = query.replace(`,${x.value}`,'');
            console.log(query)
        }
        projectResults = [];
        fetchProjects(query);
    }

    customFiterBoxs.map(x => {
        x.addEventListener('change', (event) => customFiter(event, x));
    })
