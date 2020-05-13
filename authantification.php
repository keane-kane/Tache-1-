
<?php 
$errorMessage='';

//verification des champ et sorti des erreurs
    if(isset($_POST['submit']) ) 
    {
      $email=$_POST['email'];
      $mdp=$_POST['login'];
       $result= connexion($email, $mdp);

      // Les identifiants sont transmis ?
       if($result == 'error'){
              $errorMessage = "Votre mot de passe ou identifiants est incorrectes  
                              !<br>Si vous êtes nouveau inscrivez-vous <a href=\"index.php?lien=inscri\">Ici</a>";
          }else{
             header("location: index.php?page=".$result);
          }     
    }
?>
<!-----------------------------------fin code php -------------------->

            <div class="position">
            <?php
                // Rencontre-t-on une erreur de saisie?
                if(!empty($errorMessage)) {echo '<p class=erreurg>',$errorMessage,'</p>'; } ?>

                <div class="loginform"><p class="login form">Login Form</p><span class="close">x</span></div>
                <div class="formulaire">
                  <form action="" name="admin" method="post" id="connexion-form">
                    <div class="div2">
                        <input class="inputF" error="error-1" placeholder="Login" type="text"  name="email">
                        <img src="Images/ic-login.png" alt="">
                    </div>
                    <span class="erreur" id="error-1"></span>
                    <div class="div2"> 
                        <input class="inputF" error="error-2" placeholder="password" type="password" name="login">
                        <img src="Images/ic-password.png" alt="">
                    </div>
                    <span class="erreur" id="error-2"></span>
                    <div class="div3">
                        <input  class="inputS" type="submit" class="submit" name="submit" value="Connexion">
                        <p class="inscrire"><a href="index.php?lien=inscri">S'inscrire pour jouer?</a></p>
                    </div>
                  </form>
               </div> 
            </div>
        
<script>

    const inputs = document.getElementsByTagName('input');
        for(input of inputs){
          input.addEventListener('keyup', function(e){
            if(e.target.hasAttribute('error')){
              var idSpanError = e.target.getAttribute('error');
              document.getElementById(idSpanError).innerText = "";
            }
          })
        }
        
    document.getElementById("connexion-form").addEventListener('submit',function(e){
        const inputs = document.getElementsByTagName('input');
        var error=false;
              for(input of inputs){
                  if(input.hasAttribute("error")){
                     var idSpanError = input.getAttribute("error");
                     if(!input.value){
                       document.getElementById(idSpanError).innerText = "Ce champ est obligatoire";
                       error = true;
                     }
                }
              }
              if(error){
                e.preventDefault();
                return 0;
              }
     })
</script> 
