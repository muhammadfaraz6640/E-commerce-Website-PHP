<div>
<?php
include('functions/function.php');
include('Includes/connection.php');
                if(isset($_GET["uid"]))
                {
                  global $con;
                  $del_id = $_GET["uid"];
                  $del_query = "delete from user where Customer_ID = '$del_id' ";
                  $run_del_query = mysqli_query($con , $del_query);
                  if($run_del_query)
                  {
                    echo"<script>alert('Successfully Deleted the User..')</script>";
                    echo"  <script>window.location.href = 'Users.php'</script>";
                  }
                }
              ?>
</div>
<div >
<?php
                if(isset($_GET["pid"]))
                {
                  global $con;
                  $del_id = $_GET["pid"];
                  $del_query = "delete from product where Product_ID = '$del_id' ";
                  $run_del_query = mysqli_query($con , $del_query);
                  if($run_del_query)
                  {
                    echo"<script>alert('Successfully Deleted the Product..')</script>";
                    echo"  <script>window.location.href = 'SeeProducts.php'</script>";
                  }
                }
              ?>
</div>
<div >
<?php
                if(isset($_GET["cid"]))
                {
                  global $con;
                  $del_id = $_GET["cid"];
                  $del_query = "delete from category where Cat_id = '$del_id' ";
                  $run_del_query = mysqli_query($con , $del_query);
                  if($run_del_query)
                  {
                    echo"<script>alert('Successfully Deleted the Category..')</script>";
                    echo"  <script>window.location.href = 'SeeCat.php'</script>";
                  }
                }
              ?>
</div>
<div >
<?php
                if(isset($_GET["bid"]))
                {
                  global $con;
                  $del_id = $_GET["bid"];
                  $del_query = "delete from brand where Brand_id = '$del_id' ";
                  $run_del_query = mysqli_query($con , $del_query);
                  if($run_del_query)
                  {
                    echo"<script>alert('Successfully Deleted the Brand..')</script>";
                    echo"  <script>window.location.href = 'SeeBrand.php'</script>";
                  }
                }
              ?>
</div>