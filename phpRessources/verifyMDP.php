<?php
include_once('fonctions.php');
session_start();
if (isset($_POST['mdp'])) {
    $req = Database::execute("SELECT id FROM Utilisateurs WHERE mdp = :mdp", Array("mdp" => hash('sha256',$_POST['mdp'])));
    if ($req->rowCount() > 0) {
        $data = $req->fetch();
        if ($data['id'] == $_SESSION['id']) {
            echo json_encode(array('ok' => true));
        } else {
            echo json_encode(array('ok' => false, 'data' => 'bbb'));
        }
    } else {
        echo json_encode(array('ok' => false, 'data' => 'aaa'));
    }
} else {
    echo json_encode(array('ok' => false));
}
?>