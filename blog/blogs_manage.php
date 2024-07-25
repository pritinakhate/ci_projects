<?php
include_once("includes/config.php");
include_once("includes/manage_nav.php");
include_once("includes/header.php");
error_reporting(E_ALL);

if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$ids = $_POST['selector'];
    
	if(empty($ids))
	{
		header("location:blogs_manage.php");
	}
	else
	{
	 $del=0;
	 $nondel=0;	
	
	for($i=0 ; $i<count($ids); $i++)
	{
		//to fetch id of city against token id 
	$getblogdata = mysqli_fetch_assoc(mysqli_query($conn,"select id, image from blogs where id='".$ids[$i]."'"));
    
		//if associated with id with users and city and location
		if(!isset($getblogdata['id']) || empty($getblogdata['id']))
	{
		// after fetching no record found then reditect to list page
		header("location:blogs_manage.php");
		$nondel=0;
	}
	else
	{
		//remove data from table 
		mysqli_query($conn,"DELETE FROM blogs where id='".$getblogdata['id']."'");
		//remove attachments from folder
		unlink("uploads/blog_image/".$getblogdata['image']);
		$del++;
		//header("location:blogs_manage.php");
        
	}
	}
	$massage = $del."Record has been deleted "."&nbsp"."&nbsp".$nondel."Unable to delete record";
}
}

$getallblog = mysqli_query($conn,"SELECT blog_categories.category_title, blogs.id, blogs.title, blogs.content,blogs.image, blogs.status  FROM blogs INNER JOIN blog_categories ON blogs.blog_category_id = blog_categories.id ORDER BY id DESC");

?>
<!DOCTYPE html>
<html>

<body>
    <form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
        <div class="container m-4 p-2 fs-5 text-center">
            Blog List
        </div>
        <br />
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

        <a class="btn btn-primary float-end" href="blogs_create.php" role="button">Create</a>

        <table id="myTable" class="table table-striped table-bordered " id="mytable">
            <thead class="table-light">
                <tr>
                    <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                    <th>Sr.</th>
                    <th>Blog category</th>
                    <th>title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;
        while($row = mysqli_fetch_array($getallblog)){
            ?>
                <tr>
                    <td><input type="checkbox" name="selector[]" value="<?php echo $row['id'];?>" /></td>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['category_title'] ?></td>
                    <td><?php echo $row['title']?></td>
                    <td><?php echo $row['content'] ?></td>
                    <td><?php if($row['image']!=""){?>
                        <img src="uploads/blog_image/<?php echo $row['image'];?>" width="70" height="70" alt="image" />
                        <?php }else {?>
                        No Photo Available
                        <?php } ?>
                    </td>
                    <td><?php echo $row['status'] ?></td>
                    <td><button type="button" class="btn">
                            <a href="blogs_update.php?id=<?php echo $row['id']; ?>"><i style="color: #c98a1e;"
                                    class="fa-solid fa-pencil"></i></a>
                        </button>
                        <button type="button" class="btn">
                            <a href="blogs_delete.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                    class="fa-solid fa-trash"></i></a>
                        </button>
                        <button type="button" class="btn">
                            <a href="view.php?id=<?php echo $row['id'];?>"><i style="color: #c98a1e; "
                                    class="fa-solid fa-eye"></i></a>
                        </button>
                    </td>
                </tr>
                <?php }?>



            </tbody>
            <tr>
                <td colspan="9"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button>
                </td>
            </tr>
        </table>
      
    </form>
    <script src="assete/js/jquery.min.js"></script>
    <script src="assete/js/jquery.dataTables.min.js"></script>
    <script src="assete/js/dataTables.bootstrap.min.js"></script>
    <script src="assete/main.js"></script>
</body>

</html>