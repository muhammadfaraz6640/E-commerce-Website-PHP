
<?php
$con = mysqli_connect("localhost","root","","ecommerce");
function get_brand(){
    global $con;
    $query = "select * from brand";
    $run_query = mysqli_query($con , $query);
    while($rd = mysqli_fetch_array($run_query))
    {
        $b_id = $rd["Brand_id"];
        $b_name = $rd["Brand_Name"];
        echo "<a class='dropdown-item' href='Brands.php?brand_id=$b_id'>$b_name</a> ";
    }
                    }
function get_category(){
    global $con;
    $query = "select * from category";
    $run_query = mysqli_query($con , $query);
    while($rd = mysqli_fetch_array($run_query))
    {
        $cat_id = $rd["Cat_id"];
        $cat_name = $rd["Cat_Name"];        
        echo "<a class='dropdown-item'  href='Categories.php?category_id=$cat_id'>$cat_name</a> ";
    }
}
function GetProduct(){
    global $con;
    $query = "select * from product order by RAND() LIMIT 0,8";
    $run_query = mysqli_query($con , $query);
    while($rd = mysqli_fetch_array($run_query))
    {
        $p_id = $rd["Product_ID"];
        $p_name = $rd["Product_Name"];
        $p_brand = $rd["Product_Brand"];
        $p_des = $rd["product_Desc"];
        $p_img = $rd["Product_Img"];
        $p_key = $rd["Product_Key"];
        $p_price = $rd["Product_Price"];
        $p_cat = $rd["Product_Cat"];
        
        echo" 
            <div id='one_product'>              
                <div id='card'>
                    <img src='Images/$p_img' id='card-img-top'  />
                <div class='card-body'>
                  <h5 id='card-title'> $p_name </h5>
                  <p id='card-text'>$p_price</p>
                  <a href='Details.php?pro_id=$p_id' style='float : right; color:darkblue;' >Details</a>
                  <a href='index.php?add_cart=$p_id'> <button style='float : left;' >Add To Cart</button></a>
                </div>
              </div>
            </div>
        ";
    }
}
function GetAllProduct(){
    global $con;
    $query = "select * from product";
    $run_query = mysqli_query($con , $query);
    while($rd = mysqli_fetch_array($run_query))
    {
        $p_id = $rd["Product_ID"];
        $p_name = $rd["Product_Name"];
        $p_brand = $rd["Product_Brand"];
        $p_des = $rd["product_Desc"];
        $p_img = $rd["Product_Img"];
        $p_key = $rd["Product_Key"];
        $p_price = $rd["Product_Price"];
        $p_cat = $rd["Product_Cat"];
        
        echo" 
            <div id='one_product'>              
                <div id='card'>
                    <img src='Images/$p_img' id='card-img-top'  />
                <div class='card-body'>
                  <h5 id='card-title'> $p_name </h5>
                  <p id='card-text'>$p_price</p>
                  <a href='Details.php?pro_id=$p_id' style='float : right; color:darkblue;' >Details</a>
                  <a href='index.php?add_cart=$p_id'> <button style='float : left;' >Add To Cart</button></a>
                </div>
              </div>
            </div>
        ";
    }
}
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function Cart(){

    global $con;
    if(isset($_GET["add_cart"])){
    $ip = getIp();    
    $pro_id = $_GET["add_cart"];
    //checking by ip address so that no one can add to cart a product more than once
    $check_query = "select * from cart where Product_ID = '$pro_id' AND IP_add = '$ip'";
    $run_query = mysqli_query($con , $check_query);
    if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('You Can Add One product at once in a cart and quantity will be ask later')</script> ";
        echo"  <script>window.location.href = 'index.php'</script>";
    }
    else
    {
        $query = "insert into cart (Product_ID,IP_add) values('$pro_id','$ip')";
        $run_query = mysqli_query($con , $query);
        echo"  <script>window.location.href = 'index.php'</script>";
    }
}
}

function GetItems()
{
    global $con;
    if(isset($_GET["add_cart"])){
    $ip = getIp();        
    //checking by ip address so that no one can add to cart a product more than once
    $check_query = "select * from cart where IP_add = '$ip'";
    $run_query = mysqli_query($con , $check_query);
    $count_items=mysqli_num_rows($run_query);
    }
    else{
    $ip = getIp();        
    //checking by ip address so that no one can add to cart a product more than once
    $check_query = "select * from cart where IP_add = '$ip'";
    $run_query = mysqli_query($con , $check_query);
    $count_items=mysqli_num_rows($run_query);
    }
    echo"$count_items";
}
function GetPrice(){
    $total = 0;
    global $con;
    $ip = getIp();        
    $id_query = "select * from cart where IP_add = '$ip'";
    $run_id_query = mysqli_query($con , $id_query);
    while($rd = mysqli_fetch_array($run_id_query))
    {
        $product_id = $rd["Product_ID"];

        $pro_query = "select * from product where Product_ID = '$product_id' ";        
        $run_pro_query = mysqli_query($con , $pro_query);
        while($rd = mysqli_fetch_array($run_pro_query))    
        {
            $pro_price = $rd["Product_Price"];
           // $count = array_sum($pro_price);
            $total += $pro_price;
        }
    }
    echo "$total";
}


?>
