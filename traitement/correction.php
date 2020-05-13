
<?php  
         echo '<a id=btn-quitter href="?page=joueur" >Recommencer</a>';
           //triage des scores
           $nbqts= getDatas($file = "parametre");
           $score=0;
           $i=0;
           $q_exect=[];
           //echo "<pre>";
         // var_dump( $_SESSION["c"]);
    if(isset($_SESSION['q'])&& isset($_SESSION['c'])){
        $quest = $_SESSION["q"];
        $question = $_SESSION["c"];
        for($i= 0 ; $i<$nbqts[0]['nb-qts']; $i++){
          $bon= true;
          $pas_reps = 0;

          if(isset($question[$i]['correcte'])){
              $q= $question[$i]['correcte'];

            if(isset($quest[$i])){  
        
            echo "<div><h3 class=lq_correct>".($i+1)." ".$quest[$i]['num_q']."</h3></div>";
            
            if($quest[$i]['choix']=='choix_multis'){
              echo "<pre>";
                for($k = 0; $k<count($q); $k++){
                    if(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]==$question[$i]['correcte'][$k]){
                      echo "<div class=div_correct>vrai<input type =checkbox name=box_$k checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                      $pas_reps = 1;
                    }
                    elseif(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]!=$question[$i]['correcte'][$k]){
                        $bon= false;
                        $pas_reps = 0;
                        echo "<div class=div_correct>faux<input type=checkbox name=box_$k  checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                    }else 
                        echo "<div class=div_correct>cool<input type=checkbox name=box_$k >"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                 }
                 echo "</pre>";
            }
            
            if($quest[$i]['choix']=='choix_simple'){
              echo "<pre>";
                for($k = 0; $k<count($q); $k++){
                    if(isset($quest[$i]['on']) && $quest[$i]['on']===$question[$i]['correcte'][$k]){
                      echo "<div class=div_correct>vrai<input type=radio name=box_$i checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                      $pas_reps = 1;
                    }
                    elseif(isset($quest[$i]['on']) && $quest[$i]['on']!=$question[$i]['correcte'][$k]){
                        $bon= false;
                        $pas_reps = 0;
                        echo "<div class=div_correct>faux<input type=radio name=box_$i  checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                    }else 
                        echo "<div class=div_correct>cool<input type=radio name=box_$i >"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                 }
                 echo "</pre>";
            }
           
          if($quest[$i]['choix']=='choix_text'){
                if(isset($quest[$i]['reponse']) && $quest[$i]['reponse']==$question[$i]['correcte'][0]){
                   echo "<div class=div_correct>vrai<textarea disabled>".$question[$i]['reponse'][0]."</textarea><br></div>";
                   $pas_reps = 1;
                }else{
                  $bon = false; 
                  echo "<div class=div_correct><textarea disabled>".$question[$i]['correcte'][0]."</textarea><br></div>";
                } 
          }
       }else $bon = false;
       if($bon==false or $pas_reps == 0){
           echo "<pre><span style=\"color:red;left:3em; \">Reponse fausse </span></pre>";
       }elseif($bon==true && $pas_reps == 1){
           $score  += $quest[$i]['score'];
           $q_exect[] = $quest[$i]['num_q'];
       }
      }
    }
    //unset($_SESSION['ajout']);
    if(!isset($_SESSION['ajout'])){$_SESSION['ajout']=1;}
    if($_SESSION['ajout']==1){
     $data = file_get_contents('fichierJson/liste_jscore.json');
       if(!$data or empty($data)){ $new_users =[];
      }else $new_users= json_decode($data,true); 
       echo "<pre>";
       
        if(isset($_SESSION['in_json']) ==0 && isset($q_exect)){
         array_push($new_users,[
              'prenom'   => $_SESSION['user']['prenom'],
                'nom'      =>$_SESSION['user']['nom'],
                'score'    => $score,
                'login'    => $_SESSION['user']['login'],
                'question' => $q_exect,
          ]);
        }elseif(isset($_SESSION['in_json'])==1 && isset($q_exect)){
          $k =$_SESSION['in_json'];
          $new_users[$k]['score']+= $score;
          foreach($q_exect as $value)
            array_push($new_users[$k]['question'],$value);
      }
      $new_users = json_encode($new_users);
      file_put_contents('fichierJson/liste_jscore.json', $new_users);
       $_SESSION['ajout']=2;}

    echo "<p style=\"text-align:center; background:yellow;\">"."Votre score est de ".$score." pts</p>";
  
    }else{
      echo "<p class=div_fin_jeu>Vous n'avez repondu a aucune question <br> 
            voulez vous recommencer une nouvelle partie</p>";
       }
    

  ?>