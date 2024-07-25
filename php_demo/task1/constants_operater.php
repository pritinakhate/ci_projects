<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>constants_operater</title>
</head>
<body>
    <?php
    //constatnt
    define("character","PHP");
    define("radius",2.5);
    echo character, radius;


    //function

    function lanj($nam){
        echo $nam;
        // lanj("akash");
    };
    lanj("priti");


    //magic constat
    echo __DIR__;
    echo __FILE__;
    echo __FUNCTION__;
    echo __LINE__;
    


    //arithmatic operator
    $a = 10; //assigment oerator
    $b = 5;

    $c1 = $a + $b;
    $c2 = $a - $b;
    $c3 = $a * $b;
    $c4 = $a / $b;
    $c5 = $a % $b;
    $c6 = $a ** $b;
    echo $c1,$c2,$c3,$c4,$c5,$c6;


    //Assigment operator
    $a += $b;
    $a -= $b;
    $a *= $b;
    $a /= $b;
    $a %= $b;
    $a **= $b;
    echo $a;

    //comparison operater
    var_dump($a==$b);
    var_dump($a===$b);
    var_dump($a>=$b);
    var_dump($a<=$b);
    var_dump($a>$b);
    var_dump($a<$b);
    var_dump($a!=$b);
    var_dump($a!==$b);
    var_dump($a<>$b);
    ($a<=>$b);

    //logical operater

   
    var_dump($a||$b);
    var_dump($a&&$b);
    var_dump($a xor $b);
    var_dump(!$a);

    //increment & decrement
    $a++;
    $b--;
    echo $a,$b;

    ?>
</body>
</html>







