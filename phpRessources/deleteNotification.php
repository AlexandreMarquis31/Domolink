<?php
include_once("fonctions.php");
session_start();
$id = $_GET['id'];
$req = Database::execute('DELETE FROM Notifications WHERE id = :id AND utilisateur_id = :utilisateur_id', Array(
    'id' => $id,
    'utilisateur_id' => $_SESSION['id']
));
header("Location: /notifications.php");
die();
