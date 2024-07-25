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
		header("location:lead_manage.php");
	}
	else
	{
	 $del=0;
	 $nondel=0;	
	
	foreach($ids as $id)
	{
		//to fetch id of city against token id 
	$getleaddata = mysqli_fetch_assoc(mysqli_query($conn,"select id from leads where id='$id'"));
    
		//if associated with id with users and city and location
		if(!isset($getleaddata['id']) || empty($getleaddata['id']))
	{
		// after fetching no record found then reditect to list page
		header("location:lead_manage.php");
		$nondel=0;
	}
	else
	{
		//remove data from table 
		mysqli_query($conn,"DELETE FROM leads where id='".$getleaddata['id']."'");
		//remove attachments from folder
		
		$del++;
		//header("location:lead_manage.php");
	}
	}
	$massage = $del."Record has been deleted".'&nbsp'.'&nbsp'.$nondel."Unable to delete record<br/>";
}
}

$getalllead = mysqli_query($conn, "SELECT lead_sources.title_sources,  lead_stages.title, leads.id, leads.name, leads.email, leads.phone FROM leads
LEFT JOIN lead_sources ON leads.source_id=lead_sources.id
LEFT JOIN lead_stages ON leads.stage_id=lead_stages.id ORDER BY id DESC" );

?>

<body>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>


    <div class="panel-heading">
        <h3 class="panel-title text-center mt-3">Lead List</h3>
    </div>
    <br />
    <div class="text text-center">
        <?php if(isset($massage) && !empty($massage)) { ?>
        <span class="alert alert-danger">
            <?= $massage ?>
        </span>
        <?php } ?>
    </div>

    <div class="container w-75">
        <a class="btn btn-primary float-end" href="lead_create.php" role="button">Create</a>
        <form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
            <table id="myTable" class="table table-striped table-bordered " id="mytable">
                <thead class="table-light ">
                    <tr>
                        <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                        <th>Sr.</th>
                        <th>Sources</th>
                        <th>Stages</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;
        while($row = mysqli_fetch_array($getalllead)){
            ?>
                    <tr>
                        <td><input type="checkbox" name="selector[]" value="<?php echo ($row['id']);?>" /></td>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['title_sources'] ?></td>
                        <td><?php echo $row['title']?></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>

                        <td><button type="button" class="btn">
                                <a href="lead_update.php?id=<?php echo $row['id']; ?>"><i style="color: #c98a1e;"
                                        class="fa-solid fa-pencil"></i></a>
                            </button>
                            <button type="button" class="btn">
                                <a href="lead_delete.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                        class="fa-solid fa-trash"></i></a>
                                <button type="button" class="btn">
                                    <a href="view.php?id=<?php echo $row['id'];?>"><i style="color: #d80827; "
                                            class="fa-regular fa-eye"></i></a>
                                            
                                </button>
                        </td>
                    </tr>
                    <?php }?>



                </tbody>
                <tr>
                    <td colspan="8"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button>
                    </td>
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