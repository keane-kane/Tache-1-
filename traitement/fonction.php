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
?>
