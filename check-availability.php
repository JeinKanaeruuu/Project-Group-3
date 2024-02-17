<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check Seat Availability</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS styling for seat indicators -->
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    .empty-seat {
        background-color: #28a745; /* green */
        color: white;
    }
    .occupied-seat {
        background-color: #dc3545; /* red */
        color: white;
    }
  </style>
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="check-availability.php">Check Seat Availability</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


  <div class="container">
    <h1>Check Seat Availability</h1>
    <p>Select available seats:</p>
    <!-- Tabel untuk menampilkan data meja -->
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">Table Number</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Database Connection
          include('admin/includes/config.php');

          session_start();
          error_reporting(0);

          if(strlen($_SESSION['aid']) == 0) { 
              header('location:index.php');
          } else {
              // Query untuk mengambil data meja dari database
              $query = "SELECT * FROM tblrestables";
              $result = mysqli_query($con, $query);
          }

          // Tampilkan pesan jika tidak ada meja yang ditemukan
          if(mysqli_num_rows($result) == 0) {
              echo "<tr><td colspan='2'>Tidak ada meja yang tersedia.</td></tr>";
          } else {
              // Loop through each row of table data
              while($row = mysqli_fetch_assoc($result)) {
                  // Query untuk memeriksa apakah meja tersebut sudah dipesan
                  $queryCheckBooking = "SELECT * FROM tblbookings WHERE tableId = '{$row['id']}' AND bookingDate = CURDATE() AND boookingStatus = 'Accepted'";
                  $resultCheckBooking = mysqli_query($con, $queryCheckBooking);

                  // Jika ada pemesanan pada meja tersebut, tandai sebagai terisi. Jika tidak, tandai sebagai kosong
                  $seatStatus = $row['status']; // Ambil status meja dari database
                  $seatStatusClass = ($seatStatus == 'occupied') ? 'occupied-seat' : 'empty-seat';
                  echo "<tr>";
                  echo "<td>" . $row['tableNumber'] . "</td>";
                  echo "<td class='$seatStatusClass'>" . (($seatStatus == 'occupied') ? 'Occupied' : 'Empty') . "</td>";
                  echo "</tr>";
              }
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
