<?php


$array = ["Priti","payal","Ankush","Akash"];
$array1 = [
    "Family"=>["Priti","payal","Ankush","Akash"],
    "guest"=>["rita","alka","gayu","appi"]
];
$array2 = ["Priti","payal","Ankush"];
$guest= ["rita","alka","gayu"];
$guest1= ["rita","alka","gayu"];
$guest= ["rita","alka","gayu"];


//count &sizeof
echo count($array);
echo"<br>";
echo sizeof($array);
echo"<br>";

echo count($array1,0);
echo"<br>";
echo sizeof($array1,1);
echo"<br>";


print_r(array_count_values($array));

$len = count($array);
 for($i=0; $i<$len ; $i++){
    echo $array[$i];
    echo"<br>";
 }

 echo in_array("Priti",$array);

 echo"<br>";
 if(in_array("payal",$array)){
    echo"find successfully";
 }else{
    echo "Not find";
 }
 echo"<br>";
//replace

$newarray = array_replace($array,$guest);
print_r($newarray);

//push & pop

array_push($array,"aa");
print_r($array);
echo"<br>";
array_pop($array);
array_pop($array);
print_r($array);

echo"<br>";
//shift & unshift
array_shift($array);
print_r($array);
echo"<br>";
array_unshift($array,"bb","aa");
print_r($array);
echo"<br>";


//merge & comnine
$new = array_merge($array,$guest);
print_r($new);
echo"<br>";
$new1 = array_merge($array1,$guest);
print_r($new1);
echo"<br>";
$new = array_combine($array2,$guest1);
print_r($new);
echo"<br>";

//Slice

$num = [1,2,3,4];
$new = array_slice($num,2,3);
print_r($new);
echo"<br>";


//key function

$marks = [
   "Priti" =>["phy"=>55,"che"=>25,"bio"=>77],
   "Akash" =>["phy"=>45,"che"=>85,"bio"=>74],
   "Payal" =>["phy"=>47,"che"=>84,"bio"=>64],
];

$new = array_keys($marks);
print_r($new);
echo"<br>";

$new = array_key_first($marks);
print_r($new);
echo"<br>";

$new = array_key_exists("Payal",$marks);
print_r($new);
echo"<br>";


//splice
$num1 = [1,2,3,4,5,7];
$num2 = [88,5,7,22];
//array_splice($num1,1);
print_r($num1);
echo"<br>";
array_splice($num1,4,count($num1));
print_r($num1);
echo"<br>";

array_splice($num1,count($num1),0,$num2);
print_r($num1);
echo"<br>";

//intersect
$numb = [1,2,3,4,5,7];
$numb1 = [88,5,7,22];

$x= array_intersect($numb,$numb1);
print_r($x);
echo"<br>";

$emp1= ["id" =>1,
   "name"=>"Priti",
   "designation"=>"manager",
   "salary"=>5000,
   "mobile"=>9988774455];

   $emp2= ["id" =>1,
   "name"=>"Priti",
   "designation1"=>"Senior",
   "salary"=>2000,
   "age"=>25];
   
  
$x = array_intersect($emp1,$emp2);
print_r($x);
echo"<br>";

$x = array_intersect_key($emp1,$emp2);
print_r($x);
echo"<br>";
$x = array_intersect_assoc($emp1,$emp2);
print_r($x);
echo"<br>";

//column and chunk
$emp1= [["id" =>1,
   "name"=>"Priti",
   "designation"=>"manager",
   "salary"=>5000,
   "mobile"=>9988774455],

   ["id" =>1,
   "name"=>"Prit",
   "designation"=>"Senior",
   "salary"=>2000,
   "age"=>25],
   ["id" =>1,
   "name"=>"Pri",
   "designation"=>"Senior",
   "salary"=>2000,
   "age"=>25]
];
$x = array_column($emp1,"salary","name");
print_r($x);
echo"<br>"; 


$numbe = ['11','12','13','14','15','17'];

$x = array_chunk($emp1,2,true);
echo "<pre>";
print_r($x);
echo "</pre>";
echo"<br>";


//diff
$number = ['11','12','13','14','15','17'];
$number1 = ['11','22','13','33','15','88'];
$x = array_diff($number,$number1);
echo "<pre>";
print_r($x);
echo "</pre>";
echo"<br>";
$x = array_diff_assoc($emp2,$emp1);
echo "<pre>";
print_r($x);
echo "</pre>";
echo"<br>";



//map

$sq = [1,2,3,4];

function square($n){
   return $n*$n;
}
 $x = array_map('square',$sq);
 echo "<pre>";
 print_r($x);
 echo "</pre>";
 echo"<br>";

 //unique
 $sq1 = [1,2,3,4,4,1,2];
 $x = array_unique($sq);
 echo "<pre>";
 print_r($x);
 echo "</pre>";
 echo"<br>";

?>


