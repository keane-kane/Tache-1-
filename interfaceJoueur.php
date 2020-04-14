<?php
 is_connect();

  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
 
?>

            <div class="positionAdmin">
                <div class="parametre">
                    <div class="avatar">
                        
                        <div class="nompre">
                            <p class="prenomAdmin"><?= $prenom; ?></p>
                            <p class="nomAdmin"> <?= $nom; ?></p>
                        </div>
                    </div>
                    <p class="adminquizz">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br>
                                          JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</p>
                    <div class="deconnection">
                    <?php
                        echo " <a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                              href='index.php?status=logout'> Deconnexion</a>";
                     ?>
                    </div>
               </div>
            </div>
