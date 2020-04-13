
<?php 
session_start();
$erreur_pw='';
$erreur_mail='';
$errorMessage='';
// mettre le contenu du fichier dans une variable
$file = "fichierJson\ListesAd_Jou.json";
$data = file_get_contents($file,true); 
// décoder le flux JSON
$tab = json_decode($data,true); 


//verification des champ et sorti des erreurs
    if(isset($_POST['submit']) ) 
    {
      $email=$_POST['email'];
      $mdp=$_POST['login'];

      if(empty($email))   $erreur_mail= 'Le champ email est obligatoire *';
      if(empty($mdp))   $erreur_pw= 'Le champ mot de passe est obligatoire *';

      // Les identifiants sont transmis ?
      if(!empty($email) && !empty($mdp)) 
      {   
          // Sont-ils les mêmes que les constantes ?
          foreach($tab as $cle=>$value) {
            
              if($email== $value['mail']  && $mdp == $value['login'] && $value['role']=="admin"){
                    $_SESSION['nom']= $value['nom'];
                    $_SESSION['prenom']=  $value['prenom'];
                    header('Location: interfaceAdmin.php');
              }
              elseif($email== $value['mail'] && $mdp == $value['login'] &&$value['role']=="player"){
                    $_SESSION['nom']= $value['nom'];
                    $_SESSION['prenom']=  $value['prenom'];
                    header('Location: interfaceJoueur.php');
              }
              // if($mdp !=$value['login']) $erreur_pw = 'Mauvais password !';
              // if($email != $value['mail']) $erreur_mail = 'Mauvais email !';
          
             else
                $errorMessage = "Votre mot de passe ou identifiants est incorrectes  
                                 !<br>Si vous êtes nouveau inscrivez-vous <a href=\"#\">Ici</a>";
                              
          }
    }
  }
        
  

?>
<!-----------------------------------fin code php -------------------->


<!-----------------------------------code html------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/authentification.css">
    <title>Authantification Admin</title>
</head>

  <body>
          <div class="plaisir">
                <p class="imageH" ></p>
                <h1 class="text jouer">Le plaisir de jouer</h1>
          </div>
          <div class="background fond">
            <div class="position">
                <?php
                // Rencontre-t-on une erreur de saisie?
                if(!empty($errorMessage)) {echo '<p class=erreurg>',$errorMessage,'</p>'; } ?>

                <div class="loginform"><p class="login form">Login Form</p><span class="close">x</span></div> 

                <div class="formulaire">
                  <form action="" name="admin" method="post">

                    <div class="div2">
                        <input class="inputF" placeholder="Login" type="email"  name="email">
                        <img src="Images\Icônes\ic-login.png" alt="">
                    </div>
                        <?php if(!empty($erreur_mail)){ echo '<span class=erreur>',$erreur_mail,'</span>';}?>
            
                    <div class="div2"> 
                        <input class="inputF" placeholder="password" type="password" name="login">
                        <img src="Images\Icônes\ic-password.png" alt="">
                    </div>
                        <?php if(!empty($erreur_pw)){ echo '<span class=erreur>',$erreur_pw,'</span>'; }?>

                    <div class="div3">
                        <input  class="inputS" type="submit" class="submit" name="submit" value="Connexion">
                        <p class="inscrire"><a href="inscri">S'inscrire pour jouer?</a></p>
                    </div>
                  </form>
               </div> 
            </div>
          </div>

  </body>
</html>
