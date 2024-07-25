<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array</title>
</head>
<body>
    <?php
    //indexing array 

    $color = array("red","blue","black","white");
    //echo $color[2];
    $color[0] = "pink";
    print_r($color);

    echo "<pre>";
    print_r ($color);
    echo "</pre>";
    echo "<ul>";
    for($i=0;$i<4;$i++){
        echo"<li> $color[$i] </li>";
    }

    echo "</ul";

    $age=array(
        "bill" =>85,
        "peter" =>22,
        "john" =>55,
    );

    print_r($age);


    $colors =["red","green","blue"];

    foreach($colors as $value){
    echo $value."<br>";
    }
    echo"<ul>";
    foreach($age as $key=> $value){
        echo "<li>$key = $value.</li>";
        }

    echo "</ul>";
    ?>

    <?php

    //Associative array
    $emp1= [
        ["id" =>1,
        "name"=>"Priti",
        "designation"=>"manager",
        "salary"=>5000],

        ["id" =>2,
        "name"=>"Akash",
        "designation"=>"Senior",
        "salary"=>2000],
        ["id" =>3,
        "name"=>"Payal",
        "designation"=>"Junior",
        "salary"=>2500],
       
    ];

    //multidimentional array

    $emp = [
        [1,"Priti","manager",5000],
        [2,"Akash","senior",3000],
        [3,"Payal","junior",2000],
    ];

    echo "<pre>";
    print_r($emp);
    echo "</pre>";

    print_r($emp[0][0])."   ";
    print_r($emp[0][1])."   ";
    print_r($emp[0][2])."   ";
    print_r($emp[0][3])."   ";
    

    for($row=0; $row<3; $row++){
        for($col=0; $col<4; $col++){
        Print_r($emp[$row][$col]);
        }
       echo  "<br>";
    }
    
    
    //table index array


    echo "<table border = '2px' cellpadding='5px' cellspacing = '2px';>";
    echo "<tr>
            <th>Emp Id.</th>
            <th>Emp name</th>
            <th>Emp designation</th>
            <th>Emp salary</th>
            </tr>";
    foreach($emp as $v1){
        echo "<tr>";
        foreach($v1 as $v2){
           echo"<td>";
            print_r($v2." ");
            echo"</td>";
        }
        echo"<br>";
        echo"</tr>";
    }

    echo"</table>";

    foreach($emp as $v1){
        print_r($v1);
    }


    //table associated array
    $marks = [
        "Priti" =>["phy"=>55,"che"=>25,"bio"=>77],
        "Akash" =>["phy"=>45,"che"=>85,"bio"=>74],
        "Payal" =>["phy"=>47,"che"=>84,"bio"=>64],
    ];

    echo "<pre>";
    print_r($marks);
    echo "</pre>";

    echo"<table border = '10px' cellspacing= '5' cellpadding = '5'>";
    echo "<tr>
            <th>Studendent name</th>
            <th>Pthysics</th>
            <th>chemistry</th>
            <th>Biology</th>
        </tr>";
    foreach($marks as $key => $v1){
        
        echo"<tr>";
            echo "<td>";
            print_r($key);
            echo "</td>";
        foreach($v1 as $v2){
            echo "<td>";
            print_r($v2);
            echo"</td>";
        }
       echo "<br>";
       echo"</tr>";
    }

    print_r("<br>");
    echo "</table>";

    //list 
    echo "<table border='16px' cellspacing = '5px' cellpadding='2px'>";
    echo "<tr>
        <th>Id</th>
        <th>name</th>
        <th>Designation</th>
        <th>Salary</th>
    </tr>";
    foreach($emp as list($id,$name,$designation,$salary)){
        echo "<tr><td>$id </td><td>$name</td><td> $designation </td><td>$salary</td></tr>";
    }
    print_r("<br>");
    echo "</table>";
   
    //multidimentional list foreach
    echo "<table border='5px' cellpading='5px' cellspacing='5px'>";

    echo "<tr>
            <td>Id</td>
            <td>Name</td>
            <td>Designation</td>
            <td>Salary</td>

        </tr>";
    
        foreach($emp1 as list("id"=>$id,"name"=>$name,"designation"=>$designation,"salary"=>$salary)){
            echo "<tr><td>$id</td><td>$name</td><td>$designation</td><td>$salary</td></tr>";
        }
        print_r("<br>");
    echo "</table>";

    ?>

</body>
</html>