<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>variable_datatype</title>
</head>
<body>
    <?php
    //variable 
    $a=10;
    $a_=20;
    $_A=20;
    $a8=80;
    echo $a,$a_,$_A,$a8;

    //data type
    $int_a =10;           //integer
    $flot_a=10.55;        //flot or double float or real
    $string = "Welcome to PHP";  //string
    $bool1 = true;  // boolean 
    $bool2 = false;
    $array = ["PHP","JaVA","Python",25,55];   //array
    $fruit_color = array(
        "red" => "Apple",
        "orange" => "orange",
        "green" => "gava",
        "mango" => "yellow",
    );

    //object


    $x="55";      //NULL
    $x=null;

    echo  var_dump($int_a),var_dump($flot_a),var_dump($string),var_dump($bool1),var_dump($bool2),var_dump($array),var_dump($fruit_color),var_dump($x);
    echo ($array);




    ?>
</body>
</html>