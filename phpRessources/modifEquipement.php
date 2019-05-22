<?php
include_once("fonctions.php");
    session_start();
    if (isset($_GET['idEq'])){
        $req = Database::execute('DELETE FROM Equipement WHERE id = :id AND  piece_id IN (SELECT id FROM Pieces WHERE id_utilisateur =:id_utilisateur)',Array(
            'id' => $_GET['idEq'],
            'id_utilisateur' => $_SESSION['id']
        ));
        header("Location: /dashBoard.php?piece=".$_GET['idPiece']);
        die();

    } else if (isset($_POST['serieEqu'])){
        $req = Database::execute('INSERT INTO Equipement(type,genre,donnees,actif,serial_number,piece_id) VALUES(:type,:genre,0,0,:serie,:piece_id)',Array(
            'type' => $_POST['typeEqu'],
            'genre' => $_POST['genreEqu'],
            'serie' => $_POST['serieEqu'],
            'piece_id' => $_GET['idPiece']
        ));
        header("Location: /dashBoard.php?piece=".$_GET['idPiece']);
        die();
    }