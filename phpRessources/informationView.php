<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
    <link rel="shortcut icon" href="ressources/favicon.png"/>
    <link rel="stylesheet" href="css/cssGeneral.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/compte.css">
    <meta name="description" content="Le top de la maison Connectée !">
    <title>DomoLink</title>
</head>
<?php include_once("fonctions.php");
    $req = Database::execute('SELECT cgu,mentions_legales FROM Administration', null);
    $data = $req->fetch();
    $text = preg_replace("/\r\n|\r|\n/", '<br/>', $data[$_GET['data']]);
    echo $text;
?>
