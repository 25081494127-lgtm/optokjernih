<?php

$file_counter = "counter.txt";

if (!file_exists($file_counter)) {
    file_put_contents($file_counter, "0");
}

$total_views = (int) file_get_contents($file_counter); 
$total_views = $total_views + 1;                       
file_put_contents($file_counter, $total_views);       


$produk = [
    1 => ["nama" => "Kacamata Klasik",        "harga" => 350000],
    2 => ["nama" => "Kacamata Sporty",        "harga" => 450000],
    3 => ["nama" => "Kacamata Anti Radiasi",  "harga" => 500000],
];


$ada_hasil = false;
$pesan_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pembeli = htmlspecialchars($_POST["nama"]);
    $id_produk    = (int) $_POST["produk"];
    $jumlah_beli  = (int) $_POST["jumlah"];

    if ($nama_pembeli == "") {
        $pesan_error = "Nama tidak boleh kosong.";
    } elseif (!isset($produk[$id_produk])) {
        $pesan_error = "Silakan pilih produk.";
    } elseif ($jumlah_beli < 1) {
        $pesan_error = "Jumlah minimal 1.";
    } else {
        $nama_produk  = $produk[$id_produk]["nama"];
        $harga_satuan = $produk[$id_produk]["harga"];
        $total_harga  = $harga_satuan * $jumlah_beli;

        
        $diskon = 0;
        if ($jumlah_beli >= 2) {
            $diskon = $total_harga * 0.1;
        }
        $total_bayar = $total_harga - $diskon;

        $ada_hasil = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optik Jernih - Toko Kacamata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <header>
        <h1>👓 Optik Jernih</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="#produk">Produk</a>
            <a href="#pesan">Pesan</a>
            <a href="#kontak">Kontak</a>
        </nav>
    </header>

    
    <section id="home" class="hero">
        <h2>Lihat Dunia Lebih Jelas</h2>
        <p>Kacamata berkualitas dengan harga terjangkau untuk semua gaya.</p>
        <a href="#produk" class="tombol">Lihat Produk</a>
    </section>

   
    <section id="produk">
        <h2>Produk Kami</h2>
        <div class="daftar-produk">

            
            <div class="kartu">
                <img src="kacamata1.svg" alt="Kacamata Klasik">
                <h3>Kacamata Klasik</h3>
                <p>Frame bulat model klasik, ringan dan nyaman dipakai sehari-hari.</p>
                <p class="harga">Rp 350.000</p>
            </div>

            
            <div class="kartu">
                <img src="kacamata2.svg" alt="Kacamata Sporty">
                <h3>Kacamata Sporty</h3>
                <p>Frame kuat dan fleksibel, cocok untuk aktivitas outdoor dan olahraga.</p>
                <p class="harga">Rp 450.000</p>
            </div>

           
            <div class="kartu">
                <img src="kacamata3.svg" alt="Kacamata Anti Radiasi">
                <h3>Kacamata Anti Radiasi</h3>
                <p>Lensa blue light untuk melindungi mata saat memakai laptop dan HP.</p>
                <p class="harga">Rp 500.000</p>
            </div>

        </div>
    </section>

    
    <section id="pesan">
        <h2>Pesan Sekarang</h2>

        <form method="POST" action="#pesan">
            <label>Nama Anda</label>
            <input type="text" name="nama" placeholder="Contoh: Budi">

            <label>Pilih Produk</label>
            <select name="produk">
                <option value="">-- Pilih Produk --</option>
                <option value="1">Kacamata Klasik - Rp 350.000</option>
                <option value="2">Kacamata Sporty - Rp 450.000</option>
                <option value="3">Kacamata Anti Radiasi - Rp 500.000</option>
            </select>

            <label>Jumlah</label>
            <input type="number" name="jumlah" value="1" min="1">

            <button type="submit">Pesan</button>
        </form>

        <?php
        
        if ($pesan_error != "") {
            echo '<div class="error">' . $pesan_error . '</div>';
        }

        
        if ($ada_hasil) {
        ?>
            <div class="hasil">
                <h3>Pesanan Diterima ✅</h3>
                <p>Nama: <?php echo $nama_pembeli; ?></p>
                <p>Produk: <?php echo $nama_produk; ?></p>
                <p>Jumlah: <?php echo $jumlah_beli; ?></p>
                <p>Harga Satuan: Rp <?php echo number_format($harga_satuan, 0, ",", "."); ?></p>
                <p>Diskon: Rp <?php echo number_format($diskon, 0, ",", "."); ?></p>
                <p><strong>Total Bayar: Rp <?php echo number_format($total_bayar, 0, ",", "."); ?></strong></p>
            </div>
        <?php } ?>
    </section>

    
    <section id="kontak">
        <h2>Kontak</h2>
        <ul>
            <li>Alamat: Jl. Ketintang No. 1, Surabaya</li>
            <li>WhatsApp: 0812-3456-7890</li>
            <li>Email: info@optikjernih.com</li>
            <li>Jam Buka: Senin - Sabtu, 09.00 - 20.00</li>
        </ul>
    </section>

    
    <footer>
        <p>Total Page Views: <?php echo $total_views; ?></p>
        <p>&copy; 2026 Optik Jernih</p>
    </footer>

</body>
</html>