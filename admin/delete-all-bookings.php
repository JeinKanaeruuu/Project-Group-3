<?php
    // Lakukan koneksi ke database
    include('includes/config.php');

    // Lakukan penghapusan semua data dari tabel tblbookings
    $query = "DELETE FROM tblbookings";
    $result = mysqli_query($con, $query);

    if($result){
        echo "All bookings have been deleted successfully.";
    } else {
        echo "Error deleting bookings.";
    }
?>
