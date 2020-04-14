<?php
  is_connect();
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
 
?>
    
            <div class="positionAdmin">
                <div class="parametre">
                    <p class="adminquizz">CR&#201;ER ET PARAM&#201;TRE VOS QUIZZ</p>
                    <span class="deconnection">
                    <?php
                        echo "<a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                            href='index.php?status=logout'> Deconnexion</a>";
                    ?>
                    </span>
                </div> 
                <div class="quizz">
                    <div class="partieAdmin">
                        <div class="avatar">
                            
                            <div class="nompre">
                                <p class="prenomAdmin"><?= $prenom; ?></p>
                                <p class="nomAdmin"> <?= $nom; ?></p>
                            </div>
                        </div>
                        <div class="tableaude bord">
                            <div class="liste question"><a href="#"> Questions <img src="Images\Icônes\ic-liste.png"/></a> </div>
                            <div class="liste creerAdmin"><a href="#"> Créer Admin<img src="Images\Icônes\ic-ajout.png"/></a></div>
                            <div class="liste joueurs"><a href="#"> Listes joueurs<img src="Images\Icônes\ic-liste.png"/></a></div>
                            <div class="liste creerquestions"><a href="#"> Créer Questions<img src="Images\Icônes\ic-ajout.png"/></a></div>
                        </div>
                    </div>
                    <div class="affichage table">
                    </div>
                </div>
            </div>
      

