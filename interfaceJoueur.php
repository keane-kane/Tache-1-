<?php
  is_connect();
  $data = getDatas($file = "liste_jscore");
  $columns = array_column($data, 'score');
  array_multisort($columns, SORT_DESC, $data);
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
  $login = $_SESSION['user']['login'];
  $avatar  = $_SESSION['user']['image'];
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
                         if(isset($_GET['page']) && ($_GET['page']) =="joueur" && !isset($_GET['game']))
                             echo '<a class="btn-suiv btn-dabut" href="?page=joueur&game=debut" >Demarer </a>';

                        if(isset($_GET['game']) && ($_GET['game']) =="debut")
                              require_once("traitement/afficher.php"); 
                         if(isset($_GET['game']) && ($_GET['game']) =="fin")
                              require_once("traitement/correction.php");   
                        ?>
                     </div>
                    <div class="top-score">
                        <ul>
                           <li><a href="">Top scores</a>
                               <div class="meilleur_5">
                                   <table class="liste-joueur">
                                      <?php 
                                         $i = 1;
                                         while($i<= 3){
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
                                     <?= $data[0]['nom']==$nom 
                                       ?  "<tr><td>".$data[0]['nom']." ".$data[0]['prenom'].
                                       "</td><td class=color".$i.">".$data[0]['score']."</td></tr>" :"pas de score dispo";
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