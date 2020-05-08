<!-----------------------------------code html------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/authentification.css">
    <title>index</title>
</head>

  <body>
          <div class="plaisir">
                <p class="imageH" ></p>
                <h1 class="text jouer">Le plaisir de jouer</h1>
          </div>
          <div class="background fond">
     <?php
     
     session_start();
     require_once('traitement/fonction.php');

    if(isset($_GET['page'])){
        if($_GET['page']=='admin'){
            require_once('interfaceAdmin.php');
        }elseif($_GET['page']=='joueur'){
            require_once('interfaceJoueur.php');
        }
    }else{
        if(isset($_GET['status']) && $_GET['status']==="logout"){
            deconnexion();
        }
        if(isset($_GET['lien']) && $_GET['lien']==="inscri"){
            require_once('traitement/Inscription.php');
        }
         else require_once('authantification.php');
    }
     ?>
 </div>
  </body>
</html>