<?php
include_once('fonctions.php');
session_start();
if(isset($_POST['email'])) {
    $req = Database::execute("SELECT id FROM Utilisateurs WHERE mail = :mail", Array("mail" => $_POST['email']));
    if ($req->rowCount() > 0){
        $data = $req->fetch();
        if ($data['id'] != $_SESSION['id']){
            echo json_encode(array('exist' => true));
        } else {
            echo json_encode(array('exist' => false));
        }
    }
    else {
        echo json_encode(array('exist' => false));
    }
}
?>