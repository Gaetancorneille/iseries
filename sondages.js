document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('#survey .option');
    const totalVotesElement = document.getElementById('total-votes');
    const leadingOptionElement = document.getElementById('leading-option');

    // Initialize the vote counts for each option
    const votes = Array(options.length).fill(0);
    let totalVotes = 0;

    function updateVotes() {
        let maxVotes = 0;
        let leadingOption = 'Aucune';

        // Update the vote counts and percentages for each option
        options.forEach((option, index) => {
            const voteCountElement = option.querySelector('.vote-count');
            const votePercentElement = option.querySelector('.vote-percent');

            voteCountElement.textContent = votes[index];
            const percent = totalVotes > 0 ? (votes[index] / totalVotes * 100).toFixed(2) : 0;
            votePercentElement.textContent = $[percent]%;

            if (votes[index] > maxVotes) {
                maxVotes = votes[index];
                leadingOption = option.querySelector('.option-text').textContent;
            }
        });

        totalVotesElement.textContent = totalVotes;
        leadingOptionElement.textContent = leadingOption;
    }

    options.forEach((option, index) => {
        option.addEventListener('click', () => {
            // Reset all votes to zero except the clicked option
            for (let i = 0; i < votes.length; i++) {
                if (i === index) {
                    votes[i]++;
                } else {
                    votes[i] = 0;
                }
            }

            totalVotes = votes.reduce((a, b) => a + b, 0);
            updateVotes();
        });
    });

    updateVotes();
});