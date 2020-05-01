<?php
  is_connect();
  $quest = getDatas($file = "Question");
//   shuffle($quest);
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
  $login = $_SESSION['user']['login'];
  $avatar  = $_SESSION['user']['image'];
//   var_dump($quest);
?>
            <div class="position-user">
                <div class="param-user">
                    <div class="avatar-user">
                        <img src="<?= !empty($avatar) ? $avatar:"Images/img-bg.jpg"?>" alt="">
                        <div class="nom-prenom-user">
                            <p class="prenom-user"><?= $nom; ?></p>
                            <p class="nom-user"> </p>
                        </div>
                    </div>
                    <p class="wellcome-user">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br>
                                          JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</p>
                    <div class="decon-user">
                            <?php
                                echo "<a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                                       href='index.php?status=logout'> Deconnexion</a>"; ?>
                    </div>
               </div>
               <div class="content">
                   <div class="content-quest">
                       <?php
                       $i= 0 ;
                       $lq = 0;
                         if(isset($quest)){
                            $parPage= 5;
                            $start= 0;
                          //  $total_page= ceil($total/$parPage); 
                            if(isset($_POST['game'])){ // Si la variable $_GET['page'] existe...
                              //echo $_GET['game'];
                             echo $_POST['lq'];
                              echo 'ok';
                                //  $pageCourant=intval($_GET['listequ']);   
            
                            //     if($pageCourant>$total_page){ // Si la valeur de $pageCourant (le numéro de la page) est plus grande que $total_page...
                            //         $pageCourant=$total_page;
                            //     }
                            // }else{ // Sinon
                            //     $pageCourant=1; // La page actuelle est la n°1    
                            } 
            
                            //$start= (($pageCourant-1)*$parPage);
                       ?>
                            <div class="_question">
                                <h3>Questions <?= $lq+1 ?>/5</h3>
                                <p><?= $quest[$i]['question'] ?></p>
                            </div>  
                            <p class="nbre-points"><?= $quest[$i]['nbPoint'] ?>pts</p>
                            <div class="_reponses">
                                <?php if($quest[$i]['choix'] == 'choix_multis'){ ?>
                                <div class="input-quest"><input type="checkbox" name="" id=""><span>HTML</span></div>
                                <div class="input-quest"><input type="checkbox" name="" id=""><span>R</span></div>
                                <div class="input-quest"><input type="checkbox" name="" id=""><span>JAVA</span></div>
                            
                                <?php  }elseif($quest[$i]['choix'] == 'choix_simple'){?>
                                <?php  }elseif($quest[$i]['choix'] == 'choix_text'){ echo 'ok texte';}?>
                            </div>
                        <?php } ?>
                        <div class="content-btn">
                        <?php
                    //pagination
                        $total_page= $pageCourant=0;
                            if($pageCourant>1){
                                $precedent=$pageCourant-1;
                                echo'<a class="btn-prec btn-prec-j" href="?page=joueur&game=lq">precedent</a>';  
                                  
                                    }  
                            if($pageCourant<=$total_page){
                                $suivant= $pageCourant;
                           //  echo'<a class="btn-suiv btn-suiv-j" href="?page=joueur&game=lq">suivant</a>';  
                              echo "<input type=submit name=game value='suivant'>"; 
                                echo "<input type=hidden name=lq value='$suivant'>"; 
                                    }else  
                                echo'<a class="btn-suiv btn-suiv-j" href="" >Terminer</a>';
                        ?> 
                      </div> 
                    </div>
                    <div class="top-score">
                        <ul>
                           <li><a href="">Top scores</a>
                               <div class="meilleur_5">
                                   <table class="liste-joueur">
                                      <?php 
                                         $i = 1;
                                         while($i<= 5){
                                            echo   "<tr><td>".$data[$i]['nom'] ,"  ",$data[$i]['prenom'].
                                                   "</td><td class=color".$i.">".$data[$i]['score']."</td></tr>";
                                            $i++;
                                         }
                                      ?>
                                    </table>
                               </div>
                            </li>
                            <li><a href=""> Mon meilleur score</a>
                                <div class="meilleur_1">     
                                    <table class="liste-joueur">
                                     <?= $data[$i]['nom']==$nom 
                                       ?  "<tr><td>".$data[$i]['nom']." ".$data[$i]['prenom'].
                                       "</td><td class=color".$i.">".$data[$i]['score']."</td></tr>" :"pas de score dispo";
                                     ?>
                                    </table>
                                </div>
                            </li>
                       </ul>
                    </div>
               </div>
            </div>
     
<script>
   
        document.querySelector('.btn-suv').addEventListener('click',function(e){
           alert('ok clic')
        })
        document.querySelector('.btn-prec').addEventListener('click',function(e){
            alert('ok3')
    })
</script>