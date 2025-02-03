document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("surveyForm");
    const options = document.querySelectorAll(".option");
    const leadingResult = document.querySelector(".leading-result p strong");
    const leadingPercentage = document.querySelector(".leading-result p");

    let votes = {
        drama: 15,
        comedy: 20,
        sciFi: 10,
        action: 5
    };

    function updateResults() {
        let totalVotes = Object.values(votes).reduce((a, b) => a + b, 0);

        options.forEach(option => {
            const input = option.querySelector("input");
            const percentageSpan = option.querySelector(".percentage");
            const votesSpan = option.querySelector(".votes");

            let genreVotes = votes[input.value];
            let percentage = (genreVotes / totalVotes * 100).toFixed(1);

            percentageSpan.textContent = ${percentage}%;
            votesSpan.textContent = (${genreVotes} votes);
        });

        let leadingGenre = Object.keys(votes).reduce((a, b) => votes[a] > votes[b] ? a : b);
        leadingResult.textContent = document.querySelector(label[for=${leadingGenre}]).textContent;
        leadingPercentage.innerHTML = Le genre dominant est : <strong>${leadingResult.textContent}</strong> avec ${votes[leadingGenre] / totalVotes * 100}%;
    }

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const selectedOption = form.elements["genre"].value;
        if (selectedOption) {
            votes[selectedOption]++;
            updateResults();
        }
    });

    updateResults();
});