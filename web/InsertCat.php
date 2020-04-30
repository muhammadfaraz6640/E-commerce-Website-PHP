<?php
include('functions/function.php');
include('Includes/connection.php');
?>
<html>
    <head>
        <title>Insert Category</title>
        <link rel = "stylesheet" href = "Styles/sty.css">        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    </head>
    <body >
    <section id = "nav-bar">                        
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand" href="AdminHome.php">E-Commerce</a>           
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="Insert_Product.php">Insert Product</a>                        
                    </li>    
                    <li class="nav-item active">
                    <a class="nav-link" href="InsertBrand.php">Insert Brand</a>
                    </li>                   
                    <li class="nav-item active">
                        <a class="nav-link" href="InsertCat.php">Insert Category</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="Users.php">Users</a>
                    </li>                   
                    <li class="nav-item active">
                        <a class="nav-link" href="SeeProducts.php">Products</a>
                    </li>                   
                    <li class="nav-item active">
                        <a class="nav-link" href="SeeCat.php">Categories</a>
                    </li>                   
                    <li class="nav-item active">
                        <a class="nav-link" href="SeeBrand.php">Brands</a>
                    </li>                   
                  </ul>                
                </div>                                          
              </nav>
        </section>
        <div class="container">
            <form id = "formlayoutinsert" action = "InsertCat.php" method = "POST" enctype = "multipart/form-data" >                       
                <label class="ins_lab">Category Name</label></br />
                <input type = "text" name = "cat_name"/></br />              
                <input type = "submit" name = "insert_cat" value = "insert Now">
            
            <?php            
                if(isset($_POST["insert_cat"]))    
                {
                    // $server_name = "localhost";
                    // $sname = "root";
                    // $spassword = "";
                    // $dbname = "ecommerce";                                    
                    // $con = mysqli_connect($server_name,$sname,$spassword,$dbname);
                    global $con;
                    $c_Name = $_POST["cat_name"];
                    $query = "insert into Category (Cat_Name) values('$c_Name')";
                    $is_inserted = mysqli_query($con,$query);
                    if($is_inserted)
                    {
                        echo "<script>alert('Data Inserted Successfully')</script)";
                    }
                    else{
                        echo "<script>alert('fill all fields')</script)";
                    }
                
            }                
            ?>
            </form>
        </div>
    </body>
</html>
