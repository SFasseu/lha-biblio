jQuery(document).ready(function() {

    //écoute de l'évent click sur toutes les classe student-delete et execute la fonction
    $('.student-delete').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        let link = $(this)

        let code = link.attr('data-code-etudiant');

        document.location.replace('controller.php?action=delete&codeEtudiant=' + parseInt(code))
    })
});