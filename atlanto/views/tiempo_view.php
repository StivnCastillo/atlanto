<?php 

function hourdiff($hour_1 , $hour_2 , $formated=false){
    
    $h1_explode = explode(":" , $hour_1);
    $h2_explode = explode(":" , $hour_2);

    $h1_explode[0] = (int) $h1_explode[0];
    $h1_explode[1] = (int) $h1_explode[1];
    $h2_explode[0] = (int) $h2_explode[0];
    $h2_explode[1] = (int) $h2_explode[1];
    

    $h1_to_minutes = ($h1_explode[0] * 60) + $h1_explode[1];
    $h2_to_minutes = ($h2_explode[0] * 60) + $h2_explode[1];

    
    if($h1_to_minutes > $h2_to_minutes){
    $subtraction = $h1_to_minutes - $h2_to_minutes;
    }
    else
    {
    $subtraction = $h2_to_minutes - $h1_to_minutes;
    }

    $result = $subtraction / 60;

    if(is_float($result) && $formated){
    
    $result = (string) $result;
      
    $result_explode = explode(".",$result);

    return $result_explode[0].":".(($result_explode[1]*60)/10);
    }
    else
    {
    return $result;
    }
}

echo hourdiff("9:00" , "11:30" , true);
?>