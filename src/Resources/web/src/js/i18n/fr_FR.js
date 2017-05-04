define([], function() {
    return {
        card: {
            status: {
                valid: 'Version validée',
                draft: 'Version brouillon'
            },
            btn: {
                toggle_valid: 'Voir la version validée',
                toggle_valid_disable: 'Il n\'y a pas de version validée',
                toggle_draft: 'Voir le brouillon',
                validate: 'Valider le brouillon',
                validation_disable: 'Le brouillon ne peux être validé'
            },
            validation: {
                invalid: 'Invalide',
                confirm_title: 'Confirmation',
                confirm_cancel: 'Non',
                confirm_ok: 'Oui, je valide',
                confirm: 'Etes vous sûre de vouloir valider ce brouillon ?',
                error_title: 'Problème lors de la validation',
                error: 'Impossible de valider ce brouillon !',
                success_title: 'Validation',
                success: 'La version de brouillon a bien été validée.'
            }
        },
        paginate: {
            error_title: 'Erreur',
            error: 'Impossible de charger la page suivante !',
        }
    };
});
