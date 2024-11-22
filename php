<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil pesan dari form
    $message = htmlspecialchars($_POST['message']);  // Mengamankan input untuk mencegah XSS

    // Simpan pesan ke file log atau kirim email
    $logFile = 'chat_log.txt';  // Lokasi file log
    $currentLog = file_get_contents($logFile);  // Ambil isi log yang sudah ada
    $currentLog .= "Pelanggan: $message\n";  // Tambahkan pesan baru ke log
    file_put_contents($logFile, $currentLog);  // Simpan log yang telah di

    <?php
    // Menghubungkan ke database
    include('db_connect.php');
    
    // Query untuk mengambil semua data pemesanan
    $sql = "SELECT * FROM rentals ORDER BY rental_date DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<h1>Daftar Pemesanan Sewa WhatsApp</h1>";
        echo "<table border='1'><tr><th>ID</th><th>Nama</th><th>Nomor WhatsApp</th><th>Durasi Sewa (Hari)</th><th>Tanggal Pemesanan</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['customer_name'] . "</td>
                    <td>" . $row['whatsapp_number'] . "</td>
                    <td>" . $row['rental_duration'] . "</td>
                    <td>" . $row['rental_date'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data pemesanan.";
    }
    
    // Tutup koneksi
    <?php
// Menghubungkan ke database
include('db_connect.php');

// Mengambil data dari formulir
$customer_name = $_POST['customer_name'];
$whatsapp_number = $_POST['whatsapp_number'];
$rental_duration = $_POST['rental_duration'];

// Cek apakah data yang diperlukan ada
if (empty($customer_name) || empty($whatsapp_number) || empty($rental_duration)) {
    echo "Semua kolom harus diisi!";
    exit;
}

// Query untuk menyimpan data penyewaan ke dalam tabel rentals
$sql = "INSERT INTO rentals (customer_name, whatsapp_number, rental_duration, rental_start)
        VALUES ('$customer_name', '$whatsapp_number', '$rental_duration', NOW())";

// Menjalankan query dan memeriksa apakah berhasil
if ($conn->query($sql) === TRUE) {
    echo "Penyewaan berhasil disimpan!";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

// Menutup koneksi database
$conn->close();
?>


<?php
// db_connect.php
$servername = "localhost"; // Server database
$username = "root";        // Username MySQL
$password = "";            // Password MySQL (untuk XAMPP defaultnya kosong)
$dbname = "whatsapp_rental"; // Nama database yang sudah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<?php
// Menghubungkan ke database
include('db_connect.php');

// Query untuk mengambil semua data penyewaan
$sql = "SELECT * FROM rentals";
$result = $conn->query($sql);

// Menampilkan data penyewaan
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nama Pelanggan: " . $row["customer_name"]. " - Nomor WhatsApp: " . $row["whatsapp_number"]. " - Durasi Sewa: " . $row["rental_duration"]. " hari - Tanggal Sewa: " . $row["rental_start"] . "<br>";
    }
} else {
    echo "Tidak ada data penyewaan.";
}

// Menutup koneksi database
$conn->close();
?>
