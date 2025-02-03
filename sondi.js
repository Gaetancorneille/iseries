document.addEventListener('DOMContentLoaded', () => {
    const voteButtons = document.querySelectorAll('input[name="option_id"]');
    
    voteButtons.forEach(button => {
        button.addEventListener('change', () => {
            const selectedOptionId = button.value;
            const sondageId = new URLSearchParams(window.location.search).get('id');

            fetch(`sondage.php?id=${sondageId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `option_id=${selectedOptionId}`
            })
            .then(response => response.text())
            .then(data => {
                // Réactualiser la page pour afficher les nouveaux résultats
                location.reload();
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});
