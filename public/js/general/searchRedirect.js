const searchBtn = document.querySelector('#project_search');

redirectSearch = (event, searchBtn) => {
    console.log('open')
    const query = document.querySelector('#search_value').value;
    localStorage.setItem('action', 0);
    location.replace(`${window.location.origin}/project/search-results.html?query=${query}`);
}

searchBtn.addEventListener('click', (event) => redirectSearch(event, searchBtn));