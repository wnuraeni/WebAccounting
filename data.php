<?php
 include_once 'database.php';
if(isset($_GET['delete'])){
    $query_delete = "DELETE FROM kode_akun WHERE `id`='".$_GET['delete']."'";
    mysql_query($query_delete) or die(mysql_error());
}
?>
 <?php
           
            if(isset($_POST['submit_b'])){
                $kode = $_POST['kode_akun'];
                $nama = $_POST['nama_akun'];
                $jenis = $_POST['jenis_akun'];
                $saldo_n = $_POST['saldo_normal'];
              $sql = "INSERT INTO kode_akun(`kode_akun`,`nama_akun`,`jenis`,`saldo_normal`) VALUES ('$kode','$nama','$jenis','$saldo_n')";
              mysql_query($sql) or die(mysql_error());?>
           <div class="alert alert-success">Input Data Sukses</div>
           
           <?php }
            ?>

<!--<div class="tabbable tabs-left">-->
<!--    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#kode_akun">Kode Akun</a></li>
    </ul>-->

<!--    <div class="tab-content">
        <div id="user" class="tab-pane">
            <p>Isi tab user</p>
        </div>
        <div id="kode_akun" class="tab-pane">-->
<div class="span10 offset1">
           
            <form class="form-horizontal" action="index.php?menu=data" method="POST">
                 <h3 style="margin-left:120px">Input Kode Akun</h3>
                <div class="control-group">
                    <label class="control-label">Kode Akun</label>
                    <div class="controls"><input type="text" name="kode_akun"></div>
                </div>
                 <div class="control-group">
                    <label class="control-label">Nama Akun</label>
                    <div class="controls"><input type="text" name="nama_akun"></div>
                </div>
                 <div class="control-group">
                    <label class="control-label">Jenis Akun</label>
                    <div class="controls"><input type="text" name="jenis_akun"></div>
                </div>
                 <div class="control-group">
                    <label class="control-label">Saldo Normal</label>
                    <div class="controls">
                        <label class="radio"><input type="radio" name="saldo_normal" value="debit">Debit </label>
                         <label class="radio"><input type="radio" name="saldo_normal" value="kredit">Kredit </label>
                         <button class="btn btn-primary" name="submit_b">Submit</button>
                    </div>
                </div>
            </form>
           
            <table class="table table-bordered">
                <thead><th>Kode Akun</th><th>Nama Akun</th><th>Jenis</th><th>Saldo Normal</th><th colspan="2">Action</th> </thead>
            <tbody>
<?php

$sql = "SELECT * FROM kode_akun";
$result = mysql_query($sql);
while($data = mysql_fetch_object($result)){
  echo '<tr><td>'.$data->kode_akun.'</td>'.
          '<td>'.$data->nama_akun.'</td>'.
          '<td>'.$data->jenis.'</td>'.
          '<td>'.$data->saldo_normal.'</td>';
//          '<td><a href="index.php?menu=edit_akun&id='.$data->id.'">Edit</a></td><td><a href="index.php?menu=data&delete='.$data->id.'"><i class="icon-trash"></i></a></td></tr>';
}
?>
            </tbody>
            </table>
        </div>
<!--        <div id="lap_lalu" class="tab-pane"><p>Isi tab laporan keuangan lalu</p>
        </div>-->
<!--    </div>--><!--  tab-content -->
<!--</div>--><!-- tab -->
            <script type="text/javascript">
            $(function(){
            $('a[href=#kode_akun').tab('show');
            });
            </script>