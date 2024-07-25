<?php $url=(basename($_SERVER['PHP_SELF']));
	
  ?>
<nav class="navbar navbar-default" role="navigation">
		   <div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" 
				 data-target="#menupanel1">
				 <span class="sr-only">Toggle navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			  </button>
		
		   </div>
		   
		   <div class="collapse navbar-collapse" id="menupanel1">
			  <ul class="nav navbar-nav">
				 <li <?php echo ($url=="user_manage.php" || $url=="user_create.php")?"class='active'":''; ?>><a href="user_manage.php">Manage Users</a></li>
				  <li <?php echo ($url=="country_manage.php" || $url=="country_create.php")?"class='active'":''; ?>><a href="country_manage.php">Manage Countries</a></li>
				   <li <?php echo ($url=="state_manage.php" || $url=="state_create.php")?"class='active'":''; ?>><a href="state_manage.php">Manage States</a></li>
				 <li <?php echo ($url=="city_manage.php" || $url=="city_create.php")?"class='active'":''; ?>><a href="city_manage.php">Manage Cities</a></li>
				 <li <?php echo ($url=="hobby_manage.php" || $url=="hobby_create.php")?"class='active'":''; ?>><a href="hobby_manage.php">Manage Hobbies</a></li>
				  <li <?php echo ($url=="location_manage.php" || $url=="location_create.php")?"class='active'":''; ?>><a href="location_manage.php">Manage Locations</a></li>
				
				
				 
			  </ul>
		   </div>
		</nav>