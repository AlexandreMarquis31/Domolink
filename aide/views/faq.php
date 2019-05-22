<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="/ressources/favicon.png"/>
    <link rel="stylesheet" href="/css/cssGeneral.css">
    <link rel="stylesheet" href="/css/aide.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>Les questions fréquentes</title>
</head>

<body>
<?php include("../../header.php"); ?>
<div class = "wrapper">
    <div class="menu">
        <nav>
            <a href="router.php?" class='active'>Les questions fréquentes</a>
            <a href="router.php?action=signaler_une_panne">Formulaire de panne</a>
            <a href="router.php?action=messagerie"> Messagerie </a>
            <a href="router.php?action=prise_de_rdv">Prise de rendez-vous</a>
        </nav>
    </div>
    <div class="corps">
        <h1>Les questions fréquentes</h1> <br>
        <?php chercheQuestion(); ?>

    </div>
</div>
<?php include ("../../footer.php"); ?>
</body>
</html>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Akhara
 * Date: 12/11/2018
 * Time: 13:39
 */
?>