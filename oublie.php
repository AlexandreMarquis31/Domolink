<!DOCTYPE>
<head>
    <meta charset="utf-8"> <!-- UTF-8 permet d'obtenir tous les caractères chinois, arabes, accents... -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; ">
    <link rel="stylesheet" href="/css/oublie.css"/>
    <link rel="stylesheet" href="/css/cssGeneral.css"/>
    <title> DomoLink </title>
</head>
<?php
include 'header.php';

if (isset($_POST['mail'])) {
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) === false) {
        echo 'adresse email non valide';
    }
    $verification = Database::execute('SELECT mail FROM Utilisateurs WHERE mail = :mail', array('mail' => $_POST['mail']));
    $existe = $verification->fetch();
    if ($existe) {
        mail($_POST['mail'], 'nouveau mot de passe', 'Votre nouveau mot de passe est : ');
        echo 'Votre nouveau mot de passe vous a été envoyé par mail';
    }
}
?>

<div class="section">
    <div class="sousection">
        <div class="text">
            <form method="post">
                <br>
                <h2> Veuillez écrire votre adresse email : </h2>
                <input type="text" name="mail" size="40" id="uname" required>
                </br></br>
                <input class="button whiteButton" name="inscription" type="submit"/>  </br>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

