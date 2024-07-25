<?php
include_once("includes/config.php");
include_once ("includes/header.php");
include_once("index.php");

$conn = mysqli_connect("localhost","root","1100","lead");

if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$ids = $_POST['selector'];
	if(empty($ids))
	{
		header("location:stages_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
        foreach($ids as $id)
	{
		//to fetch id of country against token id 
		$getstagedata = mysqli_fetch_assoc(mysqli_query($conn,"select id from lead_stages where id='$id'"));
		
		//to check whether countryid is associated with users or not
		$checklead = mysqli_fetch_assoc(mysqli_query($conn,"select id from leads where stage_id='".$getstagedata['id']."'"));
		//to check whether countryid is associated with states or not
		
		
		if(!$checklead)
		{
            mysqli_query($conn,"delete from lead_stages where id='".$getstagedata['id']."'");
			$del++;
			
		}
		else
		{
            echo"This stage already mapped";
			$nondel++;
			//header("location:country_manage.php");
		}
	 }
	 $massage = $del."Record has been deleted and ".$nondel." Unable to delete record";
	}
}


$getallsources = mysqli_query($conn,"SELECT * FROM lead_stages ORDER BY id DESC")

?>

<body>
    <div class="container w-75">
        <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        </script>

        <div class="panel-heading">
            <h3 class="panel-title text-center mt-3">Stages List</h3>
        </div>
        <br />
        <div class="text text-center">
            <?php if(isset($massage) && !empty($massage)) { ?>
            <span class="alert alert-danger">
                <?= $massage ?>
            </span>
            <?php } ?>
        </div>



        <div><a class="btn btn-primary float-end" href="stage_create.php" role="button">Create</a></div>
        <form method="post" onsubmit="return confirm('Do you really want to remove this record?');">

            <div>
                <table id="myTable" class="table table-striped table-bordered " id="mytable">
                    <thead class="table-light">
                        <tr>
                            <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                            <th>Sr.</th>
                            <th>Stages-title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;
        while($row = mysqli_fetch_array($getallsources)){
            ?>
                        <tr>
                            <td><input type="checkbox" name="selector[]" value="<?php echo ($row['id']);?>" /></td>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><button type="button" class="btn">
                                    <a href="stages_update.php?id=<?php echo $row['id']; ?>"><i style="color: #c98a1e;"
                                            class="fa-solid fa-pencil"></i></a>
                                </button>
                                <button type="button" class="btn">
                                    <a href="stages_delete.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                            class="fa-solid fa-trash"></i></a>
                                </button>
                            </td>
                        </tr>
                        <?php }?>



                    </tbody>
                    <tr>
                        <td colspan="8"><button type="submit" name="deleteall"
                                class="btn btn-danger btn-xs">Delete</button></td>
                    </tr>
                </table>
            </div>
    </div>
    </form>
    <script src="assete/js/jquery.min.js"></script>
    <script src="assete/js/jquery.dataTables.min.js"></script>
    <script src="assete/js/dataTables.bootstrap.min.js"></script>
    <script src="assete/js/main.js"></script>
</body>