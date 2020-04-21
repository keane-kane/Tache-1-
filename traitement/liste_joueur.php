
<?php 
    $data = getDatas($file = "liste_jscore");
    $columns = array_column($data, 'score');
    array_multisort($columns, SORT_DESC, $data);
?>

<div class="liste-joueur" id="liste-joueur">
        <h3>LISTE DES JOUEURS PAR SCORE</h3>
        <table class="affichage-table">
            <tr><td>Prenom</td><td>nom</td><td>score</td></tr>
          <?php  
            $pageCourant ='';
            $parPage='';
            if(isset($data))
            {
                $total=sizeof($data);
                $parPage= 15;
                $start= 0;
                $total_page= ceil($total/$parPage); 
                if(isset($_GET['listej'])){ // Si la variable $_GET['page'] existe...
                    $pageCourant=intval($_GET['listej']);    

                    if($pageCourant>$total_page){ // Si la valeur de $pageCourant (le numéro de la page) est plus grande que $total_page...
                        $pageCourant=$total_page;
                    }
                }else{ // Sinon
                    $pageCourant=1; // La page actuelle est la n°1    
                } 

                $start= (($pageCourant-1)*$parPage);
               // echo $start;
                //affichage de la liste des joueur
              
                   //echo $data[1]['prenom'];
                    for ($i=$start; $i <$start+$parPage-1 ; $i++) {
                      echo "<tr>";
                        for($j = $i ; $j<=$i ; $j++){
                            if(isset($data[$j])){
                                echo '<td>'.$data[$j]['prenom'].'</td>';
                                echo '<td>'.$data[$j]['nom'].'</td>';
                                echo '<td>'.$data[$j]['score'].'</td>';
                            }
                         }
                      echo "</tr>"; 
                   }
        ?>
        </table>
      <?php
//pagination
      echo "<div class=\"btn-suiv-prec-j\">";
        if($pageCourant>1){
            $precedent=$pageCourant-1;
            echo'<a class="btn-prec btn-prec-j" href="index.php?page=admin&listej='.$precedent.'">precedent</a>';    
                }  
        if($pageCourant<$total_page){
            $suivant= $pageCourant+1;
             echo'<a class="btn-suiv btn-suiv-j" href="index.php?page=admin&listej='.$suivant.'">suivant</a>';   
                }else   
             echo'<a class="btn-suiv btn-suiv-j" href="#" >suivant</a>';

    echo "</div>";
    }
    ?>

</div>

        <!-- <div class="btn-suiv-prec-j">
            <button class="btn-prec btn-prec-j" >Précédent</button>
            <button class="btn-suiv btn-suiv-j">Suivant</button>
        </div> -->
   