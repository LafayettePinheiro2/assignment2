<?php session_start(); ?>
<?php include "templates/header.php"; ?>  

<div class="container">
    <div class="row">
        <form method="post" action="controllers/login.php" class="form-login form-horizontal">
            <h3 class="register-form-title">Login</h3>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div>
        </form>

    </div>
</div>


<?php include "templates/footer.php"; ?>