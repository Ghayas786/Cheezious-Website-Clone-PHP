<?php
session_start();
error_reporting(0);
include('includes/config.php');
$find = "%{$_POST['product']}%";

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if (mysqli_num_rows($query_p) != 0) {
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => 1, "price" => $row_p['productPrice']);
            echo "<script>alert('Product has been added to the cart')</script>";
            echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
        } else {
            $message = "Product ID is invalid";
        }
    }
}

// Code for Wishlist
if (isset($_GET['pid']) && $_GET['action'] == "wishlist") {
    if (strlen($_SESSION['login']) == 0) {
        header('location:login.php');
    } else {
        mysqli_query($con, "insert into wishlist(userId,productId) values('" . $_SESSION['id'] . "','" . $_GET['pid'] . "')");
        echo "<script>alert('Product added in wishlist');</script>";
        header('location:my-wishlist.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Product Category</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body class="cnt-home">
<header class="header-style-1">
  
    <?php include('includes/top-header.php'); ?>
    <?php include('includes/main-header.php'); ?>
    <?php include('includes/menu-bar.php'); ?>
</header>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row outer-bottom-sm'>
            <div class='col-md-12'>
                <!-- Banner Section -->
                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">    
                        <div class="image">
                            <img src="assets/images/banners/cat-banner-3.jpg" alt="" class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active" id="grid-container">
                            <div class="category-product inner-top-vs">
                                <div class="row">
                                    <?php
                                    $ret = mysqli_query($con, "SELECT * FROM products WHERE productName LIKE '$find'");
                                    $num = mysqli_num_rows($ret);
                                    if ($num > 0) {
                                        while ($row = mysqli_fetch_array($ret)) { 
                                            $imagePath = "admin/productimages/" . htmlentities($row['id']) . "/" . htmlentities($row['productImage1']);
                                            if (!file_exists($imagePath)) {
                                                $imagePath = "assets/images/no-image.png"; // Fallback image
                                            }
                                    ?>                          
                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                <div class="products">                
                                                    <div class="product">        
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                    <img src="assets/images/blank.gif" 
                                                                         data-echo="<?php echo $imagePath; ?>" 
                                                                         alt="Product Image" width="200" height="300">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name">
                                                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                                    <?php echo htmlentities($row['productName']); ?>
                                                                </a>
                                                            </h3>
                                                            <div class="product-price">    
                                                                <span class="price">
                                                                    Rs. <?php echo htmlentities($row['productPrice']); ?>
                                                                </span>
                                                                <span class="price-before-discount">
                                                                    Rs. <?php echo htmlentities($row['productPriceBeforeDiscount']); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <?php if ($row['productAvailability'] == 'In Stock') { ?>
                                                                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                                                <i class="fa fa-shopping-cart"></i>                                                    
                                                                            </button>
                                                                            <a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                                                                <button class="btn btn-primary" type="button">Add to cart</button>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <div class="action" style="color:red">Out of Stock</div>
                                                                        <?php } ?>
                                                                    </li>
                                                                    <li class="lnk wishlist">
                                                                        <a class="add-to-cart" 
                                                                           href="category.php?pid=<?php echo htmlentities($row['id']) ?>&action=wishlist" 
                                                                           title="Wishlist">
                                                                           <i class="icon fa fa-heart"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php 
                                        } 
                                    } else { ?>
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <h3>No Product Found</h3>
                                        </div>
                                    <?php } ?>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>

<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
