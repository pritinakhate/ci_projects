<?php 
$url=(basename($_SERVER['PHP_SELF']));
	
  ?>
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body {

    background-image: linear-gradient(to right top, #e6dae0, #dbced8, #cec3d2, #bfb9cb, #afafc5, #a7afc6, #9eb0c7, #95b0c6, #95bacc, #98c4d0, #9dcdd2, #a5d6d3);
}

nav {
    max-width: 960px;
    mask-image: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, #ffffff 25%, #ffffff 75%, rgba(255, 255, 255, 0) 100%);
    margin: 0 auto;
    padding: 30px 0;
}

nav ul {
    text-align: center;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.2) 25%, rgba(255, 255, 255, 0.2) 75%, rgba(255, 255, 255, 0) 100%);
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    padding: 18px;
    font-family: "Open Sans";
    text-transform: uppercase;
    color: rgba(0, 35, 122, 0.5);
    font-size: 18px;
    text-decoration: none;
    display: block;
}

nav ul li a:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), inset 0 0 1px rgba(255, 255, 255, 0.6);
    background: rgba(255, 255, 255, 0.1);
    color: rgba(0, 35, 122, 0.7);
}
</style>

<body>
    <nav>
        <ul>
            <li <?php echo ($url=="product_manage.php" || $url=="product_create.php")?"class='active'":''; ?>><a
                    href="product_manage.php">Home</a></li>
            <li <?php echo ($url=="subcategory_manage.php" || $url=="subcategory_create.php")?"class='active'":''; ?>><a
                    href="subcategory_create.php">Create Subcategories</a></li>
            <li <?php echo ($url=="category_manage.php" || $url=="category_create.php")?"class='active'":''; ?>><a
                    href="category_create.php">Create Categories</a></li>
            <li <?php echo ($url=="product_manage.php" || $url=="product_create.php")?"class='active'":''; ?>><a
                    href="product_create.php">Create Product</a></li>


        </ul>
    </nav>
</body>