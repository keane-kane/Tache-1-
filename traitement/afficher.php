<?php
     $exist = getDatas($file = "liste_jscore");
    $quest = getDatas($file = "Question");
    $nbqts= getDatas($file = "parametre");
  
    // var_dump($exist);
    $j = $i = $lq = $k =$sorti= 0;
     $box=[];
    $reps= '';
    $question= [];
    $total_page=$nbqts[0]['nb-qts'];
   //tester si le joueur existe dans le fichier des questions dèjà repondues
    
    //tester si la question existe dans le fichier des questions dèjà repondues
    //sino on l'ajoute
     //var_dump($exist[0]);
    //echo $quest[$i]['question'],$_SESSION['user']['login'];
    if(isset($exist)){
        for($j = 0 ; $j< count($exist);$j++){
           if($_SESSION['user']['login']===@$exist[$j]['login']){
               $_SESSION['in_json']=$j;
       // echo $j,$exist[$j]['login'],$_SESSION['in_json'];
    }}}
    while (isset($quest[$i]) or $sorti ==1){
           
        if(isset( $_SESSION['in_json'])){
              if(!in_array($quest[$i]['question'],$exist[$_SESSION['in_json']]['question'])){
                  $question[$k]= $quest[$i];
                  $k++;
           }
        }else{$question[$k]= $quest[$i];$k++; }
       $i++;
        
       if($k>$total_page) $sorti =1;
        
    } 
//   echo '<pre>';
//   var_dump($exist);
//   var_dump($question);
?>
<?php  
     echo '<div><a id=btn-quitter onclick="return confirm(\'Vous voulez quitter le jeu maintenant ?\');" href="?page=joueur&game=fin" >Quitter le Jeu</a></div>';
    if(isset($question)){
        $_SESSION['c'] =$question;
        if(!isset($_SESSION['str'])){$_SESSION['str']=1;}
        if($_SESSION['str']==1){shuffle($question); $_SESSION['str']=2;}

        if(isset($_POST['suivant'])){  
            $_SESSION['q'][$_POST['suivant']] = $_POST;
            $_SESSION['i'] = $_POST['suivant']+1;
            $lq = $_SESSION['i'] ;
            
        }if(isset($_POST['precedent'])){
            $_SESSION['prec']=$_POST['precedent'];
            $_SESSION['i']=$_POST['precedent'];
            $lq = $_SESSION['i']; 
            $box =$_SESSION['q'][$lq];
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
                    if($question[$lq]['choix']=='choix_multis'){ ?>
                        <div class=div_aff>
                           <input type="checkbox" name="box_<?=$k; ?>" value="on_<?=$k ?>"  <?= isset($box['box_'.$k]) ?"checked":"";?>>
                           <span><?= $question[$lq]['reponse'][$k]?></span>
                        </div>
                   <?php }
                    if($question[$lq]['choix']=='choix_simple'){ ?>
                        <div class=div_aff>
                            <input type=radio name="on" value="on_<?=$k ?>" <?= isset($box['on']) ?"checked":"";?>>
                            <span><?= $question[$lq]['reponse'][$k]?></span>
                        </div>
                   <?php }
                    if($question[$lq]['choix']=='choix_text'){ ?>
                       <div class=div_aff>
                          <textarea name=reponse cols="35" rows="2"><?= isset($box['reponse']) ? $box['reponse'] : "";?></textarea><br>
                        </div>
                  <?php }
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
        <?php     }else   echo "<p class=div_fin_jeu>vou avez repondu a toutes les questions disponible<br>
                               <mark>appuyez sur quitter le jeu pour la correction</mark> Bravo </p>";
         }else echo "<p class=div_fin_jeu>Il parait qu'il n'y a plus de questions a repondre <br> 
                      <mark>A bientôt pour un autre quizz merci!</mark></p>";
         ?>