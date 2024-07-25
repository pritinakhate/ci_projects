<?php
include_once("includes/header.php");
$url=(basename($_SERVER['PHP_SELF']));
?>

<body>
    <div class="container w-75 mt-3 mb-3 p-2  " style="background-color:#B5ABA9; color:white;" >


        <ul class="nav justify-content-center text-white">
        <li <?php echo ($url=="lead_manage.php" || $url=="lead_create.php")?"class='active'":''; ?>>
    <a class="nav-link active" aria-current="page" href="lead_manage.php">Home</a>
  </li>
  <li <?php echo ($url=="sources_manage.php" || $url=="source_create.php")?"class='active'":''; ?>>
    <a class="nav-link active" aria-current="page" href="source_create.php">Lead Sources</a>
  </li>
  <li <?php echo ($url=="stages_manage.php" || $url=="stage_create.php")?"class='active'":''; ?>>
    <a class="nav-link active" aria-current="page" href="stage_create.php">Lead Stages</a>
  </li>
  <li <?php echo ($url=="lead_manage.php" || $url=="lead_create.php")?"class='active'":''; ?>>
    <a class="nav-link active" aria-current="page" href="lead_create.php">Lead</a>
  </li>
            
        </ul>
    </div>
</body>