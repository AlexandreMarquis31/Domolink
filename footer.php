</div>
<footer>
    <div class="footer_location">
        <h3> Nous contacter </h3>
        Adresse : <?php echo $donneesAdmin['adresse']; ?><br>
        Téléphone : <?php echo $donneesAdmin['telephone']; ?><br>
        E-Mail: <a id="linkMail"
                   href="mailto:<?php echo $donneesAdmin['mail']; ?>"><?php echo $donneesAdmin['mail']; ?></a><br>
    </div>
    <div class="footer_reseaux">
        <h3> Suivez-nous sur les réseaux sociaux </h3>
        <a href=<?php echo $donneesAdmin['twitter']; ?>><img src="/ressources/Twitter.png" draggable="false" width="30vw"
                                                             alt="Twitte">Twitter</a><br>
        <a href=<?php echo $donneesAdmin['facebook']; ?>><img src="/ressources/Facebook.png" draggable="false" width="30vw"
                                                              alt="Facebo">Facebook</a><br>
        <a href=<?php echo $donneesAdmin['instagram']; ?>><img src="/ressources/Instagram.png" draggable="false" width="30vw"
                                                               alt="Instagr">Instagram</a>
    </div>
    <div class="footer_description">
        <h3>À propos de DomoLink</h3>
        Site de <?php echo $donneesAdmin['nom']; ?><br>
        Un projet de la société <?php echo $donneesAdmin['societe']; ?><br>
        <a id="cguFooter">Conditions Générales d'utilisation</a><br>
        <a id="mentionsFooter">Mentions Légales</a><br>
    </div>
</footer>

<script src="/javascript/informationView.js"></script>