<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('keuangan');
$kodeakun = $_POST['kode_akun'];
$query = "SELECT nama_akun FROM kode_akun WHERE `kode_akun`='$kodeakun'";
$result = mysql_query($query) or die (mysql_error());
$value = mysql_fetch_assoc($result);
$nama = $value['nama_akun'];
echo json_encode(array('name'=>$nama));
?>
