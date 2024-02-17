<?php
session_start();

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "rtbsdb");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Jika tombol pesan ditekan
if(isset($_POST['pesan'])) {
    $total = 0;
    $order_items = array();
    foreach ($_POST['jumlah'] as $menu_id => $jumlah) {
        // Hitung total harga pesanan
        $harga = $_POST['harga'][$menu_id];
        $subtotal = $harga * $jumlah;
        $total += $subtotal;
        
        // Simpan detail pesanan ke dalam array
        $order_items[] = array(
            'menu_id' => $menu_id,
            'jumlah' => $jumlah
        );
    }
    
    // Simpan pesanan ke dalam database
    // Misalkan kita akan menyimpan pesanan ke dalam tabel baru 'pesanan'
    $tanggal_pesan = date('Y-m-d H:i:s'); // Ambil waktu pesan
    $query = "INSERT INTO pesanan (tanggal_pesan, total_harga) VALUES ('$tanggal_pesan', '$total')";
    mysqli_query($koneksi, $query);
    $pesanan_id = mysqli_insert_id($koneksi); // Ambil ID pesanan yang baru saja disimpan
    
    // Simpan detail pesanan ke dalam tabel 'detail_pesanan'
    foreach ($order_items as $item) {
        $menu_id = $item['menu_id'];
        $jumlah = $item['jumlah'];
        $query = "INSERT INTO detail_pesanan (pesanan_id, menu_id, jumlah) VALUES ('$pesanan_id', '$menu_id', '$jumlah')";
        mysqli_query($koneksi, $query);
    }
    
    echo "Total harga pesanan: $" . $total;
}

// Jika tombol cancel ditekan
if(isset($_POST['cancel'])) {
    // Kosongkan session pesanan
    unset($_SESSION['pesanan']);
    
    // Redirect atau tampilkan pesan sukses
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
</head>
<body>
    <h1>Daftar Menu</h1>
    <form method="POST" action="">
        <ul>
            <?php
            // Query untuk mengambil data menu dari database
            $query_menu = "SELECT * FROM menu_items";
            $result_menu = mysqli_query($koneksi, $query_menu);
            
            // Tampilkan pesan error jika query gagal
            if (!$result_menu) {
                die("Query Error: " . mysqli_error($koneksi));
            }
            
            // Tampilkan menu dan form input untuk jumlah pesanan
            while ($row = mysqli_fetch_assoc($result_menu)):
            ?>
                <li>
                    <img src="<?php echo $row['menu_image']; ?>" alt="<?php echo $row['menu_name']; ?>" height="100">
                    <strong><?php echo $row['menu_name']; ?></strong> - $<?php echo $row['menu_price']; ?>
                    <input type="number" name="jumlah[<?php echo $row['menu_id']; ?>]" value="0" min="0">
                    <input type="hidden" name="harga[<?php echo $row['menu_id']; ?>]" value="<?php echo $row['menu_price']; ?>">
                </li>
            <?php endwhile; ?>
        </ul>
        <button type="submit" name="pesan">Pesan</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
