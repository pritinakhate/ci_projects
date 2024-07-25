<?php
include_once ("includes/header.php");
include_once ("includes/config.php");


$update_id = $_GET['id'];

$ans = mysqli_fetch_assoc(mysqli_query($conn,"SELECT blogs.title,blog_categories.category_title,blogs.image,blogs.content FROM blogs 
LEFT JOIN blog_categories ON blogs.blog_category_id = blog_categories.id WHERE blogs.id='$update_id'"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog View</title>

    <style>
        * {
            margin: 0;
            padding: 0
        }

        body {
            background-color: #000
        }

        .card {
            width: 350px;
            background-color: #efefef;
            border: none;
            cursor: pointer;
            transition: all 0.5s;
        }

        .image img {
            transition: all 0.5s
        }

        .card:hover .image img {
            transform: scale(1.3)
        }

        .btn {
            width: 140px;
    height: 140px;
}
            
        

        .name {
            font-size: 22px;
            font-weight: bold
        }

        .idd {
            font-size: 14px;
            font-weight: 600
        }

        .idd1 {
            font-size: 12px
        }

        .number {
            font-size: 22px;
            font-weight: bold
        }

        .follow {
            font-size: 12px;
            font-weight: 500;
            color: #444444
        }

        .btn1 {
            height: 40px;
            width: 150px;
            border: none;
            background-color: #000;
            color: #aeaeae;
            font-size: 15px
        }

        .text span {
            font-size: 13px;
            color: #545454;
            font-weight: 500
        }

        .icons i {
            font-size: 19px
        }

        hr .new1 {
            border: 1px solid
        }

        .join {
            font-size: 14px;
            color: #a0a0a0;
            font-weight: bold
        }

        .date {
            background-color: #ccc
        }
    </style>
</head>

<body>
    <div class="container mt-4  p-3 d-flex justify-content-center">
        <div class="card p-4">

            <div class=" image d-flex flex-column justify-content-center align-items-center"> <button
                    class="btn btn-secondary"> <img src="uploads/blog_image/<?php echo $ans['image'] ?>" height="110"
                        width="110" /></button> <span class="name mt-3"></span>
                <label>Title : - <span class="idd" name="image"><?php echo $ans['title']; ?></span></label>

                <label>
                    Description :-
                    <span class="text mt-3"> <?php echo $ans['content']; ?> </span>

                </label>
                <label class="mt-3">
                    Category : -
                    <span class="">  <?php echo $ans['category_title']; ?></span>
                    </label>
            </div>

           
            </div>
               
        </div>
        <div class="text-center ">
                <a class="btn btn-danger " href="blogs_manage.php" role="button" style="height: 40px; width:120px;">Cancel</a> 
                </div>
    </div>
</body>

</html>