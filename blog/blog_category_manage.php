<?php
include_once ("includes/config.php");
include_once ("includes/manage_nav.php");
include_once ("includes/header.php");
error_reporting(E_ALL);

if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$ids = $_POST['selector'];
	if(empty($ids))
	{
		header("location:blog_category_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
	for($i=0; $i<count($ids); $i++)
	{
		//to fetch id of country against token id 
		$getcategorydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from blog_categories where id='".$ids[$i]."'"));
      
     
		
		//to check whether countryid is associated with users or not
		$checkcategoryblog = mysqli_fetch_assoc(mysqli_query($conn,"select id from blogs where blog_category_id='".$getcategorydata['id']."'"));
		//to check whether countryid is associated with states or not
		
	
		
		
		if(!$checkcategoryblog)
		{
            mysqli_query($conn,"delete from blog_categories where id='".$getcategorydata['id']."'");
			$del++;
			
		}
		else
		{
            echo "This country already mapped";
			$nondel++;
			//header("location:country_manage.php");
		}
	 }
	 $massage = $del."Record has been deleted and "."&nbsp"."&nbsp".$nondel." Unable to delete record";
	}
}





$getblogcategory = mysqli_query($conn, "SELECT * FROM blog_categories ORDER BY id DESC")

    ?>
<!DOCTYPE html>
<html>

<body>
<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
    <div class="container m-4 p-2 fs-5 text-center">
        Blog Category List
    </div>
    <div class="text text-center">
            <?php if(isset($massage) && !empty($massage)) { ?>
            <span class="alert alert-danger">
                <?= $massage ?>
            </span>
            <?php } ?>
        </div>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

<a class="btn btn-primary float-end" href="blog_category_create.php" role="button">Create</a>
            
            <table id="myTable" class="table table-striped table-bordered " id="mytable">
            
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                        <th>Sr.</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                while ($row = mysqli_fetch_array($getblogcategory)) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="selector[]" value="<?php echo $row['id'];?>" /></td>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['category_title'] ?></td>
                        <td><?php echo $row['content'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><button type="button" class="btn">
                                <a href="blog_category_update.php?id=<?php echo $row['id']; ?>"><i
                                        style="color: #c98a1e;" class="fa-solid fa-pencil"></i></a>
                            </button>
                            <button type="button" class="btn">
                                <a href="blog_category_delete.php?id=<?php echo $row['id']; ?>"><i
                                        style="color: #d80827; " class="fa-solid fa-trash"></i></a>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>



                </tbody>
                <tr>
                    <td colspan="8"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button>
                    </td>
                </tr>

    </table>
    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assete/js/dataTables.bootstrap.min.js"></script>
    <script src="assete/main.js"></script>

</body>

</html>