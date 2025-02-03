document.getElementById('next-arrow').addEventListener('click', () => {
    document.querySelector('.articles-container').scrollBy({
        left: 220, // Adjust according to the article width and margin
        behavior: 'smooth'
    });
});

document.getElementById('prev-arrow').addEventListener('click', () => {
    document.querySelector('.articles-container').scrollBy({
        left: -220, // Adjust according to the article width and margin
        behavior: 'smooth'
    });
});
// script.js
const searchBar = document.getElementById('search-bar');
const searchButton = document.getElementById('search-button');
const resultsContainer = document.getElementById('results-container');
const resultsList = document.getElementById('results');

const data = [
    { type: 'Série', name: 'Breaking Bad' },
    { type: 'Série', name: 'Game of Thrones' },
    { type: 'Série', name: 'Friends' },
    { type: 'Article', name: 'Les meilleures séries de 2024' },
    { type: 'Article', name: 'Interview avec Bryan Cranston' },
    { type: 'Episode', name: 'Breaking Bad S01E01' },
    { type: 'Episode', name: 'Game of Thrones S01E01' },
    { type: 'Sondage', name: 'Quelle est votre série préférée ?' },
    { type: 'Acteur', name: 'Bryan Cranston' },
    { type: 'Acteur', name: 'Emilia Clarke' }
];

searchButton.addEventListener('click', () => {
    const query = searchBar.value.toLowerCase();
    const filteredData = data.filter(item => item.name.toLowerCase().includes(query));

    resultsList.innerHTML = '';
    if (filteredData.length) {
        filteredData.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.type}: ${item.name}`;
            resultsList.appendChild(li);
        });
        resultsContainer.style.display = 'block';
    } else {
        const li = document.createElement('li');
        li.textContent = 'Aucun résultat trouvé';
        resultsList.appendChild(li);
        resultsContainer.style.display = 'block';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    fetch('isLoggedIn.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                document.getElementById('login-menu').style.display = 'none';
                document.getElementById('logout-menu').style.display = 'block';
            } else {
                document.getElementById('login-menu').style.display = 'block';
                document.getElementById('logout-menu').style.display = 'none';
            }
        })
        .catch(error => console.error('Erreur lors de la vérification de la connexion:', error));
});
