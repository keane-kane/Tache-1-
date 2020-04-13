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
    <link rel="stylesheet" href="./styles/interfaceJoueur.css">
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
                    <div class="avatar">
                        <img src="Images/img-bg.jpg" alt="">
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
                              href='deconnexion.php'> Deconnexion</a>";
                     ?>
                    </div>
               </div>
            </div>
    </body>
</html>
