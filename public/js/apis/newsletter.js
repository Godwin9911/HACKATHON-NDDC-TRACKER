
const routes = new Routes();
const url = `${routes.apiOrigin}${routes.subscribeSend}`;

//Get input field values
const subscribe = (e, allow) => {
    e.preventDefault();
    let email;
    if(allow == 1){
        email = document.querySelector('#email-sub-1').value;
    }else {
        email = document.querySelector('#email-sub-2').value;
    }
    const data = {
            email
        };
        console.log(data);

    //fetch(request)
    fetch(url, {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json'     
        },
        body: JSON.stringify(data)
    })
        .then(resp => resp.json()) 
        .then(resp => {
            Swal.fire({
                title: 'Subscribed Successfully',
                html:  `<p style="color:green; font-size:17px;">${resp.message} Check your email.</p>`,
                confirmButtonText: 'Close'
            })       
            console.log(resp);
        })
        .catch(err => {
            Swal.fire({
                title: 'An Error Occured',
                html: `<p style="color:tomato; font-size:17px;">This may be due to internet connection not available, please turn on internet connection, Thank you!</p>`,
                confirmButtonText: 'Close'
            })
            console.log(err);
        })

};

document.querySelector('#subscribe-btn-1').addEventListener('click',(event) => subscribe(event, 1));
document.querySelector('#subscribe-btn-2').addEventListener('click', (event) => subscribe(event, 2));


console.log(url);


