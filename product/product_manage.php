<?php

include_once("includes/config.php");
include_once("index.php");
include_once("includes/header.php");

if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$ids = $_POST['selector'];
	if(empty($ids))
	{
		header("location:product_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
	for($i=0; $i<count($ids); $i++)
	{
		//to fetch id of country against token id 
		$getproductdata = mysqli_fetch_assoc(mysqli_query($conn,"select id, image from products where id='".$ids[$i]."'"));
		
		if(!isset($getproductdata['id']) || empty($getproductdata['id']))
	{
		// after fetching no record found then reditect to list page
		header("location:product_manage.php");
		$nondel=0;
	}
	else
	{
		//remove data from table 
		mysqli_query($conn,"DELETE FROM products where id='".$getproductdata['id']."'");
		//remove attachments from folder
		unlink("uploads/product_image/".$getproductdata['image']);
		
		$del++;
		//header("location:product_manage.php");
	}
	}
	$massage = $del."Record has been deleted "."&nbps"."&nbps".$nondel."Unable to delete record";
}
}




$getallproduct = mysqli_query($conn, "SELECT product_categories.category_name,  product_subcategories.subcategory_name, products.id, products.product_name, products.description,products.price, products.image, products.status FROM products
LEFT JOIN product_categories ON products.product_category_id=product_categories.id
LEFT JOIN product_subcategories ON products.product_subcategory_id=product_subcategories.id ORDER BY id DESC" );

?>
<html>

<body>
    <div class="container w-75">
        <div class="panel-heading">
            <h3 class="panel-title text-center mt-3">Product List</h3>
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

        <a class="btn btn-primary float-end" href="product_create.php" role="button">Create</a>
        <form method="post" onsubmit="return confirm('Do you really want to remove this record?');">

            <table id="myTable" class="table table-striped table-bordered " id="mytable">

                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                        <th>Sr.</th>
                        <th>Product category</th>
                        <th>Product SubCategory </th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;
        while($row = mysqli_fetch_array($getallproduct)){
            ?>
                    <tr>
                        <td><input type="checkbox" name="selector[]" value="<?php echo $row['id'];?>" /></td>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['category_name'] ?></td>
                        <td><?php echo $row['subcategory_name']?></td>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><img src="uploads/product_image/<?php echo $row['image'] ?>" height="70" width="70"></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><button type="button" class="btn">
                                <a href="product_update.php?id=<?php echo $row['id']; ?>"><i style="color: #c98a1e;"
                                        class="fa-solid fa-pencil"></i></a>
                            </button>
                            <button type="button" class="btn">
                                <a href="product_delete.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                        class="fa-solid fa-trash"></i></a>
                                <button type="button" class="btn">
                                    <a href="product_view.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                            class="fa-regular fa-eye"></i></a>
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
        <script src="assets/js/jquery.min.js">
        </script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.min.js"></script>
        <script></script>
        <script src="assets/js/main.js"></script>

    </div>
</body>

</html>