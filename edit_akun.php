<?php
$id=$_GET['id'];
include_once 'database.php';

$sql = "SELECT * FROM kode_akun WHERE `id` = '$id'";
$result = mysql_query($sql);
$data = mysql_fetch_object($result);
?>

<form action="index.php?menu=edit_akun" class="form-horizontal" method="POST">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <div class="control-group">
        <label class="control-label">Kode Akun : </label>
        <div class="controls"><input type="text" name="kode_akun" value="<?php echo $data->kode_akun;?>"> </div>

    </div>
    <div class="control-group">
        <label class="control-label">Nama Akun : </label>
        <div class="controls"><input type="text" name="nama_akun" value="<?php echo $data->nama_akun;?>"> </div>
        <div class="control-group">
        <label class="control-label">jenis : </label>
        <div class="controls"><input type="text" name="jenis" value="<?php echo $data->jenis;?>"> </div>

    </div>

    </div>
    <div class="control-group">
        <label class="control-label">Saldo Normal : </label>
        <div class="controls"><label class="radio"><input type="radio" name="saldo_normal" value="debit" <?php echo($data->saldo_normal=='debit')?'checked=checked':'';?>>Debit</label>
            <label class="radio"><input type="radio" name="saldo_normal" value="kredit"<?php echo($data->saldo_normal=='kredit')?'checked=checked':'';?>>Kredit</label>
            <button type="submit" name="save_data">Save</button> </div>

    </div>
    
</form>
<?php
if(isset($_POST['save_data'])){
    $id_akun = $_POST['id'];
    $kodeakun = $_POST['kode_akun'];
    $namaakun = $_POST['nama_akun'];
    $jenis = $_POST['jenis'];
    $saldonormal = $_POST['saldo_normal'];

$query = "UPDATE kode_akun SET `kode_akun`='$kodeakun',`nama_akun`='$namaakun',`jenis`='$jenis',`saldo_normal`='$saldonormal' WHERE `id`='$id_akun'";
mysql_query($query) or die(mysql_error());

echo"<script>window.location.href='index.php?menu=data';</script>";

}
?>