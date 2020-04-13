<?php
  session_start();
  $nom = $_SESSION['nom'];
  $prenom = $_SESSION['prenom'];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/interfaceAdmin.css">
    <title>Page Admin</title>
    
</head>
  <body>
   
       <div class="plaisir">
          <p class="imageH" ></p>
          <h1 class="text jouer">Le plaisir de jouer</h1>
        </div>

        <div class="background fond">
            <div class="positionAdmin">
                <div class="parametre">
                    <p class="adminquizz">CR&#201;ER ET PARAM&#201;TRE VOS QUIZZ</p>
                    <span class="deconnection">
                    <?php
                        echo " <a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                              href='deconnexion.php'> Deconnexion</a>";
?>
                    </span>
                </div> 
                <div class="quizz">
                    <div class="partieAdmin">
                        <div class="avatar">
                            <img src="Images/img-bg.jpg" alt="">
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
        </div>
    </body>
</html>
