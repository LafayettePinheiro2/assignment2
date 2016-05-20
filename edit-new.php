<?php session_start(); ?>
<?php include "templates/header.php"; ?> 
<?php require_once "classes/News.php"; ?>   

<?php 

if(isset($_GET['new-id'])){
    $id = $_GET['new-id'];
    $new = News::getNewBy('id', $id);
}

?>

<div class="container">
    <div class="row">
        <form method="post" action="controllers/edit-new.php" class="form-news form-horizontal">
        <h3 class="text-center register-form-title">Update the new!</h3>
            <div class="form-group">
                <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $new->getTitle(); ?>" name="title" class="form-control" id="inputTitle" placeholder="Title">
                    <input type="hidden" value="<?php echo $new->getId(); ?>" name="id">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContent" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="content" id="inputContent" rows="15" placeholder="Content"><?php echo $new->getContent(); ?></textarea>
                </div>
            </div>
        
            <?php            
            $categories = Category::getAllCategories();
            if($categories){                
            ?>
            
            <div class="form-group">
                <label for="category-choose" class="col-sm-2 control-label">Category: </label>
                <div class="col-sm-4">
                    <select class="form-control" id="category-choose" name="category">
                        <option  value ="">Select an category</option>                        
                        <?php  
                        foreach($categories as $category){
                            echo "<option value='{$category->id}'>{$category->name}</option>";
                        }
                        ?>
                    </select>                    
                </div>
            </div>            
            
           <?php } ?> <!-- END IF CATEGORIES-->
        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-primary">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script type=text/javascript>
$(document).ready(function() {
    
    //selecting current category when loading page
    
    var categoryId = <?php echo $new->getCategoryId(); ?>;
    if(categoryId) {
        $('#category-choose option[value='+categoryId+']').attr('selected','selected');      
    }      
});    
</script>

<?php include "templates/footer.php"; ?>