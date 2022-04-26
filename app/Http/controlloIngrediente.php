<?php

require_once('app/Models/DataLayer.php');




 
      $dl = new DataLayer();    
     if($dl->ingredientIsUsed($_POST['data'])){
        return  'esiste';
      }
      else return  'ok';
      
     

?>