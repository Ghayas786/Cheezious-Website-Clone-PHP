<div class="top-bar animate-dropdown" style="background-color: yellow;">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <!-- Display welcome message if user is logged in -->
                    <?php if (!empty($_SESSION['login'])): ?>
                        <li>
                            <a href="#" style="color: red;">
                                <i class="icon fa fa-user" style="color: red;"></i>
                                Welcome - <?php echo htmlentities($_SESSION['username']); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li><a href="my-account.php" style="color: red;"><i class="icon fa fa-user" style="color: red;"></i> My Account</a></li>
                    <li><a href="my-wishlist.php" style="color: red;"><i class="icon fa fa-heart" style="color: red;"></i> Wishlist</a></li>
                    <li><a href="my-cart.php" style="color: red;"><i class="icon fa fa-shopping-cart" style="color: red;"></i> My Cart</a></li>

                    <!-- Login/Logout link -->
                    <?php if (empty($_SESSION['login'])): ?>
                        <li><a href="login.php" style="color: red;"><i class="icon fa fa-sign-in" style="color: red;"></i> Login</a></li>
                    <?php else: ?>
                        <li><a href="logout.php" style="color: red;"><i class="icon fa fa-sign-out" style="color: red;"></i> Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li>
                        <a href="track-orders.php" class="dropdown-toggle" style="color: red;">
                            <span class="key">Track Order</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
