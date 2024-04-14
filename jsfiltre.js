// Fonction pour effectuer une recherche et afficher les résultats
function searchProfiles() {
    var searchKeyword = $('#searchInput').val(); // Récupérez le mot-clé de recherche depuis le champ de recherche

// requête ajax à faire pour récup les données du fichier

// Fonction pour afficher les résultats de recherche dans l'interface utilisateur
function displaySearchResults(results) {
    // Effacez les résultats précédents
    $('#searchResults').empty();

    // Parcourez les résultats de la recherche et affichez-les dans l'interface utilisateur
    for (var i = 0; i < results.length; i++) {
        var profile = results[i];
        // Construisez le HTML pour afficher chaque profil dans une liste, par exemple :
        var profileHtml = '<li>' + profile.username + ': ' + profile.description + '</li>';
        $('#searchResults').append(profileHtml);
    }
}

// Écoutez l'événement de clic sur le bouton de recherche
$(document).ready(function() {
    $('#searchButton').click(function() {
        searchProfiles(); // Déclenchez la fonction de recherche lorsque le bouton de recherche est cliqué
    });
});