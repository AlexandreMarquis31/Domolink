<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <!-- Import des fichiers CSS -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="ressources/favicon.png"/>
    <link rel="stylesheet" href="css/cssGeneral.css">
    <link rel="stylesheet" href="css/dashBoard.css">
    <link rel="stylesheet" href="css/animaux.css">
    <link rel="stylesheet" href="css/notificationsWidget.css">
    <meta name="description" content="Le Top de la Maison Connectée !">
    <title>DomoLink</title>
</head>
<body>
<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("notificationsWidget.php"); ?>
    <nav class="menu"> <!-- Affichage du menu de navigation-->
        <!-- Bouton retour à l'accueil -->
        <?php
        echo "<a href='dashBoard.php?piece=VueGenerale'>Retour à l'accueil</a>";
        $req = Database::execute('SELECT id,nom FROM Animaux WHERE id_utilisateur = :id_utilisateur', Array('id_utilisateur' => $_SESSION['id']));

        //Si on se trouve sur l'onglet Gestion des Animaux, affiche le bouton avec la police en rouge

        if (isset($_GET['animal']) && $_GET["animal"] == "GestionAnimaux")
            echo "<a class='active' href='?animal=GestionAnimaux'>Gestion des animaux</a>";
        else
            echo "<a href='?animal=GestionAnimaux'>Gestion des animaux</a>";

        // Tant qu'il y a un animal dans la BDD, on affiche son bouton associé (en rouge si on est sur la page associée)

        while (isset($req) && $donnees = $req->fetch()) {
            if ($donnees['id'] == $_GET["animal"])
                echo "<a class='active' href='?animal={$donnees['id']}'>{$donnees['nom']}</a>";

            else
                echo "<a href='?animal={$donnees['id']}'>{$donnees['nom']}</a>";
        }
        //Si on se trouve sur l'onglet Ajouter Animal, affiche le bouton avec la police en rouge

        if (isset($_GET['animal']) && $_GET["animal"] == "AjouterAnimal")
            echo "<a class='active' href='?animal=AjouterAnimal'>+ Ajouter Animal</a>"; //
        else
            echo "<a href='?animal=AjouterAnimal'>+ Ajouter Animal</a>";

        ?>
    </nav>

    <!-- Onglet Gestion des animaux-->

    <?php if ($_GET['animal'] == 'GestionAnimaux') : ?>
        <div class="case4-7">
            <h2>Bienvenue sur la rubrique de gestion des animaux</h2>
            <h3> Vous trouverez ici les informations relatives au distributeur de nourriture et pourrez modifier ses fonctionnalités à votre guise</h3>
        </div>

        <!-- Onglet Ajouter un Animal-->

    <?php elseif ($_GET["animal"] == 'AjouterAnimal') : ?>

        <form autocomplete='off' class='title formPiece ' action='phpRessources/modifAnimal.php' method='post'>Nom de l'animal :<br><br>
            <input type='text' name='nomAnimal'  maxlength='15'><br><br>
            <input class='button blueButton ajoutButton'  type='submit' value='Ajouter'>
        </form>

        <!-- Onglet des animaux-->

    <?php elseif (!isset($_GET['nourriture'])) : ?>
        <div class='case1'>

            <form id="form1" >
                <img id="blah" src="ressources/icone-animal.png" alt="your image" width=200%>
            </form>
            <br></br>

            <form class='wrapDeleteButton' action='phpRessources/modifAnimal.php?animal=<?php echo $_GET['animal']?>' method='post'>
                <input type='submit' class='button redButton animalButton' value="Supprimer la page de l'animal" name='deleteanimal'><br>
            </form>

        </div>

        <div class='case5-7'>

        <br></br>

        <form  action='?nourriture=ModifierNourriture&animal=<?php echo $_GET['animal']; ?>' method='post'>
            <input type='submit' class='button blueButton' value="Ajouter une heure de distribution"
                   name='ajoutheurenourriture'>
        </form>

        <br>

        <form  action='phpRessources/modifNourriture.php?animal=<?php echo $_GET['animal']; ?>' method='post'>
            <input type='submit' class='button blueButton' value="Réinitialiser les heures de distributions"
                   name='deleteheurenourriture'>
        </form>


        <h2>Repas programmés :</h2>

        <!-- Affichage des repas programmés-->

        <?php
        $req = Database::execute('SELECT date FROM NourritureAnimaux WHERE animal_id = :animal_id', Array('animal_id' => $_GET['animal']));
        while (isset($req) && $donnees = $req->fetch()) {
            date_default_timezone_set('Europe/Paris');
            $date = date('H:i', strtotime($donnees['date']));
            echo "<h3>Un repas sera distribué à {$date}.</h3>";
        }
        ?>


        <!-- Ajout d'une nouvelle heure de distribution -->
    <?php elseif ($_GET['nourriture'] == 'ModifierNourriture') : ?>


        <form autocomplete='off' class='title formPiece' action="phpRessources/modifNourriture.php?animal=<?php echo $_GET['animal']; ?>" method='post'>Nouvelle distribution
            automatique à l'heure suivante : <br><br>

            <p>HH:MM</p>
            <input type="time" class="time" name="heureNourriture" required><br><br>
            <input class='button blueButton ajoutButton'  type='submit' value='Ajouter'>
        </form>
        <!-- Suppression des heures programmées-->
    <?php elseif ($_GET['nourriture'] == 'DeleteNourriture') : ?>
        <div class="case3-6">
        <h2> Les heures de distributions ont bien été réinitialisées.</h2>
        <?php
        $req2 = Database:: execute('DELETE FROM NourritureAnimaux WHERE animal_id =:animal_id',Array('animal_id'=>$_GET['animal'])); ?>

        </div>
    <?php endif; ?>

</div>
</div>
<?php include("footer.php"); ?>
</body>
