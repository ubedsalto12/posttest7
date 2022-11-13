<?php
require 'koneksi.php';
session_start();

if (!isset($_SESSION['signin'])) {
    header("Location: signin.php");
    exit;
}

if (isset($_POST['cari'])) {
    $cari = $_POST['keyword'];
    $data = mysqli_query($conn, "SELECT * FROM data_member WHERE nama_member LIKE '%$cari%' OR tempat_lahir LIKE '%$cari%' OR alamat LIKE '%$cari%'");
    $cek = mysqli_num_rows($data);
 } 
else {
     $data = mysqli_query($conn, "SELECT * FROM data_member ORDER BY id DESC");
 }

$result = mysqli_query($conn, "SELECT * FROM data_member");

$dataMember = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dataMember[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
    <title>Form Data Base</title>

</head>
<body>
<header>
        <div class="logo">
            <img src="img/gambar3.jpg" alt="logo" class="logo-img" />
            <h1 class="logo-title">Yok Olahraga</h1>
        </div>
        <nav>
            <ul>
                <li><input type="checkbox" id="checkbox"></li>   
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="tabelDataMember.php">Data Member</a></li>
                <li><a href="mailto:muhammadrezaubaidillah@gmail.com">Contact</a></li>
            </ul>
        </nav>
        <button class="btn-cta" onclick="redirInstagram()">Follow Saya</button>
    </header>
    <center>
    <div>
    <h1>Data Member</h1>
    <div>
        <form action="" method="POST">
                        <input  class="search"type="text" name="keyword" id="live-search" placeholder="Cari" autocomplete="off">
                        <button type="submit" name="cari" id="keyword" class="button">Cari</button>
         </form>
    </div>
    <table border=1px>
        <tr class="tabel">
            <th class="tabel"><b>id</b></th>
            <th class="tabel"> <b>Nama</b></th>
            <th class="tabel"><b>Tempat Lahir</b></th>
            <th class="tabel"><b>Alamat</b></th>
            <th class="tabel"><b>Date</b></th>
            <th class="tabel"><b>Gambar</b></th>
            <th class="tabel"><b>Opsi</b></th>
        </tr>
        <?php $i = 1; foreach ($dataMember as $dc):?>
        <tr class="tabel">
            <td class="tabel"><?php echo $i ;?></td>
            <td class="tabel"><?php echo $dc["nama_member"] ;?></td>
            <td class="tabel"><?php echo $dc["tempat_lahir"] ;?></td>
            <td class="tabel"><?php echo $dc["alamat"] ;?></td>
            <td class="tabel"><?php echo $dc["date"];?></td>
            <td><img style="width: 40px;" src="gambar/<?php echo $d['gambar']; ?>"></td>
            <td><a class="tabel" href="edit.php?id=<?php echo $dc["id"]; ?>" >Edit</a> 
            | <a class="tabel"href="hapus.php?id=<?php echo $dc["id"]; ?>" onclick = "return confirm('And yakin ingin mengahpus data ini ?')">Hapus</a></td>
        </tr>
        <?php $i++; endforeach;?>
        <tr>
            <td colspan="7"><button class="button button5"  name="tambah"><a href="tambah.php" >Tambah Data</a></button>
            <button class="button button5"><a href="signout.php" >Sign Out</a>
        </tr>
    </table>
    </div>
    </center>
    <script>
        function redirInstagram() {
            window.location.href = "https://www.instagram.com/mrezaubaidillah_"
        }
        
    </script>

    <script src="js/tes.js"></script>
</body>
</html>