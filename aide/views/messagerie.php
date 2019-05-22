<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="/ressources/favicon.png"/>
    <link rel="stylesheet" href="/css/cssGeneral.css">
    <link rel="stylesheet" href="/css/aide.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>Nouveau message</title>
</head>
<body>
<?php include("../../header.php"); ?>
<div class="wrapper">
    <div class="menu">
        <nav>
            <a href="router.php?">Les questions fréquentes</a>
            <a href="router.php?action=signaler_une_panne">Formulaire de panne</a>
            <a href="router.php?action=messagerie"> Messagerie </a>
            <div class="menumessagerie">
                    <a href="router.php?action=nouveau_message" class="active"> Nouveau message </a>
                    <a href="router.php?action=message_envoye"> Messages envoyés </a>
                    <a href="router.php?action=message_recu"> Messages reçus</a>
            </div>
            <a href="router.php?action=prise_de_rdv">Prise de rendez-vous</a>
        </nav>
    </div>
    <div class="corps">
        <h1> Nouveau message </h1>

        <p>
        <form method="post" action="router.php?action=formulaire_message">
            <label>
                Destinataire : <input type="email" name="destinataire">
            </label> <br><br>
            <label>
                Objet : <input type="text" name="objet" required>
            </label><br><br>
            <label>
                Message : <br>
                <input type="text" name="message" size="50" required>

            </label> <br><br>
            <input type="submit" class='button ' VALUE="Envoyer">


        </form>
        </p>
    </div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>
