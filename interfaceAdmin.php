<?php
  is_connect();
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
  
?>
            <div class="inter-Admin">
                <div class="quizz">
                    <div class="param-admin">
                        <p class="adminquizz">CR&#201;ER ET PARAM&#201;TRE VOS QUIZZ</p>
                        <span class="decon-Admin">
                            <?php
                                echo "<a onclick=\"return confirm('Vous souhaitez quitter votre session ?');\" 
                                    href='index.php?status=logout'> Deconnexion</a>"; ?>
                        </span>
                    </div>
                    <div class="content-2">
                  
                    <div class="partieAdmin">
                            <div class="admin-avatar">
                                <img src="Images/img-bg.jpg" alt="">
                                <div class="nom-prenom-Admin">
                                    <p class="prenomAdmin"><?= $prenom; ?></p>
                                    <p class="nomAdmin"> <?= $nom; ?></p>
                                </div>
                            </div>
                            <div class="tableau-bord-Admin" >
                                <div class="liste question"><a href="index.php?page=admin&menu=listequestion">Liste Questions <img src="Images\Icônes\ic-liste.png"/></a> </div>
                                <div class="liste creerAdmin"><a href="index.php?page=admin&menu=creeradmin">Créer Admin<img src="Images\Icônes\ic-ajout.png"/></a></div>
                                <div class="liste joueurs" ><a href="index.php?page=admin&menu=listejoueur">Listes joueurs<img src="Images\Icônes\ic-liste.png"/></a></div>
                                <div class="liste creerquestions"><a href="index.php?page=admin&menu=creerquestion">Créer Questions<img src="Images\Icônes\ic-ajout.png"/></a></div>
                            </div>
                        </div>
                        <div class="affichage" id="affichage">   
                            <?php 
                            
                             if(isset($_GET['menu'])){
                                if($_GET['menu']=='listequestion'){
                                    require_once('traitement/liste_question.php');

                                }elseif($_GET['menu']=='creeradmin'){
                                    require_once('traitement/Inscription.php');

                                }elseif($_GET['menu']=='listejoueur'){
                                    require_once('traitement/liste_joueur.php');

                                }elseif($_GET['menu']=='creerquestion'){
                                    require_once('traitement/creer_question.php');
                                }
                            }
                            if(empty($_GET['menu'])) require_once('traitement/liste_joueur.php');
                            ?>  
                        </div>
                    </div>
                </div>
            </div>
            
