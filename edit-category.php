<?php session_start(); ?>
<?php include "templates/header.php"; ?> 
<?php require_once "classes/Category.php"; ?>   

<?php 

if(isset($_GET['category-id'])){
    $id = $_GET['category-id'];
    $category = Category::getCategory($id);
}

?>

<div class="container">
    <div class="row">
        <form method="post" action="controllers/edit-category.php" class="form-news form-horizontal">
        <div class="form-group">
            <h3 class="col-sm-offset-2 col-sm-10">Update category</h3>
        </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" value="<?php echo $category->getName(); ?>" name="name" class="form-control" id="inputName" placeholder="Name">
                    <input type="hidden" value="<?php echo $category->getId(); ?>" name="id">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php include "templates/footer.php"; ?>