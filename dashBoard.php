<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; ">
    <link rel="shortcut icon" href="ressources/favicon.png"/>
    <link rel="stylesheet" href="css/cssGeneral.css">
    <link rel="stylesheet" href="css/dashBoard.css">
    <link rel="stylesheet" href="css/notificationsWidget.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>DomoLink</title>
</head>
<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("notificationsWidget.php"); ?>
    <nav class="menu">
        <?php
        $req = Database::execute('SELECT id,nom FROM Pieces WHERE id_utilisateur = :id_utilisateur', Array('id_utilisateur' => $_SESSION['id']));
        if (isset($_GET['piece']) && $_GET["piece"] == "VueGenerale")
            echo "<a class='active' href='?piece=VueGenerale'>Vue Générale</a>";
        else
            echo "<a href='?piece=VueGenerale'>Vue Générale</a>";
        while (isset($req) && $donnees = $req->fetch()) {
            if ($donnees['id'] == $_GET["piece"])
                echo "<a class='active' href='?piece={$donnees['id']}'>{$donnees['nom']}</a>";
            else
                echo "<a href='?piece={$donnees['id']}'>{$donnees['nom']}</a>";
        }
        echo "<a href='animaux.php?animal=GestionAnimaux'>Animaux</a>";
        if (isset($_GET['piece']) && $_GET["piece"] == "AjouterPiece")
            echo "<a class='active' href='?piece=AjouterPiece'>+ Ajouter Pièce</a>";
        else
            echo "<a href='?piece=AjouterPiece'>+ Ajouter Pièce</a>";
        ?>
    </nav>
    <?php if ($_GET['piece'] == 'VueGenerale') : ?>
        <div class='littleTitle'>Statistique</div>
        <div class="statsWrapper">
            <div class="divGraph">
                <div class='noGraph'>Aucune donnée disponible.</div>
                <canvas id="mensuelle">fdfdg</canvas>
            </div>
            <div class="divGraph">
                <div class='noGraph'>Aucune donnée disponible.</div>
                <canvas id="annuelle"></canvas>
            </div>
        </div>
        <div class="statsWrapper">
            <div id="divGraphRoom">
                <div class='noGraph'>Aucune donnée disponible.</div>
                <canvas id="roomGraph"></canvas>
            </div>
        </div>
    <?php elseif ($_GET["piece"] == 'AjouterPiece') : ?>
        <form autocomplete='off' class='title formPiece' action='/phpRessources/modifPiece.php' method='post'>Nom de la
            pièce :<br><br>
            <input type='text' name='nomPiece' id="nomPiece" maxlength=15><br><br>
            <input class='button blueButton' id="pieceBut" type='submit' value='Ajouter'>
        </form>
    <?php elseif (isset($_GET['piece'])) : ?>
        <div class='littleTitle'>Statistiques</div>
        <div class="statsWrapper">
            <div class="divGraph">
                <div class='noGraph'>Aucune donnée disponible.</div>
                <canvas id="mensuelle"></canvas>
            </div>
            <div class="divGraph">
                <div class='noGraph'>Aucune donnée disponible.</div>
                <canvas id="annuelle"></canvas>
            </div>
        </div>
        <div class='littleTitle'>Capteurs</div>
        <div class='scrollbar' id='customScroll'>
            <?php
            $req = Database::execute("SELECT * FROM Equipement WHERE piece_id = :piece_id AND type = 'capteur'", Array('piece_id' => $_GET["piece"]));
            while (isset($req) && $donnees = $req->fetch()) {
                switch ($donnees['genre']) {
                    case "Température":
                        $class = "tempBox";
                        $unite = "°";
                        break;
                    case "Humidité":
                        $class = "humBox";
                        $unite = "%";
                        break;
                }
                echo "<div class='box {$class}'>
                <div class='boxTitle'>{$donnees['genre']}</div>
                <div class='boxInfo'>{$donnees['donnees']}{$unite}</div>
                <a href='phpRessources/modifEquipement.php?idEq={$donnees['id']}&idPiece={$_GET['piece']}'> <div class='suppBox'>Supprimer</div></a>
            </div>";
            }
            ?>
            <div class='box ajouterBox'>
                <form action='phpRessources/modifEquipement.php?idPiece=<?php echo $_GET['piece']; ?>'
                      method='post'>
                    <select id="selectEqu" name="genreEqu">
                        <option>Type d'appareil</option>
                        <option>Humidité</option>
                        <option>Température</option>
                    </select>
                    <input type='text' placeholder="Numéro de série" class="serieEqu" name="serieEqu" id="serieEq"/>
                    <input type='hidden' name="typeEqu" value="capteur" />
                </form>
                <div class="errorEqu"/></div>
                <div class='cancelBox'>Annuler</div>
                <div class='addBox'>Ajouter</div>

            </div>
            </div>
        <div class='littleTitle'>Actionneurs</div>
        <div class='scrollbar' id='customScroll'>
            <?php
            $req = Database::execute("SELECT * FROM Equipement WHERE piece_id = :piece_id AND type = 'actionneur'", Array('piece_id' => $_GET["piece"]));
            while (isset($req) && $donnees = $req->fetch()) {
                $checked ="";
                switch ($donnees['genre']) {
                    case "Alarme":
                        $class = "alarmBox";
                        break;
                    case "Lumières":
                        $class = "lumBox";
                        break;
                }
                if ($donnees['actif']) $checked="checked";
                echo "<div class='box {$class}'>
                <div class='boxTitle'>{$donnees['genre']}</div>
                <label class='switch actSwitch'>
                    <input type='checkbox' {$checked}>
                    <span class='slider round'></span>
                </label>
                <a href='phpRessources/modifEquipement.php?idEq={$donnees['id']}&idPiece={$_GET['piece']}'><div class='suppBox'>Supprimer</div></a>
            </div>";
            }
            ?>
            <div class='box ajouterBox'>
                <form action='phpRessources/modifEquipement.php?idPiece=<?php echo $_GET['piece']; ?>'
                      method='post'>
                <select id="selectEqu" name="genreEqu">
                    <option>Type d'appareil</option>
                    <option>Alarme</option>
                    <option>Lumières</option>
                </select>
                    <input type='text' placeholder="Numéro de série" class="serieEqu" name="serieEqu" id="serieEq"/>
                    <input type='hidden' name="typeEqu" value="actionneur" />
                </form>
                <div class="errorEqu"/></div>
                <div class='cancelBox'>Annuler</div>
                <div class='addBox'>Ajouter</div>
            </div>
        </div>
        <form class='wrapDeleteButton' action='phpRessources/modifPiece.php?piece=<?php echo $_GET['piece']; ?>'
              method='post'>
            <input type='submit' class='button redButton' value='Supprimer la pièce' name='piece'><br>
        </form>

    <?php endif; ?>
</div>
<?php include("footer.php"); ?>
<script src="libs/jquery-3.3.1.js"></script>
<script src="libs/Chart.js"></script>
<script src="javascript/generalJS.js"></script>
<script data-my_var_1='<?php echo $_SESSION['id']; ?>' data-my_var_2='<?php echo $_GET['piece']; ?>'
        src="javascript/dashBoard.js"></script>

