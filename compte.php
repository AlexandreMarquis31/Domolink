<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="ressources/favicon.png"/>
    <link rel="stylesheet" href="css/cssGeneral.css">
    <link rel="stylesheet" href="css/compte.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>DomoLink</title>
</head>
<?php
include("header.php");
if (!empty($_POST['infoSubmit'])) {
    if (!empty($_POST['naissance'])) $naissance = $_POST['naissance'];
    else $naissance = "2000-01-01";
    $array = Array(
        'mail' => $_POST['mail'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'telephone' => $_POST['telephone'],
        'pays' => $_POST['pays'],
        'postal' => intval($_POST['postal']),
        'ville' => $_POST['ville'],
        'rue' => $_POST['rue'],
        'numeroRue' => intval($_POST['numeroRue']),
        'autres' => $_POST['autres'],
        'id' => $_SESSION['id'],
        "naissance" => $naissance
    );
    Database::execute('UPDATE Utilisateurs SET mail=:mail ,nom =:nom , prenom=:prenom , naissance=:naissance , telephone=:telephone, pays =:pays, postal=:postal, ville=:ville , rue=:rue, numeroRue=:numeroRue, autres=:autres WHERE id=:id ', $array);
} else if (!empty($_POST['mdpChange'])){
    $req = Database::execute('SELECT mdp FROM Utilisateurs WHERE id=:id', Array('id' => $_SESSION['id']));
    $donnees = $req->fetch();
    if (hash("sha256", $_POST['actualMDP']) == $donnees['mdp'])
        Database::execute('UPDATE Utilisateurs SET mdp=:mdp WHERE id=:id ', Array('mdp' => hash("sha256", $_POST['newMDP']), 'id' => $_SESSION['id']));
} else if (!empty($_POST['accountDelete'])) {
    Database::execute('DELETE FROM Utilisateurs WHERE id = :id', Array('id' => $_SESSION['id']));
    session_destroy();
    header("Location: connexion.php");
    die();
}
$req = Database::execute('SELECT naissance,nom,prenom,pays,mail,mdp,ville,telephone,postal,rue,numeroRue,autres FROM Utilisateurs WHERE id=:id', Array('id' => $_SESSION['id']));
$donnees = $req->fetch();
?>
<form autocomplete='off' name="infoForm" id="infoForm" action="compte.php?action=<?php echo $_GET['action']; ?>" method='POST'>
    <div class="accountWrapper">
        <div class="menu">
            <?php
            $actionsList = Array('infos' => 'Informations personnelles', 'changeMDP' => 'Modifier le mot de passe', 'delete' => 'Supprimer le compte', 'logout' => 'Déconnexion');
            foreach ($actionsList as $key => $value) {
                if (!empty($_GET['action']) && $_GET["action"] == $key)
                    echo "<a class='active' href='?action={$key}'>{$value}</a>";
                else
                    echo "<a href='?action={$key}'>{$value}</a>";
            }
            ?>
        </div>
        <?php if ($_GET["action"] == "infos"): ?>
            <div class="leftWrapper">
                <div class='title'>Informations personelles</div>
                <br>
                <div class="title2">Adresse e-mail :</div>
                <br>
                <input type='text' name='mail' id="mail" maxlength='50' placeholder="jean.dupont@gmail.com"
                       value=<?php echo "'" . $donnees['mail'] . "'"; ?>/><br>
                <div class="title2">Nom :</div>
                <br>
                <input type='text' name='nom' maxlength='15' placeholder="Dupont"
                       value=<?php echo "'" . $donnees['nom'] . "'"; ?>/><br>
                <div class="title2">Prénom :</div>
                <br>
                <input type='text' name='prenom' maxlength='15' placeholder="Jean"
                       value=<?php echo "'" . $donnees['prenom'] . "'"; ?>/><br>
                <label class="title2">Date de Naissance :</label><br>
                <input type='date' name='naissance' maxlength='10' placeholder="28-09-1993"
                       id="naissance" value=<?php echo "'" . $donnees['naissance'] . "'"; ?>/><br>
                <label class="title2">Numéro de téléphone :</label><br>
                <input type='text' name='telephone' maxlength='10' placeholder="0636303630" id="champTel"
                       value=<?php echo "'" . $donnees['telephone'] . "'"; ?>/><br>
            </div>
            <div class="midWrapper">
                <div class='title'>Adresse</div>
                <br>
                <label class="title2">Pays :</label><br>
                <input type='text' name='pays' maxlength='15' placeholder="France"
                       value=<?php echo "'" . $donnees['pays'] . "'"; ?>/><br>
                <label class="title2">Code Postal :</label><br>
                <input type='text' name='postal' maxlength='10' placeholder="75017" id="champPostal"
                       value=<?php echo "'" . $donnees['postal'] . "'"; ?>/><br>
                <label class="title2">Ville :</label><br>
                <input type='text' name='ville' maxlength='15' placeholder="Paris"
                       value=<?php echo "'" . $donnees['ville'] . "'"; ?>/><br>
                <label class="title2">Rue :</label><br>
                <input type='text' name='rue' maxlength='120' placeholder="Rue de la paix"
                       value=<?php echo "'" . $donnees['rue'] . "'"; ?>/><br>
                <label class="title2">Numéro de rue :</label><br>
                <input type='text' name='numeroRue' maxlength='6' placeholder="15" id="champRue"
                       value=<?php echo "'" . $donnees['numeroRue'] . "'"; ?>/><br>
                <label class="title2">Autres informations :</label><br>
                <input type='text' name='autres' maxlength='100' placeholder="2 ème étage, au fond à droite."
                       value=<?php echo "'" . $donnees['autres'] . "'"; ?>/><br>
                <input type='hidden' name="infoSubmit" value="ok" />
                <input class='button blueButton' type='submit' name="infoSubmit" id="infoSubmit"
                       value='Sauvegarder'>
            </div>
        <?php elseif ($_GET["action"] == "changeMDP"): ?>
            <div class="midWrapper">
                <div class='title'>Changer de Mot de Passe</div>
                <br><br>
                <label class="title2">Mot de passe actuel :</label><br><br>
                <input type='password' name='actualMDP' id='actualMDP' maxlength='15' autocomplete="off"><br><br>
                <label class="title2">Nouveau mot de passe :</label><br><br>
                <input type='password' name='newMDP' id="newMDP" maxlength='15'><br><br>
                <label class="title2">Confirmation du mot de passe :</label><br><br>
                <input type='password' name='confNewMDP' id="confNewMDP" maxlength='15'><br><br>
                <input type='hidden' name="mdpChange" value="ok" />
                <input class='button blueButton' type='submit' value='Valider'
                       name="mdpChange" id="mdpChange">
            </div>
        <?php elseif ($_GET["action"] == "delete"): ?>
            <div class="midWrapper">
                    <div class='title' id="labelDeleteAcc" >Supprimer le compte</div>
                    <br><br>
                    <label class="title2" id="labelEnterMail">Entrez votre adresse
                        E-Mail : </label><br><br>
                    <input type='text' name='mail' id="mail" maxlength='50'><br><br>
                    <input type='hidden' name="accountDelete" value="ok" />
                    <input class='button redButton'
                           id='accountDelete' type='button' value='Supprimer'>
            </div>
        <?php elseif ($_GET["action"] == "logout"): ?>
            <?php
            session_destroy();
            header('Location: connexion.php')
            ?>
        <?php endif; ?>
        <div class="rightWrapper">
            <span id="errorText"></span>
        </div>
    </div>
</form>
<script src="libs/jquery-3.3.1.js"></script>
<script src="javascript/generalJS.js"></script>
<script data-my_var_1=<?php echo $donnees['mail']; ?> src="javascript/compte.js"></script>
<?php include("footer.php"); ?>