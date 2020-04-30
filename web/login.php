<br />
<?php
include_once('functions/function.php');
include('Includes/connection.php');
session_start();
?>
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
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <table style="margin-left:'300px'" width ="500px" align="center" bgcolor="">
        <tr>
            <td><label style="font-weight:bolder">Email</label></td>
            <td><input placeholder="Email" type="email" name="email" required></td> <br />
        </tr>
        <tr>
            <td><label style="font-weight:bolder">Password</label></td>
            <td><input placeholder="Password" type="password" name="pass" required></td>
        </tr>
        <tr>
            <td colspan=1></td>
            <td><a style=" color:black" href="forgotpass.php">forgot password?recover</a></td>
        </tr>
        <tr>
        <td colspan=1></td>
            <td><a style="color:black" href="Register.php">Donot Have Account?Register?recover</a></td>
        </tr>
        <tr>
        <td colspan=1></td>
            <td><input type="submit" name="login" value="Login"/></td>
        </tr>
        <?php
             if(isset($_POST["login"]))   
             {
                global $con;
                //data from textboxes
                $email = $_POST["email"];
                $pass = $_POST["pass"];
                $ip = getIp(); 
                $o_Email = "";
                //data extraction from db
                $query = "select * from user where Customer_Email = '$email' AND Customer_Pass = '$pass' ";
                $run_query = mysqli_query($con , $query);
                while($rd = mysqli_fetch_array($run_query))
                {           
                     $o_Email = $rd["Customer_Email"];                 
                     $o_Pass = $rd["Customer_Pass"];
                }
                if($o_Email == $email && $o_Pass == $pass)
                {
                    $sel_query = "select * from cart where IP_add = '$ip'";
                    $run_sel_query = mysqli_query($con,$sel_query);
                    $count_query = mysqli_num_rows($run_sel_query);
                 
                    if($count_query==0)
                    {                        
                        $_SESSION["Customer_Email"] = $email;
                        echo "<script>alert('Successfully Login')</script> ";
                      echo"  <script>window.location.href = 'index.php'</script>";
                    }
                    else{
                        $_SESSION["Customer_Email"] = $email;
                        echo "<script>alert('Successfully Login')</script> ";
                        echo"  <script>window.location.href = 'chckout.php'</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Invalid Email And Password')</script> ";
                    exit();
                }
             }
        ?>
        </table>



    </form>







/<div>