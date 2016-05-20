<?php session_start(); 

$search = null;
$order = null;
$orderProperty = null;

//$orcder = isset($_COOKIE["order"]) ? $_COOKIE["order"] : null;
//$orderby = isset($_COOKIE["orderby"]) ? $_COOKIE["orderby"] : null;

//10 days in seconds -> time for the cookie
//$int = (86400 * 10);

if(isset($_GET['order'])){
    $order = $_GET['order'];
//    setcookie("order", $order, time()+$int);
}

if(isset($_GET['orderby'])){
    $orderProperty = $_GET['orderby'];   
//    setcookie("orderby", $orderProperty, time()+$int);
}

if(isset($_GET['search'])){
    $search = $_GET['search'];                
}
?>
<?php require_once "classes/News.php"; ?>
<?php require_once "classes/Category.php"; ?>
<?php require_once "templates/header.php"; ?> 


<div class="container">
    <div class="row">
        <h1 class="col-md-12">Recent News!             
        <?php if(isUserLoggedIn()){ ?>
            <div class="pull-right btn-group" role="group">
                <a class="btn btn-primary btn-default" href="register-new.php">Write some New!</a>
            </div>
        <?php } ?>
        </h1>   
    </div>  
</div>

<div class="container">
    <div class="row"> 
        <div class="col-md-12">
            
            <form class="form-order form-inline">
                <label for="select_order_by">Order: </label>
                <select class='form-control' id='select_order_by'>
                    <option value='' disabled>Select an property to order</option> 
                    <option value='date'>Date</option> 
                    <option value='popularity'>Popularity</option> 
                </select>

                <select class='form-control' id='select_order'>                
                    <option value='' disabled>Select an way to order</option> 
                    <option value='asc'>Ascending</option> 
                    <option value='desc'>Descending</option> 
                </select>
            </form>
            
            <?php            
            $news = News::getAllNews($orderProperty, $order, $search);
            if($news){            
                foreach ($news as $new) {
                    ?>
                    <div class="panel">
                    <?php
                        $phpdate = strtotime($new->getDate());  
                        $popularity = $new->getNumberVotes() == 0 ? 0 : round($new->getPopularity()/$new->getNumberVotes(), 2);                    

                        ?>
                    
                        <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3 class="justify pull-left"><a href='new.php?new-id=<?php echo $new->getId(); ?>'><?php echo $new->getTitle(); ?></a></h3>
                                    </div>
                                </div>
                        </div>
            
                        <div class="new-item panel-body">
                            <?php echo truncateText($new->getContent()); ?>
                            <a href='new.php?new-id=<?php echo $new->getId(); ?>'>Read more</a>
                        </div>
                        
                            <div class="panel-footer">
                                <span class="news-footer label label-default"><?php echo date('d/m/Y', $phpdate);?></span> 
                                <span class="news-footer label label-default">Popularity - <?php echo $popularity; ?></span> 
                                
                                <?php if($new->getCategoryId()): $category = Category::getCategory($new->getCategoryId()); ?>
                                <span class="news-footer label label-default"><?php echo $category->getName(); ?></span>
                                <?php endif; ?>
                            </div>  
                    </div>
            
                    <?php
                }
            } else {
                echo "<p>There are no news registered</p>";
            }
            
            ?>
        </div>
    </div>
</div> 


<script type="text/javascript">
    var url = window.location.href;
    
    var order;
    var orderby;
    var search;
    var urlConnection;    
    var nextUrl;
    var cookieTime = 10;
    
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
    
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return false;
    }
    
    function getUrlParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
        return false;
    }
    
    order   = getUrlParameter('order');
    orderby = getUrlParameter('orderby');
    search  = getUrlParameter('search');
    urlConnection = (search == false) ? '?' : '&';
    
    
    if(orderby == false){
        orderby = getCookie('orderby');
        order = getCookie('order');
        if(orderby){
            changeOrderByParameter(null, orderby, urlConnection);  
        }
    }    

    $("#select_order_by").change(function() {   
       changeOrderByParameter(orderby, $(this).val(), urlConnection);               
    });
    
    $("#select_order").change(function() {        
        changeOrderParameter(order, orderby, $(this).val(), urlConnection);         
    });
    
    function changeOrderByParameter(orderby, currentValue, urlConnection){
        if(orderby){
            nextUrl = url.replace('orderby='+orderby, 'orderby='+currentValue);
        } else {
            nextUrl = url+urlConnection+'orderby='+currentValue;                 
        }
        setCookie('orderby', currentValue, cookieTime);
        $(location).attr("href", nextUrl); 
    }
    
    function changeOrderParameter(order, orderby, currentValue, urlConnection){
        if(order){
            nextUrl = url.replace('order='+order, 'order='+currentValue);
        } else if(false == orderby){
            nextUrl = url+urlConnection+'orderby=date&order='+currentValue; 
        } else {
            nextUrl = url+'&order='+currentValue; 
        }       
        setCookie('order', currentValue, cookieTime);
        $(location).attr("href", nextUrl);    
    }              
    
    $(document).ready(function() {
        
        $('#select_order option[value=""]').attr('selected','selected');
        $('#select_order_by option[value=""]').attr('selected','selected');
        
        //select ordering options when page loads
        if (order != null) {            
            $('#select_order option[value='+order+']').attr('selected','selected');
        }  
        
        if (orderby != null) {            
            $('#select_order_by option[value='+orderby+']').attr('selected','selected');
        }           
    });
});
    
</script>


<?php include "templates/footer.php"; ?>