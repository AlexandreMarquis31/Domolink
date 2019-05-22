<?php
include_once("phpRessources/fonctions.php");
session_start();
if (empty($_SESSION['id']) && (!(strpos($_SERVER['REQUEST_URI'],"connexion.php"))&&!(strpos($_SERVER['REQUEST_URI'],"oublie.php"))&&!(strpos($_SERVER['REQUEST_URI'],"activation.php")))) {
    header("Location: /connexion.php");
    die();
} elseif ($_SESSION['type'] != 0  && !(strpos($_SERVER['REQUEST_URI'],"administration.php"))&& !(strpos($_SERVER['REQUEST_URI'],"compte.php")) && !(strpos($_SERVER['REQUEST_URI'],"router.php"))) {
    header("Location: /administration.php");
    die();
} else {
    $req2 = Database::execute('SELECT nom,societe,telephone,slogan,adresse,mail,facebook,twitter,instagram FROM Administration', null);
    $donneesAdmin = $req2->fetch();
}
?>

<body>
<header>
    <div class="topIcon">
        <a href="/dashBoard.php?piece=VueGenerale">
            <img draggable="false" src="/ressources/Logo.png" alt="DomoLink" width=200vw/>
        </a>
        <div class="slogan"><br><em class="slogan compagnie"><?php echo $donneesAdmin['nom']; ?></em>
            : <?php echo $donneesAdmin['slogan']; ?></div>
    </div>
    <?php if ($_SERVER['PHP_SELF'] != "/connexion.php" && $_SERVER['PHP_SELF'] != "/oublie.php" && $_SERVER['PHP_SELF'] != "/activation.php"): ?>
        <div class="topMenu">
            <div class="menuItem">
            </div>
            <?php if ($_SESSION['type'] == 0): ?>
            <div class="menuItem">
                <a href="/dashBoard.php?piece=VueGenerale"><img draggable="false" alt="Domicile Icône"
                                                               src="/ressources/accueil.png" width=60%/></a>
                <a href="/dashBoard.php?piece=VueGenerale" class="caption">Mon Domicile</a>
            </div>
            <?php endif; ?>
            <?php if ($_SESSION['type'] != 0): ?>
                <div class="menuItem">
                    <a href="/administration.php"><img draggable="false" src="/ressources/administration.png"
                                                      alt="Administration Icône"
                                                      width=60%/></a>
                    <a href="/administration.php" class="caption">Gérer</a>
                </div>
            <?php endif; ?>
            <div class="menuItem">
                <a href="/compte.php?action=infos"><img draggable="false" src="/ressources/compte.png"
                                                       alt="Icône Compte" width=60%/></a>
                <a href="/compte.php?action=infos" class="caption">Compte</a>
            </div>
            <div class="menuItem">
                <a href="/aide/routers/router.php"><img draggable="false" src="/ressources/aide.png" alt="DomoLink" width=60%/></a>
                <a href="/aide/routers/router.php" class="caption">Aide</a>
            </div>
        </div>
    <?php endif; ?>
</header>
<div class="contenu">