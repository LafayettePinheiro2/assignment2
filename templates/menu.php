<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Assignment 2</a>
            
            <?php $page_name = $_SERVER['SCRIPT_NAME']; ?>
            <ul class="nav navbar-nav">
                <li class="<?php echo (strpos($page_name, 'customers.php') > 0  ? 'active' : ''); ?>">
                    <a href="index.php">News</a>
                </li>                
                <?php if(isUserLoggedIn()){ ?>
                    <li class="<?php echo (strpos($page_name, 'account.php') > 0  ? 'active' : ''); ?>">
                        <a href="users.php">Users</a>
                    </li>
                    <?php if(isActiveUserAdmin()){ ?>
                        <li class="<?php echo (strpos($page_name, 'categories.php') > 0  ? 'active' : ''); ?>">
                            <a href="categories.php">Categories</a>
                        </li>
                     <?php } ?>
                    <li class="">
                        <a href="logout.php">Logout</a>
                    </li>                    
                <?php } else { ?>
                    <li class="<?php echo (strpos($page_name, 'data.php') > 0  ? 'active' : ''); ?>">
                        <a href="login.php">Login</a>
                    </li>
                    
                    <li class="<?php echo (strpos($page_name, 'account.php') > 0  ? 'active' : ''); ?>">
                        <a href="register-user.php">Register</a>
                    </li>
                    
                <?php } ?>
            </ul>
        </div>
        
        <!--SEARCH-->
        <form method="get" action="index.php" class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" value="<?php echo (isset($_GET['search'])) ? $_GET['search'] : ''; ?>" name="search" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default btn-primary">Search</button>
        </form>
        
    </div>
</nav> 