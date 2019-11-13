
const parsedUrl = new URL(window.location.href);
const getUrlParam = parsedUrl.searchParams;

let query;
query = getUrlParam.get('id');
console.log(query);


const projectTopic = document.querySelector('[data-project-topic]');
const projectContractor = document.querySelector('[data-project-contractor]');
const projectUpdated = document.querySelector('[data-project-updated]');
const projectBudget = document.querySelector('[data-project-budget]');
const projectId = document.querySelector('[data-project-id]');
const projectCreated = document.querySelector('[data-project-created]');
const projectDesc = document.querySelector('[data-project-desc]');
const projectDesc_2 = document.querySelector('[data-project-desc_2]');
const projectLocation = document.querySelector('[data-project-location]');
const projectMap = document.querySelector('[data-project-map]');
const projectSpentBudget = document.querySelector('[data-project-budget-spent]');
const projectCreated_2 = document.querySelector('[data-project-created-2]');
const projectLike = document.querySelector('[data-project-like]');
const projectDislike = document.querySelector('[data-project-dislike]');
const projectComment = document.querySelector('[data-project-comment]');
const projectType = document.querySelector('[data-project-type]');
const projectStatus = document.querySelector('[data-project-status]');

const projectCommentBtn = document.querySelector('[data-project-comment-btn]');



const viewOneProject = () => {
    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.viewOneProject(query)}`;
    console.log(url)

    fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data)
        if(data) {
            console.log(data.project[0])
            let like_count = 0;
            let unlike_count = 0;
            const {id, AMOUNT_APPROVED_2016, AMOUNT_APPROVED_2017, contractor, BUDGET_COST, COMMITMENT, LGA, LOCATION, PROJECT_DESCRIPTION, PROJECT_TYPE, STATUS, project_image, comments_count, created_at, updated_at, projectlikes} = data.project[0];
            projectTopic.innerHTML = PROJECT_DESCRIPTION;
            projectContractor.innerHTML = contractor ? contractor : 'Not Specified';
            projectType.innerHTML = PROJECT_TYPE;
            projectUpdated.innerHTML =  updated_at;
            projectBudget.innerHTML = BUDGET_COST;
            projectId.innerHTML = id;
            projectStatus.innerHTML = STATUS;
            projectCreated.innerHTML = created_at;
            projectDesc.innerHTML = PROJECT_DESCRIPTION;
            projectDesc_2.innerHTML = PROJECT_DESCRIPTION;
            projectLocation.innerHTML = LOCATION;
            projectSpentBudget.innerHTML = AMOUNT_APPROVED_2016;
            projectCreated_2.innerHTML = updated_at;
            projectLike.innerHTML =  like_count;
            projectDislike.innerHTML = unlike_count;
            projectComment.innerHTML = comments_count;


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
        }
        
    
    })
    .catch(err =>{
        console.log(err);
    })

}

const commentProject = () => {

}
setTimeout(() => {
    viewOneProject();
}, 2000);
