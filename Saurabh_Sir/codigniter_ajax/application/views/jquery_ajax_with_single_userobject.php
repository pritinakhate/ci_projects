<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* User Details Styles */
        .user-details {
            display: none; /* Initially hidden */
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-details h2 {
            margin-top: 0;
        }

        .user-details img {
            max-width: 150px;
            border-radius: 5px;
            margin-bottom: 20px;
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

        .user-image {
            max-width: 150px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User List</h1>
        <button class="btn view-btn" data-id="1">View User 1</button>
        <button class="btn view-btn" data-id="2">View User 2</button>
        <button class="btn view-btn" data-id="10">View User 3</button>
        <!-- Add more buttons or user list as needed -->

        <!-- User Details Section -->
        <div id="userDetails" class="user-details">
            <!-- User details will be dynamically loaded here -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".view-btn").click(function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: "<?php echo site_url('Welcome/jquery_ajax_with_single_userobject_action/'); ?>" + userId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            var user = response.data;
                            var userDetailsHtml = '<h2>' + user.name + '</h2>' +
                                '<img src="<?php echo base_url()."/uploads/profile_images/"?>' + user.profile_image + '" class="user-image" alt="Profile Image">' +
                                '<table>' +
                                '<tr><th>Email</th><td>' + user.email + '</td></tr>' +
                                '<tr><th>Mobile</th><td>' + user.mobile + '</td></tr>' +
                                '<tr><th>Country</th><td>' + user.country + '</td></tr>' +
                                '<tr><th>State</th><td>' + user.state + '</td></tr>' +
                                '<tr><th>City</th><td>' + user.city + '</td></tr>' +
                                '<tr><th>Gender</th><td>' + user.gender + '</td></tr>' +
                                '<tr><th>Hobbies</th><td>' + user.hobbies + '</td></tr>' +
                                '</table>';
                            $('#userDetails').html(userDetailsHtml).show();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while processing your request.');
                    }
                });
            });
        });
    </script>
</body>
</html>
