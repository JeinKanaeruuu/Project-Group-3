<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['aid'])==0)
{
    header('location:index.php');
}
else{
    if(isset($_GET['id'])){
        $id=intval($_GET['id']);
        $query=mysqli_query($con,"delete from tblbookings where id='$id'");
        echo "<script>alert('Booking deleted successfully');</script>";
        echo "<script>window.location.href='all-bookings.php'</script>";
    }
}
?>
