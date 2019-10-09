<?php include '_header.php'; ?>
<h2>Data stock hampir habis</h2>
<small style="color:#777;">* Barang yang kurang dari 10 item</small>
<br>
<br>
<table class="table">
    <tr>
        <td>Kode Barang</td>
        <td>Nama Barang</td>
        <td width="15%">Jumlah</td>
    </tr>
    <?php
    include '../modul.php';
    $modul = new modul();
    $koneksi = $modul->connection;

    $get = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE stok < 10 ORDER BY stok");
    foreach($get as $item): ?>
    <tr>
        <td><?php echo $item['kd_barang'] ?></td>
        <td><?php echo $item['nm_barang'] ?></td>
        <td><?php echo $item['stok']." ".$item['satuan'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<!-- </div>
<div class="jumbotron"> -->

<?php include '_footer.php'; ?>