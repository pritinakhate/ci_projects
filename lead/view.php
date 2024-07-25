<?php

$conn=mysqli_connect("localhost","root","1100","lead");
$update_id = $_GET['id'];
$ans =mysqli_fetch_assoc( mysqli_query($conn, "SELECT lead_sources.title_sources,  lead_stages.title, leads.id, leads.name, leads.email, leads.phone FROM leads
LEFT JOIN lead_sources ON leads.source_id=lead_sources.id
LEFT JOIN lead_stages ON leads.stage_id=lead_stages.id 
where leads.id='$update_id' " ));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lead view</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>

body{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}

</style>
</head>
<body>
    



<!------ Include the above in your HEAD tag ---------->



<div class="container w-50 emp-profile">
            
                
                    
                        <div class="tab-content profile-tab " id="myTabContent ">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Lead Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $ans['name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $ans['email']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $ans['phone']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Lead Sources</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $ans['title_sources']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Lead Stage</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $ans['title']; ?></p>
                                            </div>
                                        </div>
                                        
                            </div>
                           
                        
                    </div>
                    
                </div>
                <div class="text-center">
                <a class="btn btn-danger " href="lead_manage.php" role="button">Cancel</a> 
                </div>
                
        </div>

        </body>
</html>