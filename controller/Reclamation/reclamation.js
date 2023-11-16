    // Attendez que le DOM soit chargé
    document.addEventListener("DOMContentLoaded", function () {
        // Fonction de validation du formulaire
        function validateForm() {
            // Récupérer la valeur du champ de texte de la réclamation
            var reclamationText = document.getElementsByName("reclamation_text")[0].value.trim();
    
            // Vérifier si le champ est vide
            if (reclamationText === "") {
                // Afficher une alerte
                alert("Veuillez saisir le texte de la réclamation.");
    
                // Empêcher le formulaire de se soumettre
                return false;
            }
    
            // Le formulaire sera soumis si tout est correct
            return true;
        }
    
        // Ajouter un gestionnaire d'événement pour le formulaire
        var form = document.querySelector("form");
        form.addEventListener("submit", validateForm);
    });