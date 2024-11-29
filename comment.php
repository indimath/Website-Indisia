<?php
// Menyertakan file koneksi database
include('db.php');

// Fungsi untuk menambahkan data ke database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $komentar = $_POST['komentar'];
    $sql = "INSERT INTO komentar (nama, komentar) VALUES ('$nama', '$komentar')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect setelah data berhasil disubmit
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan data dari database
$sql = "SELECT * FROM komentar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divitiae</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contactsection.css">
    <link rel="stylesheet" href="css/scrolltotop.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
      <a href="index.html" class="navbar-logo">Divi<span>tiae</span>.</a>
      <div class="navbar-nav">
        <a href="index.html">Home</a>
        <a href="about.html">About Me</a>
        <a href="menu.html">List</a>
        <a href="comment.php">Comment</a>
      </div>
      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <h2><span>Pesan yang</span> Telah Dikirim:</h2>
        <p>Silahkan kirim komentar kamu untuk berbagi cerita dan pengalamanmu!.</p>
        <hr class="section-divider-contact" />
        
        <!-- Menampilkan Data dari Database -->
        <div class="comments">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='comment'>
                            <strong>" . htmlspecialchars($row['nama']) . "</strong>
                            <p>" . htmlspecialchars($row['komentar']) . "</p>
                            <small>Diposting pada: " . $row['created_at'] . "</small>
                        </div>";
                }
            } else {
                 echo "<tr><td colspan='2'>Tidak ada pesan yang diterima</td></tr>";
            }
            ?>
        </div>

        
        <div class="row">
            <!-- Form Input -->
            <form method="POST" action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" name="nama" placeholder="Nama" required />
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" name="komentar" placeholder="Komentar" required />
                </div>
                <button type="submit" name="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>
        <div class="links">
            <a href="index.html">Home</a>
            <a href="about.html">About Me</a>
            <a href="menu.html">List</a>
            <a href="contact.html">Contact Me</a>
        </div>
        <div class="credit">
            <p>Created by <a href="">Indisia</a>. | &copy; 2024.</p>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">
        <i data-feather="chevrons-up"></i>
    </button>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="js/script.js"></script>
    <script src="js/scrolltotop.js"></script>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
