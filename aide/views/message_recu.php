<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="/ressources/favicon.png"/>
    <link rel="stylesheet" href="/css/cssGeneral.css">
    <link rel="stylesheet" href="/css/aide.css">
    <link rel="stylesheet" href="/css/notifications.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>Messages reçus</title>
</head>
<body>
<?php include("../../header.php"); ?>
<div class = "wrapper">
    <div class="menu">
        <nav>
            <a href="router.php?">Les questions fréquentes</a>
            <a href="router.php?action=signaler_une_panne">Formulaire de panne</a>
            <a href="router.php?action=messagerie" > Messagerie </a>
            <div class ="menumessagerie">
                <nav>
                    <a href="router.php?action=nouveau_message"> Nouveau message  </a>
                    <a href="router.php?action=message_envoye"> Messages envoyés  </a>
                    <a href="router.php?action=message_recu" class="active"> Messages reçus</a>

                </nav>
            </div>
            <a href="router.php?action=prise_de_rdv">Prise de rendez-vous</a>
        </nav>
    </div>
    <div class="corps">
        <h1> Messages reçus  </h1>
        <section>
            <table>
                <thead>
                <tr>
                    <th>Envoyeur</th>
                    <th>Objet</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                </thead>


                <tbody>
                <?php messageRecu() ?>
                </tbody>
            </table>
        </section>


    </div>
</div>
<?php include ("../../footer.php"); ?>
</body>

</html>