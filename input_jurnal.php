<div class="span2">
    <ul class="nav nav-list">
        <a class="nav-header">Jurnal</a>
        <li><a href="index.php?menu=input_jurnal&tipe=umum">Input Jurnal Umum</a></li>
    </ul>
</div>
<div class="span10">
<?php
if(isset($_GET['edit'])){
    include_once 'form_editjurnal.php';
}
else if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    //ambil data yang mau dihapus, catat ke log
    $sql_get="SELECT * FROM jurnal WHERE id = '$id' order by tanggal desc";
    $res_get = mysql_query($sql_get);
    $jurnal = mysql_fetch_assoc($res_get);
    $activity = "Menghapus data jurnal dengan data sbb:<br>
                 no id : ".$jurnal['id']." / ".
                "tanggal : ".$jurnal['tanggal']."<br>".
                "kode-nama akun : ".$jurnal['kode_akun']."-".$jurnal['nama_akun']."<br>".
                "keterangan : ".$jurnal['keterangan']."<br>".
                "jumlah debit-kredit : ".$jurnal['debit']."-".$jurnal['kredit'];
    $activity_by = $_SESSION['username'];
    $date_activity = date('Y-m-d H:i:s');
    $sql_log = "INSERT INTO log VALUES('','$activity','$activity_by','$date_activity')";
    mysql_query($sql_log);
    //hapus data
    $sql = "DELETE FROM `jurnal` WHERE `id`='$id'";
    mysql_query($sql);
}
else if(isset($_GET['tipe']) && ($_GET['tipe'] == 'umum')){
    include_once 'form_jurnalumum.php';
}
else if(isset($_GET['tipe']) && ($_GET['tipe'] == 'penyesuaian')){
    include_once 'form_jurnalpenyesuaian.php';
}
/*----------------------------LIST TABEL JURNAL------------------------------*/
    $sql1 = "SELECT * FROM jurnal";
    $result1 = mysql_query($sql1);
    $total = mysql_num_rows($result1);
    $limit = 10 ;
    $total_page = ceil($total/$limit);
    
    echo '<div  class="pagination pull-right">
        <ul>';
    for($i=1;$i<=$total_page;$i++){
        echo '<li><a href="index.php?menu=input_jurnal&tipe='.(isset($_GET['tipe'])?''.$_GET['tipe']:'').'&page='.$i.'">'.$i.'</a></li>';
    }
    echo '</ul></div>';
    
    if(isset($_GET['page'])){
        $offset = ($_GET['page'] - 1) * $limit;
    }
    else
    {
        $offset = 0;
    }
?>
<table class="table table-bordered">
    <thead>
    <th>ID</th>
    <th>Tanggal</th>
    <th>No. Bukti</th>
    <th>Kode akun</th>
    <th>Keterangan</th>
    <th>Debit</th>
    <th>Kredit</th>
</thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM jurnal LIMIT $offset, $limit";
$result = mysql_query($sql);
    while($data=  mysql_fetch_assoc($result)){
        echo '<tr><td>'.$data['id'].'</td>
            <td>'.$data['tanggal'].'</td>
            <td>'.$data['bukti'].'</td>
            <td>'.$data['kode_akun'].'</td>
            <td>'.$data['keterangan'].'</td>
            <td>'.$data['debit'].'</td>
            <td>'.$data['kredit'].'</td>';
//            <td><a href="#" onclick="delete_confirm(\''.$data['id'].'\')">Delete</a></td>
           echo '</tr>';
    }
    ?>
    </tbody>
</table>
</div>
<?php  ?>
<script>
     $('#kode_akun').change(function(){
        var kode = $('#kode_akun').val();
        var split = kode.split("-");
        var nama_akun = split[1];
        $('#nama_akun').val(nama_akun);
    });
    $('#kode_akun_debit').change(function(){
        var kode = $('#kode_akun_debit').val();
        var split = kode.split("-");
        var nama_akun = split[1];
        $('#nama_akun_debit').val(nama_akun);
    });
    $('#kode_akun_kredit').change(function(){
        var kode = $('#kode_akun_kredit').val();
        var split = kode.split("-");
        var nama_akun = split[1];
        $('#nama_akun_kredit').val(nama_akun);
    });
        function delete_confirm(id){
        var id = id;
        var confirmModal = $('<div class="modal hide fade">'+
        '<div class="modal-header">'+
        '<a class="close" data-dismiss="modal">&times;</a>'+
        '<h3>Konfirmasi Penghapusan</h3>'+
        '</div>'+
        '<div class="modal-body">'+
        '<p>Anda yakin ingin menghapus data ini?</p></div>'+
        '<div class="modal-footer">'+
        '<a href="#" class="btn" data-dismiss="modal">Cancel</a>'+
        '<a href="#" class="btn btn-primary" id="okButton">OK</a></div></div>');
    confirmModal.find("#okButton").click(function(event){
        confirmModal.modal('hide');
        window.location.href="index.php?menu=input_jurnal&delete="+id;
    });
    confirmModal.modal('show');
    }
</script>
<style>
    .the-legend {
    border-style: none;
    border-width: 0;
    font-size: 14px;
    line-height: 20px;
    margin-bottom: 0;
}
.the-fieldset {
    border: 2px groove threedface #444;
    float: left;
    margin-right: 70px;
    width: 30%;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>