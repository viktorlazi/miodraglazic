<?php
    include_once('classes/db.php');

    $slike=($_POST["arr"]);
    $slike=$slike.'.';
    print_r($slike);

    $s=array();
    while(true){
        if(strlen($slike)==0){
             break;
        }
       else if(substr($slike,0,1) == '.'){
        $slike = substr($slike, 1, strlen($slike));
       }
       else if(substr($slike,0,1) != '.'){
           array_push($s,substr($slike,0,strpos($slike, '.')));
           $slike = substr($slike, strpos($slike, '.'), strlen($slike));
       }    
    }
    print_r($s);

?>


<html>
<body>



</body>
</html>