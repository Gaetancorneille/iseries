document.addEventListener('DOMContentLoaded', () => {
    const voteButtons = document.querySelectorAll('input[name="answer"]');
    
    voteButtons.forEach(button => {
        button.addEventListener('change', () => {
            const selectedAnswer = button.value;

            fetch('sondages.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `answer=${selectedAnswer}`
            })
            .then(response => response.text())
            .then(data => {
                // Mettre à jour les résultats ici si nécessaire
                console.log('Vote enregistré');
                // Réactualiser la page pour afficher les nouveaux résultats
                location.reload();
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});
