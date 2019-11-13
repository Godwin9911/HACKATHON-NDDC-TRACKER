const uploadForm = document.querySelector('#upload-form');
const importFileInput = document.querySelector('#import-file')
const fileName = document.querySelector('#file-name')

const validateExcel = (event, uploadForm) => {
    event.preventDefault();
    console.log(event)
    console.log('hshssh')
    //Convert form to formData
    const formData = new FormData(uploadForm);

    const input = formData.get('import_file');
    console.log(input);
    fileName.innerHTML = input.name;
}

uploadForm.addEventListener('change', (event) => validateExcel(event, uploadForm))













const uploadApi = (event, uploadForm) => {
    event.preventDefault();
    const routes = new Routes();
    const url = `${routes.apiOrigin}${routes.uploadExcel}`;
    console.log(url);

    //Convert form to formData
    const formData = new FormData(uploadForm);
    
    //Catch error status code
    const errorHandling = (response) => {
        status = response.status;
        console.log(status)
        return response.json();
    }

    fetch(url, {
        method: "POST",
        mode: "cors",
        headers: {
            "Accept": "application/json",
            "Authorization": certified[0]
        },
        body: formData
    })
        .then(response => errorHandling(response))
        .then(data => {
            console.log(data);
        })
        .catch(err => console.error(err))

}


uploadForm.addEventListener('submit', (event) => uploadApi(event, uploadForm))
