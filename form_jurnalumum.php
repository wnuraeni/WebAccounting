<?php
/*------------------- FORM INPUT JURNAL UMUM---------------------------------------------*/
$sql = "SELECT * FROM kode_akun ORDER BY kode_akun ASC";
$result = mysql_query($sql);
$rawdata = array();
if(isset($_SESSION['flashdata'])){
    echo $_SESSION['flashdata'];
    unset($_SESSION['flashdata']);
}
/*------------------PROSES INPUT JURNAL UMUM---------------------------------------------*/
if(isset($_POST['input_jurnal'])){
    $tanggal = $_POST['tanggal'];
    $bukti = $_POST['bukti'];
    /*----------------Data debit-------------------------------------------------------------*/
    $rawcode = explode('-', $_POST['kode_akun_debit']);
    $kode_akun = $rawcode[0];
    $nama_akun = $_POST['nama_akun_debit'];
    $keterangan = $_POST['keterangan_debit'];
    $debit = $_POST['debit_debit'];
    $kredit = $_POST['kredit_debit'];
    /*-------------------------Data Kredit---------------------------------------------------*/
    $rawcode2 = explode('-', $_POST['kode_akun_kredit']);
    $kode_akun2 = $rawcode2[0];
    $nama_akun2 = $_POST['nama_akun_kredit'];
    $keterangan2 = $_POST['keterangan_kredit'];
    $debit2 = $_POST['debit_kredit'];
    $kredit2 = $_POST['kredit_kredit'];
    $sql = "INSERT INTO jurnal VALUES('','$tanggal','$bukti','$kode_akun','$nama_akun','$keterangan','$debit','$kredit')";
    mysql_query($sql)or die(mysql_error());
   $sql2 = "INSERT INTO jurnal VALUES('','$tanggal','$bukti','$kode_akun2','$nama_akun2','$keterangan2','$debit2','$kredit2')";
    mysql_query($sql2)or die(mysql_error());
    $_SESSION['flashdata'] = '<p class="alert alert-success">Input Data Sukses</p>';
    echo '<script>window.location.href="index.php?menu=input_jurnal"</script>';
}
?>
<h4>Input Jurnal Umum</h4>
<form action="index.php?menu=input_jurnal&tipe=umum" method="POST" class="form-horizontal">
    <input type="hidden" name="id" value="<?php echo empty($data->id)?'':$data->id;?>">
    <div class="control-group">
        <label class="control-label">Tanggal</label>
        <div class="controls"><input type="text" name="tanggal"  value="<?php echo empty($data->tanggal)?'':$data->tanggal;?>" id="tanggal"><a href="javascript: NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a></div>
    </div>
    <div class="control-group">
        <label class="control-label">Bukti</label>
        <div class="controls"><input type="text" name="bukti" value="<?php echo empty($data->bukti)?'':$data->bukti;?>"></div>
    </div>
        <!-- ==Input Debit== -->

    <fieldset class="well the-fieldset">
        <legend>Debit</legend>
    <div class="control-group">
        <label class="control-label">Kode akun</label>
        <div class="controls">
            <input type="text" name="kode_akun_debit" id="kode_akun_debit" autocomplete="off">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nama Akun</label>
        <div class="controls"><input type="text" autocomplete="off" name="nama_akun_debit" id="nama_akun_debit" value="<?php echo empty($data->nama_akun)?'':$data->nama_akun; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Keterangan</label>
        <div class="controls"><input type="text" autocomplete="off" name="keterangan_debit" value="<?php echo empty($data->keterangan)?'':$data->keterangan; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Debit</label>
        <div class="controls"><input type="text" autocomplete="off" name="debit_debit" value="<?php echo empty($data->debit)?'':$data->debit; ?>"></div>
    </div>

    </fieldset>
    <!-- ===Input Kredit== -->
     <fieldset class="well the-fieldset">
        <legend>Kredit</legend>
    <div class="control-group">
        <label class="control-label">Kode akun</label>
        <div class="controls">
            <input type="text" name="kode_akun_kredit" id="kode_akun_kredit"  autocomplete="off">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nama Akun</label>
        <div class="controls"><input type="text" name="nama_akun_kredit" id="nama_akun_kredit" autocomplete="off" value="<?php echo empty($data->nama_akun)?'':$data->nama_akun; ?>"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Keterangan</label>
        <div class="controls"><input type="text" name="keterangan_kredit" autocomplete="off" value="<?php echo empty($data->keterangan)?'':$data->keterangan; ?>"></div>
    </div>
   
    <div class="control-group">
        <label class="control-label">Kredit</label>
        <div class="controls"><input type="text" name="kredit_kredit" autocomplete="off" value="<?php echo empty($data->kredit)?'':$data->kredit; ?>">
            </fieldset>
            <br><br>
            <button class="btn btn-primary" name="input_jurnal">Tambah</button>
            <a href="index.php" class="btn">Batal</a>
        </div>
    </div>
</form>
<?php
$sql = "SELECT * FROM kode_akun ORDER BY kode_akun ASC";
$result = mysql_query($sql);
$rawdata = array();
$kodeakun = '[';
while ($rawdata = mysql_fetch_assoc($result)){
    $kodeakun .="'".$rawdata['kode_akun']."-".$rawdata['nama_akun']."',";
}
$kodeakun = rtrim($kodeakun, ',');
$kodeakun .=']';
//['11','12','13']
?>
<script>
   var kodeakun = <?php echo $kodeakun;?>;
   $('#kode_akun_debit').typeahead({
       source: kodeakun,
       updater: function(selection){
           var split = selection.split("-");
           var values = split[0];
           $.ajax({
               url:"ajax_kodeakun.php",
               type:"post",
               dataType:"json",
               data:{"kode_akun":values},
               success:function(data){
                   var nama_akun = data.name;
                   $("#nama_akun_debit").val(nama_akun);
               }
           });
           return values;
       }
   });
   var kodeakun = <?php echo $kodeakun;?>;
   $('#kode_akun_kredit').typeahead({
       source: kodeakun,
       updater: function(selection){
           var split = selection.split("-");
           var values = split[0];
           $.ajax({
               url:"ajax_kodeakun.php",
               type:"post",
               dataType:"json",
               data:{"kode_akun":values},
               success:function(data){
                   var nama_akun = data.name;
                   $("#nama_akun_kredit").val(nama_akun);
               }
           });
           return values;
           }
   });
</script>