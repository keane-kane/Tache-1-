<?php
  is_connect();
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
 
?>
   
            <div class="position-user">
                <div class="param-user">
                    <div class="avatar-user">
                        <img src="Images/img-bg.jpg" alt="">
                        <div class="nom-prenom-user">
                            <p class="prenom-user"><?= $prenom; ?></p>
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
                      <div class="_question">
                          <h3>Questions 1/5</h3>
                          <p>Les langages Web</p>
                      </div>  
                      <p class="nbre-points">3pts</p>
                      <div class="_reponses">
                          <div class="input-quest"><input type="checkbox" name="" id=""><span>HTML</span></div>
                          <div class="input-quest"><input type="checkbox" name="" id=""><span>R</span></div>
                          <div class="input-quest"><input type="checkbox" name="" id=""><span>JAVA</span></div>
                      </div>
                      <div class="content-btn">
                          <button id="precedent" type="submit">Précédent</button>
                          <button id="suivant" type="submit">Suivant</button>
                      </div>
                   </div>
                   <div class="top-score">
                   <table class="liste-joueur">
                        <tr><th class="top">Top scores</th><th class="meilleur">Mon meilleur score</th></tr>
                        <tr><td>Ibou DIATTA</td><td class="color1">1022 pts</td></tr>
                        <tr><td>Aly NIANG</td><td class="color2">963 pts</td></tr>
                        <tr><td>Saliou MBAYE</td><td class="color3">877 pts</td></tr>
                        <tr><td>Khady DIOUF</td><td class="color4">875 pts</td></tr>
                        <tr><td>Moussa SOW</td><td class="color5">870 pts</td></tr>
                   </table>
                   </div>
               </div>
            </div>
     
