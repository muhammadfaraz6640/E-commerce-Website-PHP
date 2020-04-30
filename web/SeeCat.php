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
                     <td>Category Name</td>                                    
                 </tr>
                 <tr>
                 <?php
              global $con;
              $query = "select * from category";
              $run_query = mysqli_query($con , $query);
              $i=0;
              while($rd = mysqli_fetch_array($run_query))
              {
                $C_id = $rd["Cat_id"];
                $C_Name = $rd["Cat_Name"];            
                $i++;
                            
        ?>
                     <td><?php echo"$i" ?></td>
                     <td><?php echo"$C_Name" ?></td>                                          
                     <td><a href="delete.php?cid=<?php echo"$C_id" ?> ">Delete</a></td>
                 </tr>
                 <?php
              }
              ?>
               <?php
                  if(isset($_GET["cid"]))
                  {
                    include("delete.php");
                  }                
              ?>               
            </table>
        </div>
    </body>
</html>
