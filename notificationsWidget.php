
<?php
    $reponse = Database::execute('SELECT * FROM Notifications WHERE utilisateur_id=:id ORDER BY id DESC', Array('id' => $_SESSION['id']));
?>

<div class="notifications">
    <h1>Notifications</h1>
    <?php
    if ($reponse->rowCount() == 0) {
        echo "<div class='noNotification'>Il n'y a pas de nouvelle notification</div>";
    } else {
        while ($donnees = $reponse->fetch()) {
            ?>
            <a href="notifications.php"><button class="buttonA">
                <span><strong><?php echo $donnees['expediteur'];?></strong>
                        <?php echo $donnees['objet'] . "<br>" . humanDateFormatHour($donnees['date']) . '<br />';
                        ?></span>
            </button></a>
            <?php
        }
    }
    $reponse->closeCursor();
    ?>
</div>
