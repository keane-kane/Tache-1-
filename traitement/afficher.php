<?php
    $quest = getDatas($file = "Question");
    $nbqts= getDatas($file = "parametre");
    $exist = getDatas($file = "liste_jscore");
    // echo $exist[1]['login'];
    $question= [];
    //echo count($question);
    $j = 0;
    $lq = 0;
    $total_page=$nbqts[0]['nb-qts'];
    do{
        if( $_SESSION['user']['login']!==$exist[$j]['login']){
            foreach($exist[$j]['question'] as $value){  
               if($quest[$j]['question'] !=$value){
                 $question[$j]= $quest[$j];
                }
            }
        }else  $_SESSION['in_json']=true;
        $j++;
    } while (count($question)<$total_page &&isset($exist[$j]))
   
?>
<?php  
    if(!isset($question) ){
            if(!isset($_SESSION['str'])){$_SESSION['str']=1;}
            if($_SESSION['str']==1){shuffle($question); $_SESSION['str']=2;}
            $_SESSION['c'] =$question;
           if(isset($_POST['suivant']))
           {  
            
            $_SESSION['q'][] = $_POST;
               $_SESSION['i'] = $_POST['suivant']+1;
                $lq = $_SESSION['i'] ;
              
           }if(isset($_POST['precedent'])){
               unset($_SESSION['q'][$lq]);
                $_SESSION['i']=$_POST['precedent'];
                $lq = $_SESSION['i'];  
           }
           if(isset($_POST['suivant']) && $_POST['suivant']=="fin"){
                header('location: ?page=joueur&game=fin');
           }
   
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
                       echo "<div><input type=checkbox name=box_$k value=on_$k ><span>".$question[$lq]['reponse'][$k]."</span></div>";
                    }
                    if($question[$lq]['choix']=='choix_simple'){
                        echo "<div><input type=radio name=on value=on_$k >"."<span>".$question[$lq]['reponse'][$k]."</span></div>";
                    }
                    if($question[$lq]['choix']=='choix_text')
                      echo "<div><textarea name=reponse cols=\"35\" rows=\"2\">".$question[$lq]['reponse'][$k]."</textarea><br></div>";
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
        <?php } ?>