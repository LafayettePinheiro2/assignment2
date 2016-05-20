<?php session_start(); 

require_once "functions.php"; 
 
if (!isUserLoggedIn()){
    $homepage = getHomepage();
    header("Location: {$homepage}");
    exit();
}

include "templates/header.php"; 
require_once "classes/Category.php"; ?> 

<div class="container">
    <div class="row">
        <form method="post" action="controllers/register-new.php" class="form-news form-horizontal">

            <h3 class=" text-center register-form-title">Write some new!</h3>
            <div class="form-group">
                <label for="inputTitle" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" required name="title" class="form-control" id="inputTitle" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContent" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="content" required id="inputContent" rows="15" placeholder="Content"></textarea>
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
                    <button type="submit" class="btn btn-default btn-primary">Register New</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>