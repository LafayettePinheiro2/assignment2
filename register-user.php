<?php session_start(); ?>
<?php include "templates/header.php"; ?>

<div class="container">
    <div class="row">
        <h3 class="register-form-title">Become a member</h3>
        <form method="post" action="controllers/register-user.php" class="form-horizontal form-register">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSurname" class="col-sm-2 control-label">Surname</label>
                <div class="col-sm-5">
                    <input type="text" name="surname" class="form-control" id="inputSurname" placeholder="Surname">
                </div>
            </div>
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
                <label for="inputConfirmPassword" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>