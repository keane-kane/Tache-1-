<?php 
 $data = getDatas($file = "listeQuestion");
  

?>
    <div class="les-questions" id="les-questions">
        <div class="nb-quest"> 
            <span class="nb-q_jeu">Nombre de question/jeu</span>
            <input type="number" name="nb-qts">
            <input type="submit" name="submit-nb" value="OK">
        </div> 

        <div class="affichage-qt" id="affichage-qt">
           <?php  
//affichage 
            $pageCourant ='';
            $parPage='';
            if(isset($data))
            {
                $total=sizeof($data);
                $parPage= 5;
                $start= 0;
                $total_page= ceil($total/$parPage); 
                if(isset($_GET['listequ'])){ // Si la variable $_GET['page'] existe...
                    $pageCourant=intval($_GET['listequ']);    

                    if($pageCourant>$total_page){ // Si la valeur de $pageCourant (le numéro de la page) est plus grande que $total_page...
                        $pageCourant=$total_page;
                    }
                }else{ // Sinon
                    $pageCourant=1; // La page actuelle est la n°1    
                } 

                $start= (($pageCourant-1)*$parPage);
                // echo $start;
                //affichage de la liste des joueur
              
               // echo count($data[0]['reponse']);
                    for ($i=$start; $i <$start+$parPage; $i++) {
                     
                        for($j = $i ; $j<=$i ; $j++){
                            if(isset($data[$j])){
                                echo "<h3>".$data[$j]['numero']."  ".$data[$j]['question']."</h3>";
                                if($data[$j]['type']=='checbox'){
                                    for($k = 0; $k< count($data[$j]['reponse']);$k++){
                                        echo "<input type =checkbox >"."<span>".$data[$j]['reponse'][$k]."</span><br>";
                                    }
                                }elseif($data[$j]['type']=='radio'){
                                    for($k = 0; $k< count($data[$j]['reponse']);$k++){
                                        echo "<input type =radio >"."<span>".$data[$j]['reponse'][$k]."</span><br>";
                                    }
                                }else
                                echo "<textarea></textarea><br>";
                            }
                         }
                    
                   }
        ?>
        </div>
        <?php
//pagination
      echo "<div class=\"btn-suiv-prec-q\">";
        if($pageCourant>1){
            $precedent=$pageCourant-1;
            echo'<a class="btn-prec btn-prec-j" href="index.php?page=admin&listequ='.$precedent.'">precedent</a>';    
                }  
        if($pageCourant<$total_page){
            $suivant= $pageCourant+1;
             echo'<a class="btn-suiv btn-suiv-j" href="index.php?page=admin&listequ='.$suivant.'">suivant</a>';   
                }else   
             echo'<a class="btn-suiv btn-suiv-j" href="#" >suivant</a>';

     echo "</div>";
    }
    ?>    
    </div>
   