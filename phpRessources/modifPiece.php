<?php
include_once("fonctions.php");
    session_start();
    if (isset($_POST['nomPiece'])){
        $req = Database::execute('INSERT INTO Pieces(nom,id_utilisateur) VALUES(:nom,:id_utilisateur)',Array(
            'nom' => $_POST['nomPiece'],
            'id_utilisateur' => $_SESSION['id']
        ));
        $reponse = Database::execute('SELECT LAST_INSERT_ID() AS last_id FROM Pieces');
        $data = $reponse ->fetch();
        header("Location: /dashBoard.php?piece={$data['last_id']}");
        die();
    }
    if (isset($_GET['piece'])){
        $id =  $_GET['piece']; 
        $req = Database::execute('DELETE FROM Pieces WHERE id = :id AND id_utilisateur = :id_utilisateur',Array(
            'id' => $id,
            'id_utilisateur' => $_SESSION['id']
        ));
        header("Location: /dashBoard.php?piece=VueGenerale");
        die();

    }