<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer d-flex justify-content-start">
                        <ul class="nav navbar-nav flex-row">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <?php
                            $sql = mysqli_query($con, "SELECT id, categoryName FROM category LIMIT 6");
                            while ($row = mysqli_fetch_array($sql)) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="category.php?cid=<?php echo $row['id']; ?>">
                                        <?php echo $row['categoryName']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul><!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
