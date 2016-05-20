<?php session_start(); ?>
<?php include "templates/header.php"; ?>  
<?php require_once "classes/User.php"; ?>     
<?php require_once "functions.php"; ?>     

<?php 

if(isset($_GET['user-id'])){
    $id = $_GET['user-id'];
    $user = User::getUserBy('id', $id);
}

?>

<div class="container">
    <div class="row">
        <h3 class="register-form-title">Update User</h3>
        <form method="post" action="controllers/edit-user.php" class="form-horizontal form-register">
            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-5">
                    <input type="text" required name="name" value="<?php echo $user->getName(); ?>" class="form-control" id="inputName" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSurname" class="col-sm-2 control-label">Surname</label>
                <div class="col-sm-5">
                    <input type="text" required name="surname" value="<?php echo $user->getSurname(); ?>" class="form-control" id="inputSurname" placeholder="Surname">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" disabled name="email" value="<?php echo $user->getEmail(); ?>" class="form-control" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <span class="form-info">(leave it blank if you don't want to change the password)</span>
                <label for="inputPassword" class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="New Password">
                </div>
            </div>
            <div class="form-group">
                <span class="form-info">(leave it blank if you don't want to change the password)</span>
                <label for="inputConfirmPassword" class="col-sm-2 control-label">Confirm New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Confirm New Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-primary">Edit User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>