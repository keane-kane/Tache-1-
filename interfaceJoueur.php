<?php
  is_connect();
  $data = getDatas($file = "liste_jscore");
  $columns = @array_column($data, 'score');
  @array_multisort($columns, SORT_DESC, $data);
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
                            <span class="prenom-user"><?= $prenom; ?></span>
                            <span class="nom-user"><?= $nom; ?></span>
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
                             echo '<a class=" btn-dabut" href="?page=joueur&game=debut" >Demarrer </a>';

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
                                         $i = 0;
                                         while($i<5){
                                             if(isset($data[$i]['nom']) && isset($data[$i]['prenom'])){
                                                  echo   "<tr><td>".$data[$i]['nom'] ,"  ",$data[$i]['prenom'].
                                                         "</td><td class=color".($i+1).">".$data[$i]['score']."</td></tr>";
                                             }else echo "<p>pas de joueur dispo</p>";
                                             $i++;
                                         }
                                      ?>
                                    </table>
                               </div>
                            </li>
                            <li><a href=""> Mon meilleur score</a>
                                <div class="meilleur_1">     
                                    <table class="liste-joueur">
                                     <?php $i = 0; while($i<5){
                                         if(isset($data[$i]['nom']) && isset($data[$i]['prenom']) && ($data[$i]['login'] == $login)){
                                           echo "<tr><td>".$data[$i]['nom']." ".$data[$i]['prenom'].
                                                  "</td><td style =\"background:yellow;\" >".$data[$i]['score']."</td></tr>";
                                          } $i++;
                                          if($i>5) echo "<p>pas de joueur dispo</p>";  } ?>
                                    </table>
                                </div>
                            </li>
                       </ul>
                    </div>
               </div>
            </div>
     