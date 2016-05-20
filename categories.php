<?php session_start(); ?>
<?php require_once "classes/Category.php"; ?>
<?php include "templates/header.php"; ?> 


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="width: 100%;" class="">Categories             
            <?php if(isActiveUserAdmin()){ ?>
                <div class="pull-right btn-group" role="group">
                    <a class="btn btn-primary btn-default" href="register-category.php">Register a new category</a>
                </div>
            <?php } ?>
            </h1>   
        </div>       
    </div>
</div>

<div class="container">
    <div class="row">
        <?php 
        
        if($categories = Category::getAllCategories()){ ?>
        
            <h1 class='title-page col-md-12'></h1> 
            
            <p class='list-title col-md-1'>Id</p>
            <p class='list-title col-md-1'>Name</p>
            <p class='list-title col-md-10'>News with this category</p>
              
            <?php foreach ($categories as $category) { ?>  
                <div class="users-data col-md-12">
                    <span class='col-md-1'><?php echo $category->getId(); ?></span>
                    <span class='col-md-2'><?php echo $category->getName(); ?></span>
                    <span class='col-md-2'><?php echo $category->getNumberNewsForCategory($category->getId()); ?></span>

                    <?php if(isActiveUserAdmin()){ ?>
                        <span class='col-md-1'><a href='edit-category.php?category-id=<?php echo $category->getId(); ?>'>Edit</a></span>
                        <span class='col-md-6'><a class='delete-category' href='controllers/delete-category.php?category-id=<?php echo $category->getId(); ?>'>Delete</a></span>                
                    <?php } ?>
                
                </div>
            <?php }
        } else {
            echo '<h3 class="col-md-12">No categories registered</h3>';
        }

        ?>

    </div>
</div> 

<?php include "templates/footer.php"; ?>

<script type="text/javascript">
    $('.delete-category').on('click', function(e){
        e.preventDefault();
        
        var agree = confirm('Are you sure that want delete this category?');
        if(agree) {
            window.location.href = $(this).attr('href');
        } else {
            return false;
        }
    });    
</script>