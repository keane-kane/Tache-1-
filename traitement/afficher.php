<?php
    $quest = getDatas($file = "Question");
    $nbqts= getDatas($file = "parametre");
    $exist = getDatas($file = "liste_jscore");
    
    $j = 0;
    $i = 0;
    $lq = 0;
    $reps= '';
    $question= [];
    $total_page=$nbqts[0]['nb-qts'];
    $_SESSION['in_json']=0;
   //tester si le joueur existe dans le fichier des questions dèjà repondues
   if(isset($exist)){
   foreach($exist as $value){ 
    if($_SESSION['user']['login']==$value['login']){
        $_SESSION['in_json']=1;
      }$j++;
    }}
    
    //tester si la question existe dans le fichier des questions dèjà repondues
    //sino on l'ajoute
     $sorti =0;
    while (isset($quest[$i]) !=null or $sorti =0){
        if($_SESSION['in_json'] ==0){
            $question[$i]= $quest[$i];
        }
        else{
            if(isset($exist[$i]['question'])){
                if(!in_array($quest[$i]['question'],$exist[$i]['question']))
                  $question[$i]= $quest[$i];
              }
        }
        if(count($question)>$total_page-1) $sorti =1;
        $i++;
    }
   // var_dump($question);
?>

<?php  
     echo '<div><a id=btn-quitter onclick="return confirm(\'Vous voulez quitter le jeu maintenant ?\');" href="?page=joueur&game=fin" >Quitter le Jeu</a></div>';
    if(!isset($question)){

            if(!isset($_SESSION['str'])){$_SESSION['str']=1;}
            if($_SESSION['str']==1){shuffle($question); $_SESSION['str']=2;}
            $_SESSION['c'] =$question;
           if(isset($_POST['suivant']))
           {  
            $_SESSION['q'][] = $_POST;
               $_SESSION['i'] = $_POST['suivant']+1;
                $lq = $_SESSION['i'] ;
              
           }if(isset($_POST['precedent'])){
                $_SESSION['i']=$_POST['precedent'];
                $lq = $_SESSION['i']; 
                unset($_SESSION['q'][$lq]); 
           }
           if(isset($_POST['suivant']) && $_POST['suivant']=="fin"){
                header('location: ?page=joueur&game=fin');
           }
          if(isset($question[$lq])){
    ?>
        <form action="" method="post">
            <div class="_question">
                <h3>Questions <?= $lq+1,"/",$total_page?></h3>
                <p>***<?= $question[$lq]['question'] ?>***</p>
                <input type="hidden" name="num_q" value="<?= $question[$lq]['question']; ?>" >
            </div>
            <p class="nbre-points"><?= $question[$lq]['nbPoint'] ?>pts
            <input type="hidden" name="score" value="<?= $question[$lq]['nbPoint'] ?>" >
            <input type="hidden" name="choix" value="<?= $question[$lq]['choix'] ?>" >
            </p>
            <?php
                 for($k = 0; $k<count($question[$lq]['reponse']);$k++){
                    if($question[$lq]['choix']=='choix_multis'){
                        
                       echo "<div class=div_aff><input type=checkbox name=box_$k value=on_$k><span>".$question[$lq]['reponse'][$k]."</span></div>";
                    }
                    if($question[$lq]['choix']=='choix_simple'){
                        echo "<div class=div_aff><input type=radio name=on value=on_$k >"."<span>".$question[$lq]['reponse'][$k]."</span></div>";
                    }
                    if($question[$lq]['choix']=='choix_text')
                      echo "<div class=div_aff><textarea name=reponse cols=\"35\" rows=\"2\"></textarea><br></div>";
                }
   
            ?>

            <div class="content-btn">
                <?php
                if($lq>0){
                    $precedent=$lq-1;
                    echo'<button type=submit class="btn-prec btn-suiv-j" name=precedent value='.$precedent.'>Precedent</button>';    
                        }  
                if($lq<$total_page-1){
                    $suivant= $lq;
                    echo '<button type=submit class="btn-suiv btn-suiv-j" name=suivant value='.$suivant.'>Suivant</button>';   
                        }else   
                   echo'<button class="btn-suiv btn-suiv-j"  name=suivant  value=fin >Terminer</button>';
                ?>
            </div>
        </form>
        <?php      }else   echo "<p class=div_fin_jeu>vou avez repondu a toutes les questions disponible<br> Bravo"
                                     .$_SESSION['user']['nom']," ",$_SESSION['user']['prenom']."</p>";
         }else echo "<p class=div_fin_jeu>Il parait qu'il n'y a plus de questions a repondre <br> 
                    A bientôt pour un autre quizz merci!</p>";
         ?>