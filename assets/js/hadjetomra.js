document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les éléments HTML
    var hadjTab = document.getElementById('hadj-tab');
    var omraTab = document.getElementById('omra-tab');
    var hadjContent = document.getElementById('hadj-content');
    var omraContent = document.getElementById('omra-content');

    // Ajouter des écouteurs d'événements pour les onglets
    hadjTab.addEventListener('click', function () {
        showContent('hadj');
    });

    omraTab.addEventListener('click', function () {
        showContent('omra');
    });

    // Fonction pour afficher le contenu en fonction de l'onglet sélectionné
    function showContent(tab) {
        // Cacher tous les contenus
        hadjContent.style.display = 'none';
        omraContent.style.display = 'none';

        // Afficher le contenu correspondant au tab cliqué
        document.getElementById(tab + '-content').style.display = 'block';
    }
});
