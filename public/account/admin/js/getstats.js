const routes = new Routes();
const url = `${ routes.apiOrigin}${ routes.getAdminStats }`;
const totalBudgetValue = document.querySelector('#total-budget-value')
const totalContractorsValue = document.querySelector('#total-contractors-value')
const totalCommentValue = document.querySelector('#total-comment-value')
const totalCommunityValue = document.querySelector('#total-community-value')
const totalProjectValue = document.querySelector('#total-project-value')
const totalReviewersValue = document.querySelector('#total-reviewers-value')
const totalSubscribersValue = document.querySelector('#total-subscribers-value')
const totalUserValue = document.querySelector('#total-user-value')


const getStat = () => {
    console.log(certified)
    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "aplication/json",
            "Authorization": certified[0]
        }
     })
     .then(response => response.json())
     .then(data => {
         console.log(data)
        const  {totalBudget, totalComment, totalCommunity, totalContractors,
             totalProject, totalReviewers, totalSubcribers, totalUser} =  data;
        totalBudgetValue.innerHTML = "&#8358;"+totalBudget;
        totalCommentValue.innerHTML = totalComment;
        totalCommunityValue.innerHTML = totalCommunity;
        totalContractorsValue.innerHTML = totalContractors;
        totalProjectValue.innerHTML = totalProject;
        totalReviewersValue.innerHTML = totalReviewers;
        totalSubscribersValue.innerHTML = totalSubcribers;
        totalUserValue.innerHTML = totalUser;
     })
     .catch(err => console.error(err))
}

setTimeout(() => {
    getStat();
}, 3000)
