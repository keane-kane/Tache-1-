<?php
  is_connect();
  $nom = $_SESSION['user']['nom'];
  $prenom = $_SESSION['user']['prenom'];
  $avatar  = $_SESSION['user']['image'];
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
                                <img src="<?= !empty($avatar) ? $avatar:"Images/img-bg.jpg"?>" alt="">
                                <div class="nom-prenom-Admin">
                                    <p class="prenomAdmin"><?= $prenom; ?></p>
                                    <p class="nomAdmin"> <?= $nom; ?></p>
                                </div>
                            </div>
                            <div class="tableau-bord-Admin" >
                                <div class="liste question"><a href="index.php?page=admin&menu=listequestion">Liste Questions<img src="Images\Icônes\ic-liste.png"/></a> </div>
                                <div class="liste creerAdmin"><a href="index.php?page=admin&menu=creeradmin">Créer Admin<img src="Images\Icônes\ic-ajout.png"/></a></div>
                                <div class="liste joueurs" ><a href="index.php?page=admin&menu=listejoueur">Listes joueurs<img src="Images\Icônes\ic-liste.png"/></a></div>
                                <div class="liste creerquestions"><a href="index.php?page=admin&menu=creerquestion">Créer Questions <img src="Images\Icônes\ic-ajout.png"/></a></div>
                                <div class="liste tableaudebord"><a href="index.php?page=admin&menu=tableaudebord">Tableau de Bord <img src="Images\Icônes\ic-liste.png"/></a></div> 
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

                                }elseif($_GET['menu']=='tableaudebord'){
                                    require_once('traitement/tableaudebord.php');
                                }
                            }
                            if(empty($_GET['menu'])) require_once('traitement/liste_joueur.php');
                            
                            //if(!empty($_GET['listej'])) require_once('traitement/liste_joueur.php');
                          // elseif(!empty($_GET['listequ'])) require_once('traitement/liste_question.php');
                            ?>  
                        </div>
                    </div>
                </div>
            </div>
            
<script>
       function active(t){
            t.style.borderLeft="5px solid  rgb(10, 116, 28)";
            t.style.backgroundColor="rgb(205, 204, 226)";
            t.style.width = 98+"%";
            return t;
          }
    
        var page = "<?= $_GET['menu'] ?>";
       
        if(page == "listejoueur"){
             var pj =document.querySelector('.joueurs')
             document.querySelector('.joueurs img').src="Images/Icônes/ic-liste-active.png"
             active(pj)
        }
        if(page== "listequestion"){
             var pj =document.querySelector('.question')
             document.querySelector('.question img').src="Images/Icônes/ic-liste-active.png"
             active(pj)
        }
        if(page== "creerquestion"){
             var pj =document.querySelector('.creerquestions')
             document.querySelector('.creerquestions img').src="Images/Icônes/ic-ajout-active.png"
             active(pj)
        }
        if(page== "creeradmin"){
             var pj =document.querySelector('.creerAdmin')
             document.querySelector('.creerAdmin img').src="Images/Icônes/ic-ajout-active.png"
            document.querySelector('.niveau-admin').innerHTML= "Pour proposer des quizz"
             active(pj)
        } 
</script>