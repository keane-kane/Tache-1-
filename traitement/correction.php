
     <div class="les-question" id="les-questions">
        <div class="affichage-q" id="affichage-qt"> 
           <?php  
           //triage des scores
           $nbqts= getDatas($file = "parametre");

           $score=0;
           $bon= true;
           $i=0;
           $q_exect=[];
           $quest = $_SESSION["q"];
           $question = $_SESSION["c"];
           echo "<pre>";
           //echo $quest[$i]['box_0'][5];
       //print_r( $question ['correcte']);
      
           
      for($i= 0 ; $i<$nbqts[0]['nb-qts']; $i++){
          $q= $question[$i]['correcte'];
          
        if(isset($quest[$i])){
            echo "<h3 class=lq_h3>".($i+1)." ".$quest[$i]['num_q']."</h3>";
            if($quest[$i]['choix']=='choix_multis'){
                for($k = 0; $k<count($q); $k++){
                    if(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]===$question [$i]['correcte'][$k]){
                      echo "<div>vrai<input type =checkbox name=box_$k checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                      $bon= true;
                    }
                    elseif(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]!==$question [$i]['correcte'][$k]){
                        $bon= false;
                      echo "<div>faux<input type =checkbox name=box_$k  checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                    }else  echo "<div>cool<input type =checkbox name=box_$k >"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                 }
            }
            if($quest[$i]['choix']=='choix_simple'){
              for($k = 0; $k<count($q); $k++){
                  if(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]===$question [$i]['correcte'][$k]){
                    echo "<div>vrai<input type =radio name=on checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                    $bon= true;
                  }
                    elseif(isset($quest[$i]['box_'.$k]) && $quest[$i]['box_'.$k]===$question [$i]['correcte'][$k]){
                      $bon= true;
                      echo "<div>vrai<input type =radio name=on  checked>"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                    }
                   else { 
                     echo "<div>faux<input type =radio name=on >"."<span>".$question[$i]['reponse'][$k]."</span></div>";
                     $bon= false;
                    }
              }
          }
          if($quest[$i]['choix']=='choix_text'){
                if(isset($quest[$i]['reponse']) && $quest[$i]['reponse']===$question[$i]['correcte'][0])
                   echo "<div>vrai<textarea disabled>".$question[$i]['reponse'][0]."</textarea><br></div>";
                else{
                  $bon = false; 
                  echo "<div><textarea disabled>".$question[$i]['correcte'][0]."</textarea><br></div>";
                } 
          }
       }else $bon = false;
       if(!$bon ){
         $score=+$quest[$i]['choix'];
        $q_exect = $quest[$i]['num_q'];
         echo "question fuasse";
       }
     
    }
   if(!isset($_SESSION['in_json']) && isset($q_exect)){
    $data = file_get_contents('fichierJson/liste_jscore.json');
      if(!$data or empty($data)){ $new_users =[];
      }else $new_users= json_decode($data); 
       array_push( $new_users,[
            'prenom'   => $_SESSION['user']['prenom'],
            'nom'      =>$_SESSION['user']['nom'],
            'score'    => $score,
            'login'    => $_SESSION['user']['login'],
            'question' => $q_exect,
         ]);
          $new_users = json_encode($new_users);   
          file_put_contents('fichierJson/liste_jscore.json', $new_users);
       }
       elseif(isset($_SESSION['in_json']) && isset($q_exect)){
        $data = file_get_contents('fichierJson/parametre.json');
        $newdata= json_decode($data,true);  
            $newdata[2]['score']+= $score;
            foreach($q_exect as $val)
             array_push($newdata[4]['question'],$val);
           $newdata = json_encode($newdata); 
           file_put_contents('fichierJson/parametre.json', $newdata);
          
       }
        ?>
  </div> 
</div>