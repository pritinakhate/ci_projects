<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .user-image {
            max-width: 100px;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }

        .no-data {
            padding: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User List</h1>
        <table id="userTable">
            <thead>
                <tr>
                    <th>Profile Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                </tr>
            </thead>
            <tbody>
                <!-- User list will be dynamically loaded here -->
            </tbody>
        </table>
        <div id="noDataMessage" class="no-data" style="display: none;">
            No users found.
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch all users
            $.ajax({
                url: "<?php echo site_url('Welcome/jquery_ajax_with_all_user_action'); ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        var users = response.data;
                        if (users.length > 0) {
                            var userTableHtml = '';
                            $.each(users, function(index, user) {
                                var profileImage = user.profile_image ? '<?php echo base_url()."uploads/profile_images/"?>' + user.profile_image : '<?php echo base_url()."uploads/default.png"?>';
                                userTableHtml += '<tr>' +
                                    '<td><img src="' + profileImage + '" class="user-image" alt="Profile Image"></td>' +
                                    '<td>' + user.name + '</td>' +
                                    '<td>' + user.email + '</td>' +
                                    '<td>' + user.mobile + '</td>' +
                                    '<td>' + user.country + '</td>' +
                                    '<td>' + user.state + '</td>' +
                                    '<td>' + user.city + '</td>' +
                                    '<td>' + user.gender + '</td>' +
                                    '<td>' + user.hobbies + '</td>' +
                                    '</tr>';
                            });
                            $('#userTable tbody').html(userTableHtml);
                            $('#userTable').DataTable();
                            $('#noDataMessage').hide(); // Hide no data message if data is available
                        } else {
                            $('#userTable tbody').empty(); // Clear table body
                            $('#userTable').DataTable().clear().destroy(); // Destroy DataTable instance if necessary
                            $('#noDataMessage').show(); // Show no data message
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while processing your request.');
                }
            });
        });
    </script>
</body>
</html>
