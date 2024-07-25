<?php
$array = array(10,20,30,40);
$array1 = [10,20,30,10];



$arraylist1 = [
    "id"=>1,
    "Name"=>"priti",
    "Gender"=>"Female",
    "mobile"=>998877655,
    "email"=>"abc@gmail.com"
];

$arraylist2 = array(
    array("id"=>1,
    "Name"=>"Akash",
    "Gender"=>"male",
    "mobile"=>997874657,
    "email"=>"abc@gmail.com",
),
array(
    "id"=>2,
    "Name"=>"Payal",
    "Gender"=>"Female",
    "mobile"=>908800655,
    "email"=>"abc@gmail.com"
));

$arraylist3 = [
    (object)[
    "id"=>1,
    "Name"=>"Ankush",
    "Gender"=>"male",
    "mobile"=>998997655,
    "email"=>"abc@gmail.com"
],
(object)[
    "id"=>2,
    "Name"=>"Ashok",
    "Gender"=>"male",
    "mobile"=>998227655,
    "email"=>"abc@gmail.com"
]];

print_r("<br>Example of index array<br>");
print_r($array);
print_r("<br>");
print_r($array1);

print_r("<br>Example of Associate array<br>");
print_r($arraylist1);
print_r("<br>");


print_r("<br>Example of multidimention array<br>");
print_r($arraylist2);
print_r("<br>");

print_r("<br>Example of json example<br>");
print_r($arraylist3);
print_r("<br>");
?>

<
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>PHP Folder STRUCTURE</h1>
        htdocs/Project Name<br/>
        common/include folder<br/>
            &emsp; -config.php <br/>
            &emsp; -head.php <br/>
            &emsp; -sidebar.php<br/>
            &emsp; -footer.php<br/>
            &emsp; -script.php<br/>
            &emsp; -validation.php <br/>
        city_manage.php<br/>
        city_update.php<br/>
        city_create.php<br/>
        city_delete.php<br/>


        <h1>Database Table</h1>
        <table>
            <thead>
                <tr>
                    <td>Sr.No.</td>
                    <td>Name</td>
                    <td>gender</td>
                    <td>mobile</td>
                    <td>email</td>

                </tr>   
                
            </thead>


        </table>
</body>
</html>
