<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="/ressources/favicon.png"/>
    <link rel="stylesheet" href="/css/cssGeneral.css">
    <link rel="stylesheet" href="/css/aide.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>Prise de rendez-vous</title>
</head>
<body>
<?php include("../../header.php"); ?>
<div class = "wrapper">
    <div class="menu">
        <nav>
            <a href="router.php?">Les questions fréquentes</a>
            <a href="router.php?action=signaler_une_panne">Formulaire de panne</a>
            <a href="router.php?action=messagerie"> Messagerie </a>
            <a href="router.php?action=prise_de_rdv" class="active">Prise de rendez-vous</a>
        </nav>
    </div>
    <div class="corps">
        <h1>Prise de rendez-vous</h1>
        <p> <form method="post" action="router.php?action=demande_rdv">
            <label> Cause :
                <label><input type="radio" name="cause_rdv" value="panne">Panne</label>
                <label><input type="radio" name="cause_rdv" value="installation">Installation</label>
            </label> <br> <br>
                Veuillez sélecionner vos disponibilité pour la semaine à suivre:
        <p>
            Date : <input type="date" name="date">
        </p>



             <br> <br>

            <input type="submit" class="button" value="Envoyer">
        </p>
    </div>
</div>
<?php include ("../../footer.php"); ?>
</body>
</html>
