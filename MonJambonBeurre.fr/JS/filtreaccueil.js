
document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="sexe"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            filterList(radio.value);
        });
    });
    // -- Montre / cache les profils selectionnés -- 
    function filterList(sexe) {
        const listItems = document.querySelectorAll('ul li');
        listItems.forEach(item => {
            if (sexe === 'all') {
                item.classList.remove('hidden');
            } else {
                if (!item.classList.contains(sexe)) {
                    item.classList.add('hidden');
                } else {
                    item.classList.remove('hidden');
                }
            }
        });
    }

    
    filterList(document.querySelector('input[name="sexe"]:checked').value);
});
