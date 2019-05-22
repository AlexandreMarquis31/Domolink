<?php
include("fonctions.php");
session_start();


// Ajout d'une heure de distribution de nourriture dans la BDD

if (!empty($_POST['heureNourriture'])) {
    $post = htmlspecialchars($_POST['heureNourriture']);
    date_default_timezone_set('Europe/Paris');
    Database::execute('INSERT INTO NourritureAnimaux(date,animal_id) VALUES(:heure,:animal_id)', Array(
        'heure' => date('H:i', strtotime($post)),
        'animal_id' => $_GET['animal']
    ));

    header("Location:/animaux.php?animal={$_GET['animal']}");

} else if(isset($_GET['animal'])) {
    Database:: execute('DELETE FROM NourritureAnimaux WHERE animal_id =:animal_id',Array('animal_id'=>$_GET['animal']));
    header("Location:/animaux.php?animal={$_GET['animal']}");
}