// script.js
const searchBar = document.getElementById('search-bar');
const searchButton = document.getElementById('search-button');
const suggestionsList = document.getElementById('suggestions');

const data = [
    "Breaking Bad",
    "Game of Thrones",
    "Friends",
    "Stranger Things",
    "The Office",
    "How I Met Your Mother",
    "La Casa de Papel",
    "Grey's Anatomy",
    "Westworld",
    "The Crown",
    "Sherlock",
    "The Big Bang Theory"
];

searchBar.addEventListener('input', showSuggestions);
searchButton.addEventListener('click', activateSearch);

function showSuggestions() {
    const query = searchBar.value.toLowerCase();
    suggestionsList.innerHTML = '';

    if (query) {
        const filteredData = data.filter(item => item.toLowerCase().includes(query));
        filteredData.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            li.addEventListener('click', () => {
                searchBar.value = item;
                suggestionsList.innerHTML = '';
                suggestionsList.style.display = 'none';
            });
            suggestionsList.appendChild(li);
        });
        suggestionsList.style.display = 'block';
    } else {
        suggestionsList.style.display = 'none';
    }
}

function activateSearch() {
    const query = searchBar.value.toLowerCase();
    const filteredData = data.filter(item => item.toLowerCase().includes(query));
    alert('Résultats de la recherche : ' + (filteredData.length ? filteredData.join(', ') : 'Aucun résultat trouvé'));
    suggestionsList.innerHTML = '';
    suggestionsList.style.display = 'none';
}
