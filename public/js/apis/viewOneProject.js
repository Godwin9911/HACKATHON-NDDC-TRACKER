
const parsedUrl = new URL(window.location.href);
const getUrlParam = parsedUrl.searchParams;

let query;
query = getUrlParam.get('id');
console.log(query);


const projectTopic = document.querySelector('[data-project-topic]');
const projectContractor = document.querySelector('[data-project-contractor]');
const projectUpdated = document.querySelector('[data-project-updated]');
const projectBudeget = document.querySelector('[data-project-budget]');
const projectId = document.querySelector('[data-project-id]');
const projectCreated = document.querySelector('[data-project-created]');
const projectDesc = document.querySelector('[data-project-desc]');
const porjectLocation = document.querySelector(['data-project-location']);
const projectMap = document.querySelector(['data-project-map']);
const projectSpentBudget = document.querySelector(['data-project-spent-budget']);
const projectCreated_2 = document.querySelector(['data-project-created-2']);
const projectLike = document.querySelector('[data-project-like]');
const projectDislike = document.querySelector('data-project-dislike');
const projectComment = document.querySelector('[data-project-comment]');

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
            // const projectTopic = data.project
            // const projectContractor = document.querySelector('[data-project-contractor]');
            // const projectUpdated = document.querySelector('[data-project-updated]');
            // const projectBudeget = document.querySelector('[data-project-budget]');
            // const projectId = document.querySelector('[data-project-id]');
            // const projectCreated = document.querySelector('[data-project-created]');
            // const projectDesc = document.querySelector('[data-project-desc]');
            // const porjectLocation = document.querySelector(['data-project-location']);
            // const projectMap = document.querySelector(['data-project-map']);
            // const projectSpentBudget = document.querySelector(['data-project-spent-budget']);
            // const projectCreated_2 = document.querySelector(['data-project-created-2']);
            // const projectLike = document.querySelector('[data-project-like]');
            // const projectDislike = document.querySelector('data-project-dislike');
            // const projectComment = document.querySelector('[data-project-comment]');
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
