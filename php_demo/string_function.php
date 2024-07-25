<?php

$string = "apple,juice,cherry";
$array = explode(",",$string);
print_r( $array);

$z= [11,22,55,88];
$array = implode(",",$z);
print_r( $array);

$z= [11,22,55,88];
$array = join(",",$z);
print_r( $array);
"<br>";
$string1 = "Apple Juice Cherry";
echo lcfirst($string1);
"<br>";

?>