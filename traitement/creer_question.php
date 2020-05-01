<?php 
$question="";
$nbPoint="";
$reponses=[];
$choix ="";
$correcte=[];
$erreurs=[];
$i=0;
$sorti =0;
$tes_on=0;
    if(isset($_POST['submit'])){
            $question =$_POST['question'];
            $nbPoint =$_POST['nb_point'];
            $choix=$_POST['choix'];

            if(empty($question))
                $erreurs['question']="Saisir la question";
            if($nbPoint<5)
               $erreurs['score']= "Le score doit être superieur a 0";
            if($choix == 'default')
              $erreurs['choix']="Choisissez une reponse";

            if($choix=='choix_text'){
              $tes_on++;
              if(empty($_POST['reponse']))
                   $erreurs['reponse']="Saisir la reponse du question";
              else{
                $reponses[]=$_POST['reponse'];
                $correcte[]=$_POST['reponse'];
              }
            }
            if($choix=='choix_simple' ){
                while($sorti==0){
                  if(isset($_POST['reponse_'.$i])){
                      $reponses[]=$_POST['reponse_'.$i];
                      if(isset($_POST['on_0']) and $_POST['on_0']== "on_".$i) {$correcte[]=$_POST['on_0'];$tes_on++;}
                      else $correcte[]=0;
                      $i++;
                      $sorti =0;
                  }else $sorti = 1; 
                }
            }
            
            if($choix=='choix_multis'){
              while($sorti==0){
                if(isset($_POST['reponse_'.$i])){
                    $reponses[]=$_POST['reponse_'.$i];
                    if(isset($_POST['on_'.$i]) and $_POST['on_'.$i]== "on_".$i){ $correcte[]=$_POST['on_'.$i]; $tes_on++;}
                    else $correcte[]=0;
                    $i++;
                    $sorti =0;
                }else $sorti = 1; 
              }
          }
          if($choix=='default'){$erreurs['on']='';$erreurs['reponse']='';$tes_on++;}
          if($tes_on == 0) 
              $erreurs['on']= "Cochet au moins une réponse";
            
          if(empty($erreurs)){
              deletes_espace_unitiles($question);
              $retour = ajouQuest($question,$nbPoint, $reponses, $choix, $correcte);
              echo "<script>alert('$retour')</script>" ; 
              header('location:?page=admin&menu=creerquestion');
            }   
    }
   //var_dump($erreurs);
   // echo $erreurs['score'];
?>
        <h3 class="h3_quest">PARAMETREZ VOTRE QUESTION</h3>
         <span id="errors"></span>
        <div class="creer-question" id="creer-question">
            <span class="erreurq" id="errort"></span>
            <form  id="quest-form" action="" method="post">
                <span>Questions <i style="color: red">*</i></span>
                <textarea  name="question" id="question" cols="40" rows="3"><?= !empty($_POST["question"]) ? $_POST["question"]:""?></textarea>
                <span class="q_error"><?= !empty($erreurs["question"]) ? $erreurs["question"]:""?></span>

                <div class="nb_point">
                    <span>Nbre de Points <i style="color: red">*</i></span>
                    <input type="number" name="nb_point" id="nb_point" value="<?= !empty($_POST["nb_point"]) ? $_POST["nb_point"]:''?>">
                    <span style="color:red" class="nbp_error" ><?= !empty($erreurs["score"]) ? $erreurs["score"]:""?></span>
                </div>

                <div class="type_choix">
                <span class="q_error"><?= !empty($erreurs["choix"]) ? $erreurs["choix"]:"" ?></span><br>
                  <span>Type de réponse<i style="color: red">*</i></span>
                    <select name="choix" id="choix" onchange="ChangeOption()">
                        <option value="default" id="">Donnez le type de réponse</option>
                        <option value="choix_text" id="">Réponse de type texte</option>
                        <option value="choix_simple" id="">Réponse de type radio</option>
                        <option value="choix_multis" id="">Réponse de type checkbox</option>
                    </select>
                    <button type="button" id="btn-ajout" name="ajout" title="ajouter un element"><img src="Images/Icônes/ic-ajout-réponse.png" alt=""></button>
                </div>

                <div id="resp_input">
                </div>
                <span class="errorquest"><?php if(!empty($erreurs["reponse"])) echo $erreurs["reponse"] ;
                                        if(!empty($erreurs["on"])) echo $erreurs["on"]; ?></span>
                <input class="btn-suiv enregist" type="submit" name="submit" value="Enregister">
            </form>
        </div>

        <script>
          function ajout(choix,i){
              if(choix == "choix_text"){
                return  "<div><span class=span1 >Réponse <i style=color:red>*</i>"+
                        "<textarea name=\"reponse\" id=\"reponse\" cols=\"35\" rows=\"2\"></textarea>"+
                        "<button type =button onclick=Reset(this)>"+
                        "<img src=\"Images/Icônes/ic-supprimer.png\"></button</div>"
              
              }else if(choix == "choix_simple"){
                return "<div><span>Réponse " +(i+1)+"<i style=color:red>*</i>"+
                       "<input type =text name=reponse_"+(i)+" error=reponse-"+(i)+">"+
                       "<input type =radio name=on_0 value=on_"+(i)+">"+
                       "<button type =button onclick=Reset(this)>"+
                       "<img src=\"Images/Icônes/ic-supprimer.png\"></button></div>";
             
              }else if(choix == "choix_multis"){
                return  "<div><span>Réponse " +(i+1)+"<i style=color:red>*</i>"+
                        "<input type =text name=reponse_"+(i)+" error=reponse_"+(i+1)+" >"+
                        "<input type=checkbox name=on_"+(i)+" value=on_"+(i)+">"+
                        "<button type =button onclick=Reset(this)>"+
                        "<img src=\"Images/Icônes/ic-supprimer.png\"></button></div";
            }
          }
          function danger(t){
              t.style.border=" 1px solid red "
              t.style.outline=" none "
              t.addEventListener('keyup',function(e){
                e.target.style.border='none'
              })
            return true
          }
          function ChangeOption(){
              const divaff = document.getElementById('resp_input');
              const elt = document.getElementById('choix');
              const choix= elt.value
             // divaff.innerHTML=''
               i=0
              if(choix !== "default"){
                var element = ajout(choix,i)
                divaff.innerHTML =element ;
                elt.style.border='none'
              }
          }  
          function Reset(lui){
              var div =lui.parentNode
                div.parentNode.removeChild(div);
                
          }
           //declaration du variable i comme global pour les
           //choix de type checkbox
           i=1
  
    document.getElementById("quest-form").addEventListener('submit',function(e){
        const question = document.getElementById('question');
        const nbPoint = document.getElementById('nb_point');
        const choix = document.getElementById('choix');
        const divaff = document.getElementById('resp_input');
        const inputs = document.getElementsByTagName('input')
        const nbperror= document.querySelector('.nbp_error')
        var error=false;
        var j = 0
          if(question.value ==""){
          error=danger(question);
          }
          if(nbPoint.value==''){
            error=danger(nbPoint);
          }else if(nbPoint.value<=1){
            nbperror.innerHTML="Le score doit être superieur a 0!"
          }else  nbperror.innerHTML=""
          if(choix.value== 'default'){
            error=danger(choix);
          }
          if(!divaff.hasChildNodes()){
             error = true
          }
          if(document.getElementById('reponse')){
              const reponse = document.getElementById('reponse');
            if(reponse.value==''){
              error=danger(reponse);
              }
          }
          for(input of inputs){
              if(input.hasAttribute("error")){
                  if(!input.value){
                    error= danger(input)
                  }
              }
            }
            for(input of inputs){
              if(input.hasAttribute("value")){
                  if(input.checked ==true){
                    document.querySelector('.errorquest').innerHTML =''
                     j++
                  }
              }
            }
            if(j ==0 && (choix.value != 'choix_text' && choix.value != 'default')){ 
              document.querySelector('.errorquest').innerHTML="Cochet au moins un réponse !"
              error =true;
            }
          if(error){
            document.getElementById('errors').innerText="Tous les champs sont obligatoire !"
              e.preventDefault();
              return 0;
          }
    })
   
    document.getElementById('btn-ajout').addEventListener('click',function(e){
      const choix = document.getElementById('choix').value;
      const divaff = document.getElementById('resp_input');
        i++
        //alert (i+"ajout")
        var element = ajout(choix,i);
        if(choix == "choix_simple"){ 
            divaff.innerHTML += element;
        }
        if(choix == "choix_multis"){
            divaff.innerHTML += element;
        }
        if(choix == "choix_text"){
            divaff.innerHTML = element;
        }
    });

</script>