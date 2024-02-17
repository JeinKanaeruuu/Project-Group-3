<?php
include('includes/config.php');

if(isset($_POST['tid']) && isset($_POST['status'])) {
    $tid = $_POST['tid'];
    $status = $_POST['status'];

    $query = "UPDATE tblrestables SET status = '$status' WHERE id = '$tid'";
    $result = mysqli_query($con, $query);

    if($result) {
        header('Location: manage-tables.php');
        exit();
    } else {
        echo "Failed to update table status.";
    }
}
?>
