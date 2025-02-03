document.addEventListener('DOMContentLoaded', () => {
    const seasonButtons = document.querySelectorAll('.season-button');
    const seasonContent = document.getElementById('season-content');
    const videoPlayer = document.getElementById('video-player');
    const videoSource = document.getElementById('video-source');

    const seasons = {
        1: [
            { episode: "Episode 01", src: "video1.mp4" },
            { episode: "Episode 02", src: "video2.mp4" }
            // Ajouter d'autres épisodes de la saison 1
        ],
        2: [
            { episode: "Episode 01", src: "video3.mp4" },
            { episode: "Episode 02", src: "video4.mp4" }
            // Ajouter d'autres épisodes de la saison 2
        ]
        // Ajouter d'autres saisons si nécessaire
    };

    function displaySeason(seasonNumber) {
        seasonContent.innerHTML = '';
        const episodes = seasons[seasonNumber];
        episodes.forEach(episode => {
            const card = document.createElement('div');
            card.className = 'series-card';
            card.innerHTML = `
                <img src="placeholder.jpg" alt="Episode Thumbnail">
                <h2>${episode.episode}</h2>
                <a href="#" class="watch-button" data-src="${episode.src}">Regarder</a>
            `;
            seasonContent.appendChild(card);
        });

        // Attach event listeners to watch buttons
        const watchButtons = seasonContent.querySelectorAll('.watch-button');
        watchButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const src = button.getAttribute('data-src');
                videoSource.src = src;
                videoPlayer.load();
                videoPlayer.play();
            });
        });
    }

    // Display the first season by default
    displaySeason(1);

    // Handle season button clicks
    seasonButtons.forEach(button => {
        button.addEventListener('click', () => {
            const seasonNumber = button.getAttribute('data-season');
            displaySeason(seasonNumber);
        });
    });
});
