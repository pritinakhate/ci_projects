<?php
include_once("includes/header.php");
$url=(basename($_SERVER['PHP_SELF']));
	
  
?>


<body>

<div class="container w-50 mb-4" style="background-color:aquamarine; border-radius: 20px;">
<ul class="nav nav-pills nav-fill p-3">
  <li <?php echo ($url=="blogs_manage.php" || $url=="blogs_create.php")?"class='active'":''; ?>>
    <a class="nav-link active" aria-current="page" href="blogs_manage.php">Home</a>
  </li>
  <li <?php echo ($url=="blog_category_manage.php" || $url=="blog_category_create.php")?"class='active'":''; ?>>
    <a class="nav-link" href="blog_category_create.php">Create blog-category</a>
  </li>
  <li <?php echo ($url=="blogs_manage.php" || $url=="blogs_create.php")?"class='active'":''; ?>>
    <a class="nav-link" href="blogs_create.php">Create blogs</a>
  </li>
  
</ul>
</div>
</body>