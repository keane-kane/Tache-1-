<?php 
  // is_connect();
//var_dump($erreur);
$nom ="";
$prenom="";
$login="";
$role ="";
$mdp="";
$mdp_confirm="";
$file="";
$erreur="";
$stock_img = "Images/";
$charger = 1;
$erreurs ="";
$taille= "";
$results="";
$imageFileType="";
$pattern_nom_prenom = "/^([a-zA-ZÀ-ÿ]+([- ']?[a-zA-ZÀ-ÿ]+)*){3,30}$/";
$patern_mail= " /^.+@.+\.[a-zA-Z]{2,}$/ ";

    if(isset($_POST['inscrire'] )){
      
        $nom =$_POST['nom'];
        $prenom=$_POST['prenom'];
        $login=$_POST['login'];
        $mdp=$_POST['password'];
        $mdp_confirm=$_POST['pwd_confirm'];
        $erreur ="";
        //teste et validite de la saisie
         if(!preg_match($pattern_nom_prenom, test_input($nom))&& isset($nom)){
             $erreur['nom']= "le nom est incorrect";

         }else $erreur['nom']= "";
         if(!preg_match($pattern_nom_prenom, test_input($prenom)) && isset($prenom)){
            $erreur['prenom']= "le prenom est incorrect";
        }
        if(preg_match($pattern_nom_prenom, test_input($login)) && isset($login)){
            if(Test_login($login))
              $erreur['login']= "login existe deja";
        }else 
            $erreur['login']= "le login est incorrect";

        if(strlen($mdp)<8 && isset($mdp)){
            $erreur['mdp']= "Au moins 8 caractere";
        }
        if($mdp !== $mdp_confirm){
            $erreur['mdp_con']= "les mot de passe est different";
        }
        //$resule = Teste_Image();

       //teste de limage 
       
           if(isset($_FILES['imgAvatar']) && empty($_FILES['imgAvatar']['error'])){
            
               $target_file = basename($_FILES['imgAvatar']['name']);
               $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
               //si fichier n'est pas une image
               $check = @getimagesize($_FILES["imgAvatar"]["tmp_name"]);
               //la taille de l'image
               $taille = filesize($_FILES["imgAvatar"]["tmp_name"]);
   
                   if($taille > 10000){
                       $erreurs= "le fichier est trop lourd";
                       $charger = 0;
                   }elseif(!empty($imageFileType) && $imageFileType != "jpg" && $imageFileType != "png"){
                       $erreurs= "Seul les fichier .jpg ou .png sont permis";
                       $charger = 0;
                   }elseif(file_exists($stock_img.$target_file)){
                       $erreurs= "Le fichier existe deja";
                       $charger = 0;
                   }
                   elseif($check === false) {
                       $erreurs= "le fichier doit etre une image";
                       $charger =0;
                   }
               if($charger == 1 && empty($erreurs) && empty($erreur)){ 
                
                //teste si un admin ou joueur
                if(strpos($_SERVER['QUERY_STRING'], "admin") !== false){
                     $role = "admin";
                } elseif(strpos($_SERVER['QUERY_STRING'], "inscri") !== false){
                    $role = "joueur";}

                 if(move_uploaded_file($_FILES["imgAvatar"]["tmp_name"],$stock_img.$target_file)){
                     $file = $stock_img.$target_file; 
                     //le role  du user est definit par defaut a "joueur"
                     //un admin peux le definir a "admin" sil doit creer son homologue
                     $results = Inscrire($nom, $prenom, $login,$mdp, $mdp_confirm,$file,$role);
                     $result= connexion($login, $mdp);
                     if($result == 'error'){
                        $errorMessage = "Votre mot de passe ou identifiants est incorrectes  
                                      !<br>Si vous êtes nouveau inscrivez-vous <a href=\"#\">Ici</a>";
                     }else{
                        header("location: index.php?page=".$result);
                      }     
                  }
                  }else $erreurs= "Erreur de telechargement";
              }
           }
 
 //  var_dump($users= getDatas());
 //var_dump($erreur);
 if(!empty($results))
 echo '<script>alert("$results")</script>';
?>
             
  <div class="contentgeneral adapter">
        <div class="div1">
            <div>
                <h1 class="b">S'INSCRIRE</h1>
                <p class="niveau niveau-admin">Pour tester votre niveau de culture générale</p>
                <hr>
            </div>
            <form class="formlogin inscr_admin" method="post"  id="inscrire-form" enctype="multipart/form-data">
                <label class="p1 label1"> Prénom </label>
                <span class="err-span2" id="error-1"><?= !empty($erreur['prenom']) ? $erreur['prenom']: "" ?></span>
                <input class="input1" type="text" error="error-1" name="prenom" value="<?= !empty($prenom) ? $prenom : "" ?>" placeholder="Aaaaa">

                <label class="p1 label1" > Nom </label>
                <span class="err-span2" id="error-2"><?= !empty($erreur['nom']) ? $erreur['nom']: "" ?></span>
                <input class="input1" type="text" error="error-2" name="nom" value="<?= !empty($nom) ? $nom : "" ?>" placeholder="BBBB">

                <label class="p1 label1"> Login </label>
                <span class="err-span2" id="error-3"><?= !empty($erreur['login']) ? $erreur['login']: "" ?></span>
                <input class="input1" type="text" error="error-3" name="login" value="<?= !empty($login) ? $login : "" ?>" placeholder="aaBaaB">

                <label class="p1 label1"> Password </label>
                <span class="err-span2" id="error-4"><?= !empty($erreur['mdp']) ? $erreur['mdp']: "" ?></span>
                <input class="input1" type="Password" error="error-4" name="password" value="<?= !empty($mdp) ? $mdp : "" ?>" placeholder="...........">

                <label class="p1 label1">Confirmer Password </label>
                <span class="err-span2" id="error-5"><?= !empty($erreur['mdp_con']) ? $erreur['mdp_con']: "" ?></span>
                <input class="input1" type="Password"  error="error-5" name="pwd_confirm" value="<?= !empty($mdp_confirm) ? $mdp_confirm : "" ?>" placeholder="...........">
                <span class="err-span2" id="error-1"></span>
                <br>
                <label class="divavtar">Avatar</label>
                <input type="file" name="imgAvatar" id="imgAvatar"  >
                <span class="err-span2-f"><?= !empty($erreurs) ? $erreurs: "" ?></span>
                <input class="input7" type="submit" name="inscrire" value="Créer compte">
            </form>
        </div>
        <div class="imageavatar">
                <img src="<?= !empty($file) ? $file: "Images/img-bg.jpg" ?>" alt="">
                <p class="avjoueur">Avatar du joueur</p>          
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
    
document.getElementById("inscrire-form").addEventListener('submit',function(e){
    const inputs = document.getElementsByTagName('input');
    var error=false;
          for(input of inputs){
              if(input.hasAttribute("error")){
                 var idSpanError = input.getAttribute("error");
                 if(!input.value){
                  document.getElementById(idSpanError).innerText = "Champ *";
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

