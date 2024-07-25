<!DOCTYPE html>
<html lang="en">

<head>
    <title>save data using Ajax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    html,
    body,
    .intro {
        height: 100%;
    }

    table td,
    table th {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    thead th,
    tbody th {
        color: #fff;
    }

    tbody td {
        font-weight: 500;
        color: rgba(100, 255, 255, .65);
    }

    .card {
        border-radius: .5rem;
    }
    </style>
</head>

<body>

    <section class="intro">
        <div class="bg-image h-100"
            style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img2.jpg');">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(10,10,50,.25);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card bg-dark shadow-2-strong">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-borderless mb-0" id="ajaxtable">
                                            <thead>
                                                <tr>
                                                    <th scopr="col">SR No.</th>
                                                    <th scope="col">Profile</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Hobbies</th>
                                                    <th scope="Action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
    // Ajax list
    $(document).ready(function() {
        $.ajax({
            url: "<?php echo site_url('AjaxController/ajaxlist_action') ?>",

            type: "GET",
            dataType: "JSON",
            success: function(response) {
                if (response.status === 'success') {
                    var users = response.data;
                    console.log(users);
                    if (users.length > 0) {
                        var userTableHtml = '';
                        var sr = 1;
                        $.each(users, function(index, user) {
                            var image = user.image ?
                                '<?php echo base_url() . "uploads/ajax_images/"
                                        ?>' + user.image : '<?php echo base_url() . "uploads/demo.jpg"
                                                            ?>';
                            userTableHtml += '<tr>' +
                                '<td>' + sr++ + '</td>' +
                                '<td><img src="' + image +
                                '" class = "user-image" alt="Profile Image" width="50px" ></td>' +
                                '<td>' + user.name + '</td>' +
                                '<td>' + user.email + '</td>' +
                                '<td>' + user.course + '</td>' +
                                '<td>' + user.gender + '</td>' +
                                '<td>' + user.hobby + '</td>' +
                                '<td><a href="<?php echo site_url('AjaxController/update_ajax/')
                                                    ?> ' +
                                user.id +
                                '" ><i class="fas fa-user-edit pr-2 text-warning"></i></a></td>' +
                                '</tr>';
                        });
                        $('#ajaxtable tbody').html(userTableHtml);
                    } else {
                        $('#ajaxtable tbody').empty();

                        alert('User data not available');

                    }
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while processing your request');
            }
        });

    });
    </script>



</body>

</html>