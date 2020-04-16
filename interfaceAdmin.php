<?php
  is_connect();
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
 
?>
    
            <div class="inter-Admin">
                <div class="quizz">
                    <div class="param-admin">
                        <p class="adminquizz">CR&#201;ER ET PARAM&#201;TRE VOS QUIZZ</p>
                        <span class="decon-Admin">
                            <?php
                                echo "<a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                                    href='index.php?status=logout'> Deconnexion</a>"; ?>
                        </span>
                    </div>
                    <div class="content-2">
                        <div class="partieAdmin">
                            <div class="admin-avatar">
                                <img src="Images/img-bg.jpg" alt="">
                                <div class="nom-prenom-Admin">
                                    <p class="prenomAdmin"><?= $prenom; ?></p>
                                    <p class="nomAdmin"> <?= $nom; ?></p>
                                </div>
                            </div>
                            <div class="tableau-bord-Admin">
                                <div class="liste question"><a href="#"> Questions <img src="Images\Icônes\ic-liste.png"/></a> </div>
                                <div class="liste creerAdmin"><a href="#"> Créer Admin<img src="Images\Icônes\ic-ajout.png"/></a></div>
                                <div class="liste joueurs"><a href="#"> Listes joueurs<img src="Images\Icônes\ic-liste.png"/></a></div>
                                <div class="liste creerquestions"><a href="#"> Créer Questions<img src="Images\Icônes\ic-ajout.png"/></a></div>
                            </div>
                        </div>
                        <div class="affichage-table">
                            <h3>LISTE DES JOUEURS PAR SCORE</h3>
                             <table class="liste-joueur">
                                    <tr><th>Nom</th><th>Prénom</th><th>SCORE</th></tr>
                                    <tr><td>Diatta</td><td>Ibou</td><td>1022 pts</td></tr>
                                    <tr><td>Niang</td><td>Aly</td><td>963 pts</td></tr>
                                    <tr><td>Mbaye</td><td>Saliou</td><td>877 pts</td></tr>
                                    <tr><td>Diouf</td><td>Khady</td><td>875 pts</td></tr>
                                    <tr><td>SOW</td><td>MOUSSA</td><td>870 pts</td></tr>
                                    <tr><td>MBOUP</td><td>Youssou</td><td>816 pts</td></tr>
                                    <tr><td>NIANG</td><td>Djiby</td><td>816 pts</td></tr>
                                    <tr><td>DIENG</td><td>Astou</td><td>800 pts</td></tr>
                                    <tr><td>SAMB</td><td>Ibrahima</td><td>797 pts</td></tr>
                                    <tr><td>GUEYE</td><td>Léna</td><td>763 pts</td></tr>
                                    <tr><td>BEYE</td><td>Anminata</td><td>760 pts</td></tr>
                                    <tr><td>MANÊ</td><td>Lamine</td><td>759 pts</td></tr>
                                    <tr><td>MENDES</td><td>Serges</td><td>730 pts</td></tr>
                                    <tr><td>NDECKY</td><td>Estelle</td><td>723 pts</td></tr>
                                    <tr><td>DIALLO</td><td>Moustapha</td><td>720 pts</td></tr>
                                    <tr><td>NDOUR</td><td>Abba</td><td>716 pts</td></tr>
                                    <tr><td>GUEYE</td><td>Léna</td><td>763 pts</td></tr>
                            </table>
                            <button class="btn-suiv">Suivant</button>
                        </div>
                 </div>
                </div>
            </div>
            
      

