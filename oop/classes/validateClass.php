<?php
class validator{

   public function clean($input){
        $value = trim($input);
        $value = htmlspecialchars($value);
        $value = stripslashes($value);
        return $value;
    //   return stripslashes(htmlspecialchars(trim($input)));
    }
    
   public  function validate($input,$flag){
        $status = true;
        switch ($flag) {
            case 1:
                if (empty($input)) {
                    $status = false; 
                }
                break;
            case 2: 
                    # code .... 
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)){
                   $status = false;
                   } 
                 break;
            case 3: 
                    # code .... 
               if (!filter_var($input, FILTER_VALIDATE_URL)){
                   $status = false;
                   } 
                 break;
             
             case 4: 
                      #code .... 
                if (strlen($input) < 6){
                    $status = false;
                  }  
                 break;
            
           
             case 5: 
                    # code .... 
                 if (!filter_var($input, FILTER_VALIDATE_INT)){
                    $status = false;
                   } 
                 break;    
           
                  
             case 6: 
                      #code .... 
                  if (strlen($input) != 11){
                      $status = false;
                   }  
                      break; 
                  
           
        }
        return $status;
    }
    public function Errors($errors){
        foreach($errors as $key => $value){
            echo '*'.$key.':'.$value .'<br>'; 
        }
    }


}



?>