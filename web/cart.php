<?php
include('functions/function.php');
session_start();
?>
<html>
    <head>
        <title>Cart</title>
        <link rel = "stylesheet" href = "Styles/sty.css">        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    </head>
<body >
    <section id = "nav-bar">                        
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand" href="index.php">E-Commerce</a>
            <div class="search">
                <form method = "get" action = "result.php" enctype="multipart/form-data">
                            <input type = "text" name = "searchbox" placeholder = "search any product"/>
                            <input type = "submit" name = "search" value = "search"/>
                </form> 
            </div>          
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <div class="dropdown">
                        <button  class="btn  dropdown-toggle" type="button" id="brands" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Brands
                        </button>
                        <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                                get_brand();
                            ?>                          
                        </div>
                        </div>
                    </li>    
                    <li class="nav-item active">
                        <div class="dropdown">
                        <button  class="btn  dropdown-toggle" type="button" id="brands" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </button>
                        <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                                get_category();
                            ?>                          
                        </div>
                        </div>
                    </li>                   
                    <li class="nav-item active">
                        <a class="nav-link" href="about.php">AboutUs</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="All_Products.php">All Products</a>
                    </li>   
                    <li class="nav-item active">
                      <a class="nav-link" href="UserComments.php">Reviews</a>                  
                    </li>
                    <li class="nav-item active">
                        <div class="log">                
                        <?php
                                if(!isset($_SESSION["Customer_Email"]))
                                {
                                    echo"<a href='login.php'>Login/Register</a>";
                                }
                                else{
                                    echo"<a href='Logout.php'>LogOut</a>";
                                }
                                ?>
                        </div>
                    </li>
                  </ul>                
                </div>                                          
              </nav>
        </section>      
        <div class="cart_bar" style="background-color: purple">
          <span > <?php  
                    if(isset($_SESSION["Customer_Email"]))
                    {
                        echo"<b> Welcome</b> <b style='color:white; opacity:0.6';>".$_SESSION["Customer_Email"]."</b> <b>Your</b> ";
                    }
                    else{
                        echo"Welcome Guest..!!";
                    }
                  ?>
            <b >TOTAL ITEMS <?php GetItems(); ?> : TOTAL PRICE <?php GetPrice(); ?>  </b>
            <a href="cart.php">Go To Cart </a>
        </span>
        </div>  
        
       <div class="content-cart">                 
                  <br />
            <form method="post" action="cart.php" enctype="multipart/form-data">            
                <table width ="700px" align="center" bgcolor="violet">
                    <tr align="center" style="font-weight: bolder"  bgcolor="purple">
                        <td>Products</td>
                        <td>Quantity</td>
                        <td>Remove</td>
                        <td>Total Price</td>
                    </tr>
                    <?php
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
                                $p_name = $rd["Product_Name"];                                                                
                                $p_img = $rd["Product_Img"];                                
                                $p_price = $rd["Product_Price"];                                
                                $total += $pro_price;                                                      
                    ?>

                    <tr align="center">
                        <td><?php echo" $p_name " ?> <br />
                            <img src="Images/<?php echo"$p_img"?>" width="70px" height="50px"/></td>
                        <td><input type="number" name="qty" size="5"/></td>
                        <?php
                            if(isset($_POST["Update_cart"]))
                            {
                                $ip = getIp(); 
                                $qty_local = $_POST["qty"];
                                $update_query = "update cart set Qty = '$qty_local' where IP_add = '$ip' ";
                                $run_update_query = mysqli_query($con , $update_query);

                                $total = $total* $qty_local;
                            }
                        ?>
                        <td><input type="checkbox" name="remove[]" value="<?php echo"$product_id" ?>"/></td>
                        <td><?php echo" $pro_price " ?></td>
                    </tr>                    
                   
                    <?php
                              }
                            }
                    ?>
                     <br />
                    <tr align="center" bgcolor="purple" style="font-weight: bolder">
                        <td></td>                        
                        <td></td>                        
                        <td></td>                        
                        <td><?php echo" $total " ?></td>
                    </tr>
                    <tr align="center" bgcolor="transparent" style="font-weight: bolder">
                        <td colspan="2"><input type="submit" name="Update_cart" value="Update Cart" /></td>                        
                        <td><input type="submit" name="continue" value="Continue Shopping"/></td>                        
                        <td><button><a href="chckout.php" style="text-decoration:none; color:black;">CheckOut</a></button></td>                                                
                    </tr>
                </table>                                
                
            </form>
            <?php 
                function update_removefromcart()
                {
                    global $con;
                    $ip = getIp(); 
                    if(isset($_POST["Update_cart"]))
                    {
                        foreach($_POST["remove"] as $rem_id)
                        {
                            $del_cart_query = "delete from cart where IP_add = '$ip' AND Product_ID = '$rem_id' ";
                            $run_del_query = mysqli_query($con , $del_cart_query);
                            if($run_del_query)
                            {
                                echo"  <script>window.location.href = 'cart.php'</script>";
                            }
                            else{
                                echo"  <script>alert('please select item then continue')</script>";
                            }
                        }
                    }
                ?>
                <?php
                    global $con;
                    $ip = getIp(); 
                    if(isset($_POST["continue"]))
                    {
                        echo"  <script>window.location.href = 'index.php'</script>";                        
                    }
                    
                }
                echo @$up = update_removefromcart();
                ?>
        </div>
        <!-- <div id = "footer">
                    <h1 style = "text-align : center ; padding-top : 30px">&copy; 2020 by www.onlineshop.com </h2>
        </div>      -->
    </body>    
</html>