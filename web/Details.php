<?php
include('Includes/connection.php');
include('functions/function.php');
session_start();
?>
<html>
    <head>
        <title>Details</title>
        <link rel = "stylesheet" href = "Styles/sty.css">        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    </head>
<body>
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
        <br />
        <div class="content">
            <?php
                if(isset($_GET["pro_id"]))
                {
                    global $con;
                    $product_id = $_GET["pro_id"];
                    $query = "select * from product where Product_ID = '$product_id' ";
                    $run_query = mysqli_query($con , $query);
                    while($rd = mysqli_fetch_array($run_query))
                       {                            
                            $p_name = $rd["Product_Name"];
                            $p_brand = $rd["Product_Brand"];
                            $p_des = $rd["product_Desc"];
                            $p_img = $rd["Product_Img"];
                            $p_key = $rd["Product_Key"];
                            $p_price = $rd["Product_Price"];
                            $p_cat = $rd["Product_Cat"];
                        }
                            echo" 
                            <div id='one_product'>              
                                <div id='card'>
                                    <img src='Images/$p_img' id='card-img-top-details' />
                                <div class='card-body'>
                                  <h5 id='card-title'> $p_name </h5>
                                  <p id='card-text'>$p_price</p>
                                  <p >$p_des</p>                                                                   
                                </div>
                              </div>
                            </div>
                        ";
                      

                }
            ?>
        </div>
        <!-- <div id = "footer">
                    <h1 style = "text-align : center ; padding-top : 30px">&copy; 2020 by www.onlineshop.com </h2>
        </div>      -->
    </body>    
</html>