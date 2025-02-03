document.addEventListener('DOMContentLoaded', () => {
    fetch('isLoggedIn.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                document.getElementById('login-menu').style.display = 'none';
                document.getElementById('logout-menu').style.display = 'block';
                document.getElementById('footer-logout-menu').style.display = 'block';
            } else {
                document.getElementById('login-menu').style.display = 'block';
                document.getElementById('logout-menu').style.display = 'none';
                document.getElementById('footer-logout-menu').style.display = 'none';
            }
        })
        .catch(error => console.error('Erreur lors de la vérification de la connexion:', error));
});
