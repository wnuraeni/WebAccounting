<?php
/*------------------- FORM EDIT JURNAL UMUM---------------------------------------------*/
$sql2 = "SELECT * FROM kode_akun ORDER BY kode_akun ASC";
$result2 = mysql_query($sql2);
$rawdata = array();
if(isset($_SESSION['flashdata'])){
    echo $_SESSION['flashdata'];
    unset($_SESSION['flashdata']);
}
if(isset($_POST['edit_jurnal'])){
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tanggal = $_POST['tanggal'];
    $bukti = $_POST['bukti'];
    $rawcode = explode('-', $_POST['kode_akun']);
    $kode_akun = $rawcode[0];
    $nama_akun = $_POST['nama_akun'];
    $keterangan = $_POST['keterangan'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];

    //ambil data yang mau dirubah, catat ke log
    $sql_get="SELECT * FROM jurnal WHERE id = '$id'";
    $res_get = mysql_query($sql_get);
    $jurnal = mysql_fetch_assoc($res_get);
    $activity = "Mengubah data jurnal dengan no id : ".$id." menjadi sbb : ".
                "tanggal awal : ".$jurnal['tanggal']." |  ".
                "tanggal baru : ".$tanggal."<br>".
                "kode-nama akun awal: ".$jurnal['kode_akun']."-".$jurnal['nama_akun']." | ".
                "kode-nama akun baru : ".$kode_akun."-".$nama_akun."<br>".
                "keterangan awal : ".$jurnal['keterangan']." | ".
                "keterangan baru : ".$keterangan."<br>".
                "debit-kredit awal: ".$jurnal['debit']."-".$jurnal['kredit']."|";
                "debit-kredit baru: ".$debit."-".$kredit;
    $activity_by = $_SESSION['username'];
    $date_activity = date('Y-m-d H:i:s');
    $sql_log = "INSERT INTO log VALUES('','$activity','$activity_by','$date_activity')";
    mysql_query($sql_log);

    //update data
    $sql = "UPDATE jurnal SET `tanggal`='$tanggal',`bukti`='$bukti',
    `kode_akun`='$kode_akun',`keterangan`='$keterangan',`debit`='$debit',`kredit`='$kredit' WHERE `id`='$id'";
    mysql_query($sql)or die(mysql_error());
    $_SESSION['flashdata'] = '<p class="alert alert-success">Update Data Sukses</p>';
    echo '<script>window.location.href="index.php?menu=input_jurnal"</script>';
}
$id = isset($_GET['id'])?$_GET['id']:'';
$sql = "SELECT `jurnal`.`id`,`jurnal`.`tanggal`,`jurnal`.`bukti`,`jurnal`.`kode_akun`,
`jurnal`.`keterangan`, `jurnal`.`debit`, `jurnal`.`kredit`, `kode_akun`.`nama_akun` FROM jurnal INNER JOIN `kode_akun` ON `jurnal`.`kode_akun` = `kode_akun`.`kode_akun` 
WHERE `jurnal`.`id`='$id'";
$result = mysql_query($sql);
$data = mysql_fetch_object($result);
?>
<h4>Edit Jurnal Umum</h4>
<form action="index.php?menu=input_jurnal&edit" method="POST" class="form-horizontal">
    <input type="hidden" name="id" value="<?php echo empty($data->id)?'':$data->id;?>">
    <div class="control-group">
        <label class="control-label">Tanggal</label>
        <div class="controls"><input type="text" name="tanggal"  value="<?php echo empty($data->tanggal)?'':$data->tanggal;?>" id="tanggal"><a href="javascript: NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a></div>
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
                while($rawdata = mysql_fetch_assoc($result2)){
                    if(!empty($data->kode_akun)){
                        if($data->kode_akun==$rawdata['kode_akun']){
                            echo '<option value="'.$rawdata['kode_akun'].'-'.$rawdata['nama_akun'].'" selected="selected">'.$rawdata['kode_akun'].'</option>';
                        }
                        else{
                            echo '<option value="'.$rawdata['kode_akun'].'-'.$rawdata['nama_akun'].'">'.$rawdata['kode_akun'].'</option>';
                        }
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nama Akun</label>
        <div class="controls"><input type="text" name="nama_akun" id="nama_akun" value="<?php echo empty($data->nama_akun)?'':$data->nama_akun; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Keterangan</label>
        <div class="controls"><input type="text" name="keterangan" value="<?php echo empty($data->keterangan)?'':$data->keterangan; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Debit</label>
        <div class="controls"><input type="text" name="debit" value="<?php echo empty($data->debit)?'':$data->debit; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Kredit</label>
        <div class="controls"><input type="text" name="kredit" value="<?php echo empty($data->kredit)?'':$data->kredit; ?>">
            <button class="btn btn-primary" name="edit_jurnal">Simpan</button>
            <a href="index.php" class="btn">Batal</a>
        </div>
    </div>
<!--    Akumulasi-->
</form>
