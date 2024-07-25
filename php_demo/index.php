<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
/* $x = "Priti";
$y = 2542.2;
$z = true;
$a = array("aaa",111,"nnn","sss");
$b = null;

echo $x . "<br>";



var_dump($x);
echo $y . "<br>";
var_dump($y)."<br>";
var_dump($z)."<br>";

var_dump($a)."<br>";
var_dump($b)."<br>"; */

//costant variable
// define( "test", 50,true);
// $sum2 = test +1;
// echo $sum2."<br>";
// echo test;

//ARITHMATIC 
$a = 10;
$b = 10;

if($a===$b){
    echo "A is smaller";
}

echo "here is other statement";

// logical operator

$age = '16';
if($age===16)
{
    echo"you are elibigle";
}
else{
    echo "you are not eligiobla";
};


$name = "Priti";
$gender = "female";

if($gender =="priti"){
    echo "you are.".$name;
}
else{
    echo "not correct<br> ".$name;
}

$per = 25;

if($per>=80 && $per<=100){
    echo "You are in marit";
}
elseif($per<80 && $per>=60){
    echo "you are 1st division";
}
elseif($per<60 && $per>=40){
    echo "you are 2snd division";
}
elseif($per<40 && $per>=30){
    echo "you are 3rd division";
}
else{
    echo "you are fail";
}



//switch case

$weekday = 3;

switch($weekday){
    case 1:case 2:case 3:
        echo "Monday";
        echo "<br>This is just test";
    break;
    // case 2:
    //     echo "tuseday";
    // break;
    // case 3:
    //     echo "wenesday";
    // break;
    case 4:
        echo "thusday";
    break;
    case 5:
        echo "friday";
    break;
    case 6:
        echo "saturday";
    break;
    case 7:
        echo "sunday";
    break;
    
    default:
    echo "this day is not present";
    }

    $age = 50;

    switch(true){
        case ($age>=15 && $age<=20) :
            echo "You are eligible";
        break;
        case ($age>=21 && $age<=30):
            echo "You are not eligible";
        break;
        default:
        echo "enter valid age<br>";
        break;
    }

//ternari operator

$p=20;
$z="value is :".($p>=20?"greter<br>" :"smaller<br>");
echo $z;


//string operater

$a="Hello<br>";
$a .= "world<br>";
$a .= 500;
echo $a; 

//loops

$a=10;
echo "<ul>";
while($a>0){
    echo "<li>".$a."priti</li>";
    $a-=2;
}
echo "</ul>";

$a = 10;

do{
 echo $a.")Akash<br>";
 $a--;
}while($a>=1);


for($a=10; $a>=1; $a--){

    echo $a."<b>Ankush<br></b>";
}


//nested loop

for($a=1;$a<=100;$a=$a+10){
    for($b=$a;$b<$a+10;$b++){
        
        echo $b." ";  
    }
    
    echo "<br>";
}

?>

<?php
for($a=1;$a<=10;$a++){
    if($a==3){
        break;
    }
    echo $a;
}

for($a=1;$a<10;$a++)
{
    if($a==4){
        goto abc;
    }
    echo $a;
}

abc:
echo "<br>I am Priti";

echo "abc";
echo "bcd";
goto adc;
echo "def";
echo "fgh";

adc:
echo "Priti";


//function
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

$arra = ["PHP","JaVA","Python",25,55];   //array
    $fruit_color = array(
        "red" => "Apple",
        "orange" => "orange",
        "green" => "gava",
        "mango" => "yellow",
    );

    print_r ($arra);

?>
  
</body>
</html>