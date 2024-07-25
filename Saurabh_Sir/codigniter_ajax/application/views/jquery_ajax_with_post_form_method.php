<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save User Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        input[type="text"], input[type="email"], input[type="file"], select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="radio"], input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .alert {
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #28a745;
        }

        .alert-error {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <form id="userForm" enctype="multipart/form-data">
        <h1>User Form</h1>
        
        <label for="profile_image">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image"><br>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required><br>

        <label for="mobile">Mobile</label>
        <input type="text" name="mobile" id="mobile" placeholder="Mobile"><br>
        
        <label for="country">Country</label>
        <select name="country" id="country" required>
            <option value="" disabled selected>Select a country</option>
            <option value="USA">USA</option>
            <option value="Canada">Canada</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label for="state">State</label>
        <select name="state" id="state" required>
            <option value="" disabled selected>Select a state</option>
            <option value="California">California</option>
            <option value="New York">New York</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label for="city">City</label>
        <select name="city" id="city" required>
            <option value="" disabled selected>Select a city</option>
            <option value="Los Angeles">Los Angeles</option>
            <option value="New York City">New York City</option>
            <!-- Add more options as needed -->
        </select><br>
        
        <label>Gender</label>
        <input type="radio" name="gender" value="male" required> Male
        <input type="radio" name="gender" value="female"> Female<br>
        
        <label>Hobbies</label>
        <input type="checkbox" name="hobbies[]" value="reading"> Reading
        <input type="checkbox" name="hobbies[]" value="traveling"> Traveling
        <input type="checkbox" name="hobbies[]" value="cooking"> Cooking<br>
        
        <button type="button" id="submitBtn">Save</button>
    </form>

    <!-- Modal -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalMessage" class="alert"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function() {
                var formData = new FormData($("#userForm")[0]);

                $.post({
                    url: '<?php echo site_url("Welcome/jquery_ajax_with_post_form_method_action"); ?>', 
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var data = JSON.parse(response);
                        var message = data.message;
                        var status = data.status;
                        var alertClass = status === 'success' ? 'alert-success' : 'alert-error';

                        $("#modalMessage").removeClass('alert-success alert-error').addClass(alertClass).text(message);
                        $("#responseModal").show();
                    },
                    error: function(xhr, status, error) {
                        $("#modalMessage").removeClass('alert-success').addClass('alert-error').text('An error occurred while processing your request.');
                        $("#responseModal").show();
                    }
                });
            });

            $(".close").click(function() {
                $("#responseModal").hide();
            });

            $(window).click(function(event) {
                if ($(event.target).is("#responseModal")) {
                    $("#responseModal").hide();
                }
            });
        });
    </script>
</body>
</html>
