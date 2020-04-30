<?php
include('functions/function.php');
include('Includes/connection.php');
?>
<html>
    <head>
        <title>Insert Product</title>
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
            <form id = "formlayoutinsert" action = "Insert_Product.php" method = "POST" enctype = "multipart/form-data" >                       
                <label class="ins_lab">Product Name</label></br />
                <input type = "text" name = "product_name" /></br />
                <label class="ins_lab">Product Brand</label></br />
                <select name="product_bra">
                    <option >Select a Brand</option>
                    <?php
                        global $con;                                                                                   
                        $query = "SELECT * FROM brand";
                        $run_query = mysqli_query($con, $query);
                        while($rd = mysqli_fetch_array($run_query))
                        {
                            $b_id = $rd["Brand_id"];
                            $b_name = $rd["Brand_Name"];
                            echo "<option value = '$b_id'>$b_name</option>";                                      
                        }
                    ?>
                </select></br />
                <label class="ins_lab">Product Description</label></br />
                <textarea type = "text" name = "product_des" cols='20' rows='4'></textarea> </br />
                <label class="ins_lab">Product Image</label></br /></br />
                <input type = "file" name = "product_image"/> </br />
                <label class="ins_lab">Product Keyword</label></br />
                <input type = "text" name = "product_key" /></br />
                <label class="ins_lab">Product Price</label></br />
                <input type = "number" name = "product_price" /></br />
                <label class="ins_lab">Product Category</label></br />
                <select name="product_cat">
                    <option>Select a Category</option>
                    <?php                        
                        global $con;
                        $query = "SELECT * FROM category";
                        $run_query = mysqli_query($con , $query);
                        while($rd = mysqli_fetch_array($run_query))
                        {
                            $cat_id = $rd["Cat_id"];
                            $cat_name = $rd["Cat_Name"];
                            echo "<option value = '$cat_id'>$cat_name</option>";
                            //echo "$b_name";
                        }
                    ?>
                </select><br />
                <input type = "submit" name = "insert_post" value = "insert Now">               
            <?php            
               
                if(isset($_POST["insert_post"]))    
                {                    
                    global $con;
                    $P_Name = $_POST["product_name"];
                    $P_brand = $_POST["product_bra"];
                    $P_des = $_POST["product_des"];
                    $P_key = $_POST["product_key"];
                    $P_price = $_POST["product_price"];
                    $P_image = $_FILES["product_image"]["name"];
                    $P_cat = $_POST["product_cat"];
                    $P_image_temp = $_FILES["product_image"]['tmp_name'];
                    $folder = "E:/XAMPP/htdocs/test website/Images/";
                    move_uploaded_file($P_image_temp,$folder.$P_image);
                    
                    $query = "insert into product (Product_Name,Product_Brand,product_Desc,Product_Img,Product_Key,Product_Price,Product_Cat) values('$P_Name','$P_brand','$P_des','$P_image','$P_key','$P_price','$P_cat')";
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
