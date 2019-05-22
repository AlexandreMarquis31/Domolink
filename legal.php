<?php
if ($_SESSION['type'] != 1) {
    header("Location: dashBoard.php?piece=VueGenerale");
    die();
}
if (!empty($_POST['newCGU']))
    Database::execute('UPDATE Administration SET cgu = :CGU', Array('CGU' => $_POST['newCGU']));
if (!empty($_POST['newMentions']))
    Database::execute('UPDATE Administration SET mentions_legales = :mentions', Array('mentions' => $_POST['newMentions']));
$req = Database::execute('SELECT cgu,mentions_legales FROM Administration');
$donnees = $req->fetch();
?>
<div class="legalColumn">
    <h1>CGU :</h1>
    <?php if (boolval($_GET['modifyCGU'])) : ?>
        <form action='administration.php?modifyCGU=0&modifyMentions=<?php echo $_GET['modifyMentions']; ?>'
              method='POST' id="legalForm">
            <textarea id='customScroll' name="newCGU"><?php echo $donnees['cgu']; ?></textarea>
            <input type='submit' class='button adminButton' value='Sauvegarder'>
        </form>
    <?php else : ?>
        <textarea id='customScroll' readonly><?php echo $donnees['cgu']; ?></textarea>
        <form action='administration.php?modifyCGU=1&modifyMentions=<?php echo $_GET['modifyMentions']; ?>'
              method='POST'>
            <input type='submit' class='button adminButton' value='Modifier'>
        </form>
    <?php endif; ?>
</div>
<div class="legalColumn">
    <h1>Mentions légales :</h1>
    <?php if (boolval($_GET['modifyMentions'])) : ?>
        <form action='administration.php?modifyCGU=<?php echo $_GET['modifyCGU']; ?>&modifyMentions=0' method='POST'
              id="legalForm">
            <textarea id='customScroll' name="newMentions"><?php echo $donnees['mentions_legales']; ?></textarea>
            <input type='submit' class='button adminButton' value='Sauvegarder'>
        </form>
    <?php else : ?>
        <textarea id='customScroll' name="newMentions" readonly><?php echo $donnees['mentions_legales']; ?></textarea>
        <form action='administration.php?modifyCGU=<?php echo $_GET['modifyCGU']; ?>&modifyMentions=1' method='POST'>
            <input type='submit' class='button adminButton' value='Modifier'>
        </form>
    <?php endif; ?>
</div>