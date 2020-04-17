<?php 
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

?>
