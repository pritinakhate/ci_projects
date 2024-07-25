<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function</title>
</head>
<body>
    <?php
    function myfunction(){
        echo "<br>hello<br>";
    }
    myfunction();
    echo"yahoonbaba";
    
    myfunction();
    myfunction();
    myfunction();
    
    
    function sum1($a,$b){
        echo $c = $a+$b."<br>";
       
    }
    function name($name){
        echo "Hello<br>".$name;
    }
    
    
    name("Priti");
    
    sum1(1.5,8.55);
    sum1(8,7);
    
    
    //function with return value
    function sum($math, $eng, $sci){
        $s=$math+$eng+$sci;
        return $s;
    }
    
    function persentage($st){
        $per = $st/3;
        return $per;
    }
    
    $total = sum(75,51,77);
    $percentage_per= persentage($total);
    echo $percentage_per;
    echo "<br>". $total;
    
    
    //diff function aurgument
    
    function wow($a){
         $a.="wlcome";
    }
    $str = "Heloo word";
    wow($str);
    echo $str;
    
    function first($num){
        $num += 5;
    }
    
    
    function second(&$num){
    $num += 8;
    }
    
    $number = 40;
    first($number);
    echo $number;
    second($number);
    echo $number;
    
    // variable function
    
    function techno($name1){
        echo $name1;
    }
    $func = "techno";
    $func("Technobase nagpur");
    
    $sayname = function($name2){
        echo $name2;
    };
    $sayname("hello priti");
    //recursive function
    function display($number){
        if($number<10){
        echo $number;
        display($number+3);
    }
    }
    display(5);
    
    //factorial
    
    function factorial($n){
        if($n==0){
            return 1;
        }
        else{
            return $n * factorial($n-1);
        }
    }
    echo factorial(6);
    
    function lanj($nam){
        echo $nam;
        // lanj("akash");
    };
    lanj("priti");
    ?>
</body>
</html>