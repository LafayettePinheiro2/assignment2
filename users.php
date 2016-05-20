<?php session_start(); ?>
<?php require_once "classes/User.php"; ?>
<?php include "templates/header.php"; ?> 

<div class="container">
    <div class="row"> 
        
        <?php if($users = User::getAllUsers()){ ?>  
            
            <h1 class='title-page col-md-12'>Users</h1>
            <p class='list-title col-md-2'>Name</p>
            <p class='list-title col-md-2'>Surname</p>
            <p class='list-title col-md-7'>Email</p>
            
            <?php
            foreach ($users as $usr) {   
                ?>
                <div class="users-data col-md-12">
                
                    <p class='col-md-2'><?php echo $usr->getName(); ?></p>
                    <p class='col-md-2'><?php echo $usr->getSurname(); ?></p>
                    <p class='col-md-2'><?php echo $usr->getEmail(); ?></p>
                    <?php
                    if(isActiveUserAdmin() && !isUserAdmin($usr->getId()) || getActiveUserId() == $usr->getId()){
                        echo "<p class='col-md-1'><a href='edit-user.php?user-id={$usr->getId()}'>Edit</a></p>";
                        echo "<p class='col-md-1'><a class='delete-user' href='controllers/delete-user.php?user-id={$usr->getId()}'>Delete</a></p>";                    
                    }
                    
                    if(isActiveUserAdmin() && ! isUserAdmin($usr->getId())){
                        echo "<p class='col-md-2'><a id='make-user-admin' href='controllers/make-user-admin.php?user-id={$usr->getId()}'>Make this user admin</a></p>";                    
                    }
                    ?>
                </div>    
                <?php
            }
        } else {
            echo '<h3>No users registered</h3>';
        }

        ?>

    </div>
</div> 

<?php include "templates/footer.php"; ?>

<script type="text/javascript">
    $('.delete-user').on('click', function(e){
        e.preventDefault();
        
        var agree = confirm('Are you sure that want delete this user?');
        if(agree) {
            window.location.href = $(this).attr('href');
        } else {
            return false;
        }
    });
    
    $('#make-user-admin').on('click', function(e){
        e.preventDefault();
        
        var agree = confirm('Are you sure that you want to make this user an admin?');
        if(agree) {
            window.location.href = $(this).attr('href');
        } else {
            return false;
        }
    });    
</script>