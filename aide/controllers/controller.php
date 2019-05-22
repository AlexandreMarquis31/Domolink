 <?php
require "../../aide/models/model.php";

function prise_de_rdv(){
    require "../../aide/views/prise_de_rdv.php";
}
function formulaire_panne(){
    require "../../aide/views/formulaire_panne.php";
}
function questions_frequentes(){
    require "../../aide/views/faq.php";
}

function confirmation_rdv(){
    require "../../aide/views/confirmation_rdv.php";
}

function confirmation_panne(){
    require "../../aide/views/confirmation_panne.php";
}

function messagerie(){
    require "../../aide/views/messagerie.php";
}

function message_recu(){
    require "../../aide/views/message_recu.php";
}

function message_envoye(){
    require "../../aide/views/message_envoye.php";
}

function nouveau_message(){
    require "../../aide/views/messagerie.php";
}

function ajout_formulaire(){
    if ($_POST["serie"] && $_POST["message"]){
        $serie = $_POST["serie"];
        $message = htmlspecialchars($_POST["message"]);

        if (verifSerie($serie)){
            insertPannes($serie, $message);
            require "../../aide/views/confirmation_panne.php";
        }
        else{
            require "../../aide/views/fail_panne.php";
        }
    }

}

function formulaire_message(){
    if ($_POST['destinataire'] && $_POST['message'] && $_POST['objet']){
        $message = htmlspecialchars($_POST['message']);
        $destinataire = htmlspecialchars($_POST['destinataire']);
        $objet = htmlspecialchars($_POST['objet']);
        if (verifMail($destinataire)){
            insertMessage($destinataire, $message, $objet);
            require "../../aide/views/confirmation_message.php";
        }
        else{
            require "../../aide/views/fail_message.php";
        }
    }
}

function demande_rdv(){
    if ($_POST['cause_rdv'] && $_POST['date'] ){
       $date = ($_POST['date']);
       $cause_rdv = ($_POST['cause_rdv']);
       insertRDV($date, $cause_rdv);
       require "../../aide/views/confirmation_rdv.php";
    }
    else{
        require "../../aide/views/rdv_fail.php";
    }
}

function messageEnvoye(){
    messageEnvoye1();
}

function messageRecu(){
    messageRecu1();
}

function chercheQuestion(){
    afficherQuestion();
}


?>