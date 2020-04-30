<?php
include('functions/function.php');
include('Includes/connection.php');
?>
<html>
    <head>
        <title>Users</title>
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
       
        <div class="container" >
            <table align:"center" width="800px" id="tab">
                 <tr align:"center" border="10px">
                     <td>S.NO</td>
                     <td>Product Name</td>
                     <td>Product Brand</td>
                     <td>Product Desciption</td>
                     <td>Product Price</td>                     
                     <td>Product Category</td>                    
                     <td>Product Image</td>                    
                 </tr>
                 <tr>
                 <?php
              global $con;
              $query = "select * from product";
              $run_query = mysqli_query($con , $query);
              $i=0;
              while($rd = mysqli_fetch_array($run_query))
              {
                $P_id = $rd["Product_ID"];
                $P_Name = $rd["Product_Name"];
                $P_brand = $rd["Product_Brand"];
                $P_des = $rd["product_Desc"];                
                $P_price = $rd["Product_Price"];
                $P_image = $rd["Product_Img"];
                $P_cat = $rd["Product_Cat"];
                $i++;
                            
        ?>
                     <td><?php echo"$i" ?></td>
                     <td><?php echo"$P_Name" ?></td>
                     <td><?php echo"$P_brand" ?></td>
                     <td><?php echo"$P_des" ?></td>
                     <td><?php echo"$P_price" ?></td>                     
                     <td><?php echo"$P_cat" ?></td>
                     <td><img src="Images/<?php echo"$P_image" ?>" width="70px" height="80px"/></td>                                                           
                     <td><a href="delete.php?pid=<?php echo"$P_id" ?> ">Delete</a></td>
                 </tr>
                 <?php
              }
              ?>
               <?php
                  if(isset($_GET["pid"]))
                  {
                    include("delete.php");
                  }                
              ?>               
            </table>
        </div>
    </body>
</html>
