<?php
/*------------------PROSES INPUT JURNAL UMUM---------------------------------------------*/
if(isset($_POST['input_jurnal'])){
    $tanggal = $_POST['tanggal'];
    $bukti = $_POST['bukti'];
    $rawcode = explode('-', $_POST['kode_akun']);
    $kode_akun = $rawcode[0];
    $nama_akun = $_POST['nama_akun'];
    $keterangan = $_POST['keterangan'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];
    $sql = "INSERT INTO jurnal VALUES('','$tanggal','$bukti','$kode_akun','$keterangan','$debit','$kredit')";
    mysql_query($sql)or die(mysql_error());
  //  header("Location: index.php");
    echo '<script>window.location.href="index.php"</script>';
}
else if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql = "SELECT * FROM jurnal INNER JOIN `kode_akun` ON `jurnal`.`kode_akun` = `kode_akun`.`kode_akun` WHERE `jurnal`. `id`='$id'";
    $result = mysql_query($sql);
    $data = mysql_fetch_object($result);
}

/*------------------- FORM INPUT JURNAL UMUM---------------------------------------------*/
$sql = "SELECT * FROM kode_akun ";
$result = mysql_query($sql);
$rawdata = array();

?>
<h4>Input Jurnal Umum</h4>
<form action="index.php?menu=jurnal" method="POST" class="form-horizontal">
    <div class="control-group">
        <label class="control-label">Tanggal</label>
        <div class="controls"><input type="text" name="tanggal" value="<?php echo empty($data->tanggal)?'':$data->tanggal;?>" id="tanggal"><a href="javascript: NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a></div>
    </div>
    <div class="control-group">
        <label class="control-label">Bukti</label>
        <div class="controls"><input type="text" name="bukti" value="<?php echo empty($data->bukti)?'':$data->bukti;?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Kode akun</label>
        <div class="controls">
            <select name="kode_akun" id="kode_akun">
                <option>-- Pilih --</option>
                <?php
                while($rawdata = mysql_fetch_assoc($result)){
                    if(!empty ($data->kode_akun))
                    {if($data->kode_akun==$rawdata['kode_akun']){
                        echo '<option value="'.$rawdata['kode_akun'].'-'.$rawdata['nama_akun'].'" selected="selected">'.$rawdata['kode_akun'].'</option>';}}
                        else{
                             echo '<option value="'.$rawdata['kode_akun'].'-'.$rawdata['nama_akun'].'">'.$rawdata['kode_akun'].'</option>';
                        } }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nama Akun</label>
        <div class="controls"><input type="text" name="nama_akun" id="nama_akun" value="<?php echo empty($data->nama_akun)?'':$data->nama_akun;?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Keterangan</label>
        <div class="controls"><input type="text" name="keterangan" value="<?php echo empty($data->keterangan)?'':$data->keterangan;?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Debit</label>
        <div class="controls"><input type="text" name="debit" value="<?php echo empty($data->debit)?'':$data->debit;?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Kredit</label>
        <div class="controls"><input type="text" name="kredit" value="<?php echo empty($data->kredit)?'':$data->kredit;?>">
            <br><br>
            <?php
            if(isset($_GET['edit'])){
                echo '  <button class="btn btn-primary" name="edit_jurnal">Simpan</button>';
            }else{
                echo '  <button class="btn btn-primary" name="input_jurnal">Tambah</button>';
            }
            ?>
            <a href="index.php" class="btn">Batal</a>
        </div>
    </div>
<!--    Akumulasi-->
</form>
<table class="table table-bordered">
                <thead><th>Kode Akun</th><th>Nama Akun</th><th>Jenis</th><th>Saldo Normal</th><th colspan="2">Action</th> </thead>
            <tbody>
<?php
$sql1 = "SELECT * FROM jurnal";
$result1 = mysql_query($sql1);
$total = mysql_num_rows($result1);
$limit = 10 ;
$total_page = ceil($total/$limit);
echo'<div class=pagination pull-right">
    <ul>';
for($i=1;$i<=$total_page;$i++){
    echo '<li><a href="index.php?menu=jurnal&page='.$i.'">'.$i.'</a></li>';
}
echo '</ul></div>';

if(isset($_GET['page'])){
    $offset = ($GET['page'] - 1) * $limit;
}
else
{
    $offset = 0;
}
$sql = "SELECT * FROM jurnal LIMIT $offset, $limit";
$result = mysql_query($sql);
while($data = mysql_fetch_object($result)){
  echo '<tr><td>'.$data->id.'</td>'.
          '<td>'.$data->tanggal.'</td>'.
          '<td>'.$data->bukti.'</td>'.
          '<td>'.$data->kode_akun.'</td>'.
          '<td>'.$data->keterangan.'</td>'.
          '<td>'.$data->debit.'</td>'.
          '<td>'.$data->kredit.'</td>'.
          '<td><a href="index.php?menu=jurnal&edit='.$data->id.'">Edit</a></td><td><a href="index.php?menu=jurnal&delete='.$data->id.'"><i class="icon-trash"></i></a></td></tr>';
}
?>
            </tbody>
            </table>
<?php ?>
<script>
    $('#kode_akun').change(function(){
        var kode = $('#kode_akun').val();
        var split = kode.split("-");
        var nama_akun = split[1];
        $('#nama_akun').val(nama_akun);
    });
</script>