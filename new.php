<?php session_start(); ?>
<?php require_once "classes/News.php"; ?>
<?php require_once "templates/header.php"; ?>  

<div class="container">
    <div class="row"> 
        <div class="col-sm-12">
            <?php

            $id = $_GET['new-id'];

            if($new = News::getNew($id)){
                
                ?>
                <div class="panel">
                    <?php
                        $phpdate = strtotime($new->getDate());  
                        $popularity = $new->getNumberVotes() == 0 ? 0 : round($new->getPopularity()/$new->getNumberVotes(), 2);                                            
                    ?>
                    
                    
                        <div class="panel-heading">
                            
                        <?php if(activeUserOwnsPost($id) || isActiveUserAdmin()): ?>   
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class='btns-new  btn btn-primary btn-default'><a href='edit-new.php?new-id=<?php echo $id; ?>'>Edit</a></button>
                                    <button class='btns-new  btn btn-primary btn-danger'><a id='delete-new' href='controllers/delete-new.php?new-id=<?php echo $id; ?>'>Delete</a></button>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="justify"><a href='new.php?new-id=<?php echo $new->getId(); ?>'><?php echo $new->getTitle(); ?></a></h3>
                                    </div>
                                    <div class="col-sm-2">
                                        <h4 class="">
                                            <small>
                                            <strong>
                                                <em><?php echo trim(date('d/m/Y', $phpdate)); ?> </em> 
                                                <br />
                                                <em>Popularity - <?php echo $popularity; ?></em>                                            
                                                <br />
                                                <em>Number of votes - <?php echo $new->getNumberVotes(); ?></em>                                            
                                            </strong>
                                            </small>
                                        </h4>
                                    </div>
                                </div>
                        </div>
            
                        <div class="new-item panel-body">
                            <?php echo $new->getContent(); ?>
                        </div>
                    
                    </div>            
                            
                <?php 
                $cookieData = array();
                if(isset($_COOKIE['votes'])) {
                    $cookieData = $cookieData = json_decode($_COOKIE['votes'], true);
                }
                var_dump($_COOKIE);
                ?>
                <form class="form-inline" method="post" action="controllers/popularity-vote.php" id="popularity-form">
                    <div class="form-group">
                        <input type="hidden" name="new-id" value="<?php echo $id; ?>" />
                        <label for="popularity-vote">Rank this new: </label>
                        <select class="form-control" id="popularity-vote" name="popularity" form="popularity-form">
                            <option value = "0">0</option>
                            <option value = "1">1</option>
                            <option value = "2">2</option>
                            <option value = "3">3</option>
                            <option value = "4">4</option>
                            <option value = "5">5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Rank</button>
                </form>

                <?php                               
            } else {
                echo '<h3>The new was not found</h3>';
            }

            ?>
        </div>
    </div>
</div> 

<?php include "templates/footer.php"; ?>

<script type="text/javascript">
    $('#delete-new').on('click', function(e){
        e.preventDefault();
        
        var agree = confirm('Are you sure that want delete this new?');
        if(agree) {
            window.location.href = $(this).attr('href');
        } else {
            return false;
        }
    });    
</script>