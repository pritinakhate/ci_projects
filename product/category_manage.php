<?php
include_once("includes/config.php");
include_once("index.php");
include_once("includes/header.php");
error_reporting(E_ALL);
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$ids = $_POST['selector'];
	if(empty($ids))
	{
		header("location:category_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
        for($i=0; $i<count($ids); $i++)
	{
		//to fetch id of country against token id 
		$getcategorydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from product_categories where id='$ids[$i]'"));
        
		//to check whether countryid is associated with users or not
		$checkcategoryidproduct = mysqli_fetch_assoc(mysqli_query($conn,"select id from products where product_category_id='".$getcategorydata['id']."'"));
       
        
		//to check whether countryid is associated with states or not
		$checkcategoryidsubcategory = mysqli_fetch_assoc(mysqli_query($conn,"select id from product_subcategories where product_category_id='".$getcategorydata['id']."'"));
		
		
		
		if(!empty($checkcategoryidproduct) || !empty($checkcategoryidsubcategory) )
		{
			echo"This country already mapped";
			$nondel++;
		}
		else
		{
			mysqli_query($conn,"delete from product_categories where id='".$getcategorydata['id']."'");
			$del++;
			//header("location:country_manage.php");
		}
	 }
	 $massage = $del."Record has been deleted and ".$nondel." Unable to delete record";
	}
}


$getallcategory = mysqli_query($conn,"SELECT * FROM product_categories ORDER BY id DESC")

?>

<body>
    <div class="container w-75">

        <div class="panel-heading">
            <h3 class="panel-title text-center">Category List</h3>
        </div>
        <br />
        <div class="text text-center">
            <?php if(isset($massage) && !empty($massage)) { ?>
            <span class="alert alert-danger">
                <?= $massage ?>
            </span>
            <?php } ?>
        </div>




        <a class="btn btn-primary float-end" href="category_create.php" role="button">Create</a>

        <div>
            <form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
                <table id="myTable" class="table table-striped table-bordered" id="mytable">
                    <thead class="table-light">
                        <tr>
                            <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                            <th>Sr.</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;
        while($row = mysqli_fetch_array($getallcategory)){
            ?>
                        <tr>
                            <td><input type="checkbox" name="selector[]" value="<?php echo $row['id'];?>" /></td>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><button type="button" class="btn">
                                    <a href="update.php?id=<?php echo $row['id']; ?>"><i style="color: #c98a1e;"
                                            class="fa-solid fa-pencil"></i></a>
                                </button>
                                <button type="button" class="btn">
                                    <a href="category_delete.php?id=<?php echo $row['id'];?>"><i
                                            style="color: #d80827; " class="fa-solid fa-trash"></i></a>
                                </button>
                            </td>
                        </tr>
                        <?php }?>



                    </tbody>
                    <tr>
                        <td colspan="10"><button type="submit" name="deleteall"
                                class="btn btn-danger btn-xs">Delete</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        </script>
        <script src="assets/js/main.js"></script>

    </div>
</body>