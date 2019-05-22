<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; ">
    <link rel="shortcut icon" href="ressources/favicon.png"/>
    <link rel="stylesheet" href="css/cssGeneral.css"/>
    <link rel="stylesheet" href="css/notifications.css">
</head>
<body>
<?php
include("header.php");
$reponse = Database::execute('SELECT * FROM Notifications WHERE utilisateur_id=:id ORDER BY id DESC', Array(
    'id' => $_SESSION['id']
));
?>
<section>
    <h1>Notifications</h1>
    <table>
        <thead>
        <tr>
            <th>Expediteur</th>
            <th>Objet</th>
            <th>Message</th>
            <th>Date</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($donnees = $reponse->fetch()) {
            ?>
            <tr>
                <td>
                    <?= $donnees['expediteur'] ?>
                </td>
                <td>
                    <?= $donnees['objet'] ?>
                </td>
                <td>
                    <?= $donnees['message'] ?>
                </td>
                <td>
                    <?= humanDateFormatHour($donnees['date']) ?>
                </td>
                <td>
                    <form
                            action='phpRessources/deleteNotification.php?id=<?php echo $donnees['id']; ?>' method="post">
                        <input class="button notifButton" type="submit" name="supprimer_notification"
                               value="Supprimer">
                    </form>
                </td>

            </tr>
            <?php
        }
        $reponse->closeCursor();
        ?>
        </tbody>
    </table>
</section>
<?php include("footer.php"); ?>
