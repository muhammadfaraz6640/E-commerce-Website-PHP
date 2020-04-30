<?php
include('functions/function.php');
session_start();
?>
<html>
    <head>
        <title>Home</title>
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
        <br />
        <div class="cart_bar" style="background-color: purple">
          <span ><?php  
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
       <div class="contents">      
               <?php
                    if(!isset($_SESSION["Customer_Email"]))
                    {
                        include('login.php');
                    }
                    else{
                        include('payment.php');
                    }
               ?>   
             
        </div>
        <!-- <div id = "footer">
            <h1 style = "text-align : center ; padding-top : 30px">&copy; 2020 by www.onlineshop.com </h2>
        </div>      -->
    </body>    
</html>