<?php
include_once('admin/includes/config.php');

if(isset($_POST['submit'])){
    // Ambil data dari formulir
    $fname = $_POST['name'];
    $emailid = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $bookingdate = date('Y-m-d', strtotime($_POST['bookingdate'])); // Ubah format tanggal
    $bookingtime = $_POST['bookingtime'];
    $tablenumber = $_POST['tableNumber'];
    $noadults = $_POST['noadults'];
    $nochildrens = $_POST['nochildrens'];
    
    // Periksa apakah reservasi sudah ada untuk meja yang sama pada hari yang sama dan waktu yang sama
    $check_query = "SELECT * FROM tblbookings WHERE bookingDate = '$bookingdate' AND bookingTime = '$bookingtime' AND tableNumber = '$tablenumber'";
    $check_result = mysqli_query($con, $check_query);
    
    if(mysqli_num_rows($check_result) > 0){
        echo '<script>alert("Sorry, the table is already booked for the specified date and time. Please choose another table or time.")</script>';
        // Tambahkan kode di sini untuk menampilkan pesan "Meja sudah direserve"
        echo '<script>alert("Meja sudah direserve")</script>';
    } else {
        // Jika tidak ada reservasi yang ada, masukkan reservasi baru ke database
        $bno = mt_rand(100000000,9999999999);
        $query = mysqli_query($con,"INSERT INTO tblbookings (bookingNo, fullName, emailId, phoneNumber, bookingDate, bookingTime, tableNumber, noAdults, noChildrens) VALUES ('$bno', '$fname', '$emailid', '$phonenumber', '$bookingdate', '$bookingtime', '$tablenumber', '$noadults', '$nochildrens')");
        
        if($query){
            echo '<script>alert("Your order sent successfully. Booking number is ' . $bno . '")</script>';
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Restaurant Table Booking System</title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!--stylesheets-->
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
    <!-- Calendar -->
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- Wickedpicker -->
    <link href="css/wickedpicker.css" rel="stylesheet" type='text/css' media="all" />
    <!-- Google Fonts -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>


<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Restaurant Booking</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="check-availability.php">Check Seat Availability</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <h1 class="header-w3ls">Reservasi Meja Waroeng Rahmad</h1>
    <div class="appointment-w3">
        <form action="#" method="post">
            <div class="personal">
                <div class="main">
                    <div class="form-left-w3l">
                        <input type="text" class="top-up" name="name" placeholder="Name" required="">
                    </div>
                    <div class="form-left-w3l">
                        <input type="email" name="email" placeholder="Email" required="">
                    </div>
                    <div class="form-right-w3ls ">
                        <input class="buttom" type="text" name="phonenumber" placeholder="Phone Number" required="">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="information">
                <div class="main">
                    <div class="form-left-w3l">
                        <input id="datepicker" name="bookingdate" type="text" placeholder="Booking Date &" required="">
                        <input type="text" id="timepicker" name="bookingtime" class="timepicker form-control hasWickedpicker" placeholder="Time" required="" onkeypress="return false;">
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="main">
                    <div class="form-left-w3l">
                        <select class="form-control" name="noadults" required>
                            <option value="">Number of Adults</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                    <div class="form-left-w3l">
                        <select class="form-control" name="tableNumber" required>
                            <option value="">Table number</option>
                            <?php
                            // Ambil data meja yang tersedia dari database
                            $table_query = "SELECT * FROM tblrestables WHERE status = 'available'";
                            $table_result = mysqli_query($con, $table_query);
                            
                            // Loop melalui hasil query untuk menampilkan pilihan meja
                            while($row = mysqli_fetch_assoc($table_result)) {
                                echo "<option value='" . $row['tableNumber'] . "'>" . $row['tableNumber'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-right-w3ls">
                        <select class="form-control" name="nochildrens" required>
                            <option value="">Number of Children</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="btnn">
                <input type="submit" value="Reserve a Table" name="submit">
            </div>
            <div class="copy">
                <p>Check Booking <a href="check-status.php" target="_blank">Status</a></p>
            </div>
            <div class="copy">
                <p>Admin Panel<a href="admin/" target="_blank"> Login here</a></p>
            </div>
        </form>
    </div>
    <!-- js -->
    <script type='text/javascript' src='js/jquery-2.2.3.min.js'></script>
    <!-- //js -->
    <!-- Calendar -->
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
        });
    </script>
    <!-- //Calendar -->
    <!-- Time -->
    <script type="text/javascript" src="js/wickedpicker.js"></script>
    <script type="text/javascript">
        $('.timepicker,.timepicker1').wickedpicker({ twentyFour: false });
    </script>
    <!-- //Time -->
</body>
</html>
