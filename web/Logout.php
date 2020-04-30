<div>
<?php
    session_start();

    session_destroy();

    echo "<script>alert('Successfully Logout')</script> ";
    echo"  <script>window.location.href = 'index.php'</script>";
?>
</div>