<?php

require "../../aide/controllers/controller.php";
if (isset($_GET["action"])) {
    $action = htmlspecialchars($_GET["action"]);

    switch ($action){
        case "prise_de_rdv":
            prise_de_rdv();
            break;

        case "signaler_une_panne":
            formulaire_panne();
            break;


        case "conf_rdv":
            confirmation_rdv();
            break;

        case "conf_fp":
            confirmation_panne();
            break;

        case "demande_rdv":
            demande_rdv();
            break;

        case "messagerie":
            messagerie();
            break;

        case "nouveau_message":
            messagerie();
            break;

        case "message_envoye":
            message_envoye();
            break;

        case "message_recu":
            message_recu();
            break;

        case "ajouter_formulaire":
            ajout_formulaire();
            break;

        case "formulaire_message":
            formulaire_message();
            break;

        default :
            echo"error 404";
            break;
    }
}
else {
    questions_frequentes();
}
?>