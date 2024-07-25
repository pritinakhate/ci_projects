<?php
include_once("includes/config.php");
include_once("includes/header.php");

$view_id = $_GET['id'];
$getallproduct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_categories.category_name,  product_subcategories.subcategory_name, products.id, products.product_name, products.description,products.price, products.image, products.status FROM products
LEFT JOIN product_categories ON products.product_category_id=product_categories.id
LEFT JOIN product_subcategories ON products.product_subcategory_id=product_subcategories.id WHERE products.id = '$view_id'" ));


$ans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM  products WHERE id = '$view_id'"));



?>

<body>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container  py-5 h-100">
            <table class=" mt-3 table  table-info table-striped ">


                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-10 mb-4 mb-lg-0">
                        <div class="card  mb-3" style="border-radius: .5rem;">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-black"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="uploads/product_image/<?php echo $getallproduct['image'] ?>" alt=""
                                        class="img-fluid my-5" style="width: 80%;" />
                                    <h5><?php echo $getallproduct['product_name'];?></h5>

                                    <i class="far fa-edit mb-5"></i>
                                </div>
                                <div class="col">
                                    <div class="card-body  p-4">
                                        <h6 class="text-center">Product Information</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1 ">
                                            <div class="col mb-3">
                                                <h6>Description</h6>
                                                <p class="text-muted"><?php echo$getallproduct['description']; ?></p>
                                            </div>

                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3 mx-auto">
                                                <h6>Product Category</h6>
                                                <p class="text-muted"><?php echo $getallproduct['category_name']; ?></p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Product Subcategory</h6>
                                                <p class="text-muted"><?php echo $getallproduct['subcategory_name']; ?>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="row ">
                                            <div class="col-6 mb-3">
                                                <h6>Price</h6>
                                                <p class="text-muted"><?php echo $getallproduct ['price']; ?></p>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <h6>Status</h6>
                                                <p class="text-muted"><?php echo $getallproduct['status'];?></p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <a class="btn btn-danger " href="product_manage.php" role="button">Cancel</a>
                        </div>
                    </div>

                </div>

            </table>

        </div>
    </section>
</body>