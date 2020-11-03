<?php
    include_once('classes/db.php');

    $slike=($_POST["arr"]);
    $slike=$slike.'.';

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
    // $s sada sadrzi id-ove za slike koje su odabrane
    $baza = DB::query('SELECT * FROM slika WHERE id IN (' . implode(',', array_map('intval', $s)) . ')');
    print_r($baza);
    // $baza sada sadrzi odabrane slike

?>


<html>
<body>



</body>
</html>