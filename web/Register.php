<!DOCTYPE html>
<?php
include('functions/function.php');
include('Includes/connection.php');
session_start();
?>
<html>
    <head>
        <title>Registration</title>
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
          <div class="act">
            <h1>USER REGISTRATION</h1>
          </div>
        <div class="reg-inp">            
          <form method="POST" action="Register.php" class="Register" enctype="multipart/form-data">
            <label>Name </label><br />
            <input type="text" placeholder="Name" name="name"/>    <br />       
            <label>Email </label><br />
            <input type="email" placeholder="Email" name="email"/><br />
            <label>Password </label><br />
            <input type="password" placeholder="Password" name="pass"/><br />
            <label>Country </label><br />
            <select name="country"><br />
                <option>Pakistan</option>
                <option>Malaysia</option>
                <option>Japan</option>
                <option>burma</option>
                <option>Kashmir</option>
                <option>indonesia</option>
            </select>
            <label>Address </label><br />
            <textarea type="text" cols=20 rows=4 placeholder="Your Current Address" name="Address"></textarea><br />
            <label>City </label><br />
            <input type="text" placeholder="City" name="city"/><br />
            <label>Contact Number </label><br />
            <input type="number" placeholder="Contact Number" name="contact"/>
            <label>Photo</label><br />
            <img class="img-pho" src="Images/logo.png" style="width: 64px;height: 64px;">
            <input type="file" name="user"/>            <br />
            <button type="submit" name="register" class="btn btn-secondary btn-lg" >Submit</button>
            <?php            
                if(isset($_POST["register"]))    
                {
                    $server_name = "localhost";
                    $sname = "root";
                    $spassword = "";
                    $dbname = "ecommerce";                                    
                    $con = mysqli_connect($server_name,$sname,$spassword,$dbname);
                    
                    $Name = $_POST["name"];
                    $email = $_POST["email"];
                    $pass = $_POST["pass"];
                    $country = $_POST["country"];
                    $city = $_POST["city"];
                    $address = $_POST["Address"];
                    $user_img = $_FILES["user"]["name"];
                    $contact = $_POST["contact"];
                    $P_image_temp = $_FILES["user"]['tmp_name'];
                    $ip = getIp(); 
                    $folder = "E:/XAMPP/htdocs/test website/Images/users/";
                    move_uploaded_file($P_image_temp,$folder.$user_img);
                    
                    $query = "insert into user (Customer_IP,Customer_Name,Customer_Email,Customer_Pass,Customer_Image,Customer_Country,Customer_Address,Customer_City,Customer_Contact) values('$ip','$Name','$email','$pass','$user_img','$country','$address','$city','$contact')";
                    $is_inserted = mysqli_query($con,$query);
                    // if($is_inserted)
                    // {
                    //     echo "<script>alert('Registered Successfully')</script)";
                    // }
                    // else{
                    //     echo "<script>alert('fill all fields')</script)";
                    // }                
                    $sel_query = "select * from cart where IP_add = '$ip'";
                    $run_sel_query = mysqli_query($con,$sel_query);
                    $count_query = mysqli_num_rows($run_sel_query);
                 
                    if($count_query==0)
                    {                        
                        $_SESSION["Customer_Email"] = $email;
                        echo "<script>alert('Successfully Registered')</script> ";
                      echo"  <script>window.location.href = 'index.php'</script>";
                    }
                    else{
                        $_SESSION["Customer_Email"] = $email;
                        echo "<script>alert('Successfully Registered')</script> ";
                        echo"  <script>window.location.href = 'chckout.php'</script>";
                    }
            }                
            ?>
          </form>  
        </div>
        <div class="act">
          <h1>      </h1>
        </div>                
        <!-- <div id = "footer">
            <h1 style = "text-align : center ; padding-top : 30px">&copy; 2020 by www.onlineshop.com </h2>
        </div>    -->
    </body>
</html>

