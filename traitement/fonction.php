<?php 
//triage des scores
    $data = getDatas($file = "liste_jscore");
    $columns = array_column($data, 'score');
    array_multisort($columns, SORT_DESC, $data);

function connexion($login , $pwd){
    $users= getDatas();
    foreach($users as $key => $user){
        if($user['login']=== $login && $user['password']===$pwd){
            $_SESSION['user']= $user;
            $_SESSION['status']= "login";
            if($user['role']=== 'admin'){
                return "admin";
            }else //if($user['role']=== 'player')
            {
                return "joueur";
               }
        }
    }
    return "error";
}
function Test_login($login,$test= 'login'){
    $users= getDatas();
    foreach($users as $key => $user){
        if($user[$test]=== $login)
            return true;
        }
}
function Inscrire($nom, $prenom, $login, $mdp,$mdp_confirm,$file,$role,$file_json='fichierJson/ListesAd_Jou.json'){
    $data = file_get_contents($file_json);
    if(!$data or empty($data)){
        $new_users = [];
    }else
        $new_users= json_decode($data);
         
     // On ajoute le nouvel élement
     array_push( $new_users, [
         'role'     =>$role ,
         'nom'       => $nom,
         'prenom'    => $prenom,
         'login'     => $login,
         'password'  => $mdp,
         'passconfirm'=>$mdp_confirm,
         'image'        =>$file
       ]);
        // On réencode en JSON
        $new_users = json_encode($new_users); 
        // On stocke tout le JSON
        file_put_contents($file_json, $new_users);  
        return "Vos informations ont été enregistrées";
   }

   function ajouQuest($question, $nbPoint, array $reponses,$choix,array $correcte,$file_json='fichierJson/Question.json'){
    $data = file_get_contents($file_json);
    if(!$data or empty($data)){
        $new_users = [];
    }else
        $new_users= json_decode($data);    
     // On ajoute le nouvel élement
     array_push( $new_users, [
         'question'  =>$question ,
         'nbPoint'   => $nbPoint,
         'choix'     => $choix,
         'reponse'   => $reponses,
         'correcte'  => $correcte
       ]);
        // On réencode en JSON
        $new_users = json_encode($new_users);   
        // On stocke tout le JSON
        file_put_contents($file_json, $new_users);
        return "Votre question  a bien été enregistrée";
   }
 function is_connect(){
    if(!isset($_SESSION['status'])){
         header('location: index.php');
    }
}
 function deconnexion(){
    unset($_SESSION['user']);
    unset($_SESSION['status']);
    session_destroy();
 }
 function getDatas($file = 'ListesAd_Jou'){
        $data = file_get_contents("fichierJson/".$file.".json");
        $data = json_decode($data, true);
        return $data;
 }
 function test_input($data) {
    $data = addslashes(htmlentities($data));
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
 
  function deletes_espace_unitiles($phs){
    $i=0 ;
    $ph="";
    $pattern  = '%\s+%';
    $replacement = " ";
       //suprimer des espace de devant et de derrier
       $phs= delete_spc_before_after($phs);
  
      //supression des espaces multiples
      $phs= preg_replace($pattern,$replacement,$phs);
  
       //supression des espaces avant une pontuation  et/ou apres une apostrophe 
      while (!empty($phs[$i])) {
        if ($phs[$i]==" " && ($phs[$i+1]=="'" or Termine($phs[$i+1]))){
            $ph.= preg_replace($pattern,"",$phs[$i]);
  
        }elseif($phs[$i]==" " && $phs[$i-1]=="'"){
          // ne fait rien ndandite
        //  $ph.= preg_replace($pattern,"",$phs[$i+2]);
        }
         else $ph.=$phs[$i];
         $i++;
      }
      return $ph;
   }
   function delete_spc_before_after($chaine){
    $debut=0;
    $fin=strlen($chaine)-1;
    $newChaine = '';
       if($chaine==''){ return $chaine; }
      while ($chaine[$debut]==' '){
        $debut++; 
        if(!isset($chaine[$debut])){
            return '';
        } 
    }
  }
    function Termine($car){
        if($car =='.' or $car =='!' or $car =='?' ) return true;
        return false;
      }
?>
