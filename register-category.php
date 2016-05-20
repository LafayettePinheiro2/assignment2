<?php session_start(); ?>
<?php require_once "functions.php"; ?> 
<?php if(!isUserLoggedIn()): $homepage = getHomepage(); header("Location: {$homepage}"); exit(); endif; ?>

<?php include "templates/header.php"; ?> 

<div class="container">
    <div class="row">
        <form method="post" action="controllers/register-category.php" class="form-news form-horizontal">
          
            <h3 class=" text-center register-form-title">Register new category</h3>
            <div class="form-group">
                <label for="inputTitle" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" name="name" class="form-control" id="inputTitle" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-primary">Register category</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>