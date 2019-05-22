<?php
include_once("../../phpRessources/fonctions.php");
session_start();
function insertPannes($serie, $message)
{ //Insert dans la base de donnée les nouvelles données dans la base de données
    $utilisateurId = $_SESSION['id'];
    $equipementId = DataBase::execute("SELECT id from Equipements WHERE serial_number =:serie", Array("serie" => $serie));
    $data = $equipementId->fetch();
    DataBase::execute("INSERT INTO Pannes(date, serie, equipement_id, message, etat, client_id ) VALUES (NOW(), :serie, :equipementId, :message, 1, :utilisateurId)", Array("serie" => $serie, "equipementId" => $data['id'], "message" => $message, "utilisateurId" => $utilisateurId));
}


function verifSerie($serie)
{ //vérifie que le numéro de série existe et appartient bien à celui de l'utilisateur.
    $verif = DataBase::execute("SELECT id_utilisateur FROM Pieces WHERE id IN (SELECT piece_id FROM Equipement WHERE serial_number= :serie)", array("serie" => $serie));
    $data = $verif->fetch();
    return $data['id_utilisateur'] == $_SESSION['id'];
}

function verifMail($destinataire)
{
    $confmail = DataBase::execute("SELECT id FROM Utilisateurs WHERE mail = :destinataire", Array("destinataire" => $destinataire));
    if ($confmail == null) {
        return false;
    } else return true;
}

function getIdReceveur($destinataire)
{
    $id_receveur = DataBase::execute("SELECT id FROM Utilisateurs WHERE mail =:destinataire", Array("destinataire" => $destinataire));
    $data = $id_receveur->fetch();
    return $data['id'];
}

function insertMessage($destinataire, $message, $titre)
{
    $envoyeur_id = $_SESSION['id'];
    $receveur_id = getIdReceveur($destinataire);
    DataBase::execute("INSERT INTO Messages(id_envoyeur, id_receveur, date, titre, message) VALUES(:envoyeur_id, :receveur_id, NOW() , :titre, :message)", Array("envoyeur_id" => $envoyeur_id, "receveur_id" => $receveur_id, "titre" => $titre, "message" => $message));
    DataBase::execute("INSERT INTO Notifications(expediteur,date,message, objet, utilisateur_id) VALUES('System', NOW() ,'On vous a envoyé un message.', 'Nouveau Message', :receveur_id)", Array("receveur_id" => $receveur_id));

}

function messageRecu1()
{
    $idUtilsateur = $_SESSION['id'];
    $message_recu = DataBase::execute("SELECT * FROM Messages WHERE id_receveur = :idUtilsateur ORDER BY date DESC ", Array("idUtilsateur" => $idUtilsateur));
    while ($donnees = $message_recu->fetch()) {
        echo "
        <tr>
        <td>";
        $idExp = $donnees['id_envoyeur'];
        $req = DataBase::execute("SELECT mail FROM Utilisateurs WHERE id = :idExp", Array("idExp" => $idExp));
        $data = $req->fetch();
        echo $data['mail'];
        echo "</td><td>";
        echo $donnees['titre'];
        echo "</td>
        <td>";
        echo $donnees['message'];
        echo "</td>
        <td>";
        echo humanDateFormatHour($donnees['date']);
        echo "</td>
        </tr>";

    }
}

function messageEnvoye1()
{
    $idUtilsateur = $_SESSION['id'];
    $message_envoye = DataBase::execute("SELECT * FROM Messages WHERE id_envoyeur = :idUtilsateur ORDER BY date DESC ", Array("idUtilsateur" => $idUtilsateur));
    while ($donnees = $message_envoye->fetch()) {
        ?>
        <tr>
        <td>
            <?php
            $idRec = $donnees['id_receveur'];
            $req = DataBase::execute("SELECT mail FROM Utilisateurs WHERE id = :id", Array("id" => $idRec));
            $data = $req->fetch();
            echo $data['mail']; ?>
        </td>
        <td>
            <?= $donnees['titre'] ?>
        </td>
        <td>
            <?= $donnees['message'] ?>
        </td>
        <td>
        <?= (humanDateFormatHour($donnees['date'])) ?>
        <?php
    }
}

function insertRDV($date, $cause_rdv)
{
    $idUtilisateur = $_SESSION['id'];
    DataBase::execute("INSERT INTO RDV(client_id, cause, date) VALUES(:idUtilisateur, :cause_rdv, :date)", Array("idUtilisateur" => $idUtilisateur, "cause_rdv" => $cause_rdv, "date" => $date));
}

function afficherQuestion()
{
    $req = DataBase::execute('SELECT * FROM FAQ');
    while ($donnees = $req->fetch()) {
        ?>
        <div class="question"> <?php echo $donnees['question'] ?> </div> <br>
        <div class="reponse"> <?php echo $donnees['reponse'] ?> </div> <br> <br>
        <?php
    }
}
