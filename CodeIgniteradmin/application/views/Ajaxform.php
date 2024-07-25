<!DOCTYPE html>
<html lang="en">

<head>
    <title>save data using Ajax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>



    <div class="container">
        <h1 align="center">Ajax Form using CI</h1>
        <div class="form-group">
            <label for="email">Enter Your Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Enter Your Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
        </div>
        <div class="form-group">
            <label for="email">Enter Your Course:</label>
            <input type="text" class="form-control" id="course" placeholder="Enter course" name="course">
        </div>
        <div class="form-group">
            <label for="email">Select your image</label>
            <input type="file" class="form-control" id="image" placeholder="" name="image">
        </div>
        <div>
            <lable class="ml-4 ">Gender</lable>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Male">
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
                <label class="form-check-label" for="flexRadioDefault2">
                    Female
                </label>
            </div>
        </div>
        <br>
        <div>
            <label class="ml-4 ">Choose your Hobby</label>
            <div class="form-check">
                <input class="form-check-input hobbies" type="checkbox" name="hobby" value="Reading" id="hobby">
                <label class="form-check-label" for="flexCheckDefault">
                    Reading
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input hobbies" type="checkbox" name="hobby" value="Writing" id="hobby">
                <label class="form-check-label" for="flexCheckChecked">
                    Writing
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input hobbies" type="checkbox" name="hobby" value="Running" id="hobby">
                <label class="form-check-label" for="flexCheckChecked">
                    Running
                </label>
            </div>
        </div>


        <input type="button" class="btn btn-primary" value="save data" id="butsave">
    </div>

    <script type="text/javascript">
        // Ajax post
        $(document).ready(function() {
            $("#butsave").click(function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var course = $('#course').val();
                var hobbies = [];
                var hobby = $('.hobbies:checked').each(function(index, value) {
                    hobbies.push(this.value);
                });

                var fileInput = $('#image')[0];
                var file = fileInput.files[0];
                var gender = $('input:radio[name=gender]:checked').val();
                console.log(gender);
                console.log(hobbies);
                // console.log(file);

                if (name != "" && email != "" && course != "" && image != "" && gender != "") {
                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('course', course);
                    formData.append('image', file);
                    formData.append('gender', gender);
                    formData.append('hobby', hobbies);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('AjaxController/savedata'); ?>",
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(response) {

                            // if (res == 1) {
                            //     console.log(res, status);

                            $('#name').val('');
                            $('#email').val('');
                            $('#course').val('');
                            $('#image').val('');
                            $('input:radio[name=gender]').prop('checked', false);
                            $('.hobbies').prop('checked', false);


                            alert('Data saved successfully');

                        },
                        error: function() {
                            alert('data not saved');
                        }
                    });
                } else {
                    alert("pls fill all fields first");
                }

            });
        });
    </script>

</body>

</html>