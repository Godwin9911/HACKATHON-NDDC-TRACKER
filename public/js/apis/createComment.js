
const commentBox = document.querySelector('[data-comment-box]');
const anonymous = document.querySelector('[data-anonymous-spot]');
const commentBtn = document.querySelector('[data-comment-btn]');
const commenterror = document.querySelector('[data-comment-error]');

let user_com_id;
let anonymous_form;
const comment = (event, commentBtn, query) => {
    event.preventDefault();

    if (commentBox.value == '') {
        return commenterror.innerHTML = 'Please comment field cannot be empty!';
    }
        commentBtn.innerHTML = '<span class="spinner-border spinner-border-sm" style="width: 1.3em; height: 1.3em;" role="status" aria-hidden="true"></span>'
        console.log('hellow');
        const userLocalStore = JSON.parse(localStorage.getItem('nddc-tracker-user'));

        if (userLocalStore) {
            const { user } = userLocalStore;
            user_com_id = user.id
        } else {
            user_com_id = null;
        }

        if (anonymous.checked == true) {
            anonymous_form = 'yes';
        } else {
            anonymous_form = 'no';
        }
        const routes = new Routes();
        const url = `${routes.apiOrigin}${routes.createComment(query, user_com_id, anonymous_form)}`;
        console.log(url)

        data = {
            comment: commentBox.value,
        };

        fetch(url, {
            method: "POST",
            mode: "cors",
            headers: {
                "Accept": "application/json",
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                commentBtn.innerHTML = 'Comment';
                console.log(data);
                commenterror.innerHTML = '<h5 style="color: green;">Comment created Successfully!</h5>';

            })
            .catch(err => {
                commentBtn.innerHTML = 'Comment';
                console.error(err)

            })

    }


commentBtn.addEventListener('click', (event) => comment(event, commentBtn, query));


const fetchAllComment = (query) => {
    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.fetchProjectComments(query)}`;
    console.log(url)

    fetch(url, {
        method: "GET",
        mode: "cors",
        headers: {
            "Accept": "aplication/json"
        }
     })
     .then(response => response.json())
     .then(data => {
         console.log(data.project);
         viewComment(data.project);
     })
     .catch(err => {
         console.error(err)
     })
}

fetchAllComment(query);


viewComment = (data) => {
    console.log(data);
}
