// Fonction pour rechercher les profils dans le fichier texte
function searchProfiles(searchKeyword) {
    $.ajax({
        type: 'POST',
        url: 'search.php',
        data: {searchKeyword: searchKeyword},
        dataType: 'json',
        success: function(response) {
            displaySearchResults(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
