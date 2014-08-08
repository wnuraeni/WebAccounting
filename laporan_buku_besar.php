<style>
    .table .title{
        text-align: center;
        
}
.table .right{
    text-align: right;
}
</style>
<form action="index.php?menu=laporan&jenis_laporan=buku_besar" method="POST">
    tanggal <input type="text" name="tanggal" id="tanggal"><a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a>
<input type="submit" name="view_online" value="view online">
<input type="submit" name="print_pdf" value="get pdf"></form>
<?php
include_once'print_pdf.php';
$html='';
if(!empty($_POST)){
  $tanggal = $_POST['tanggal'];
 $tahun= date('Y',strtotime($tanggal));
 $bulan= date('m',strtotime($tanggal));

$sql = "SELECT
kode_akun.`kode_akun` AS akun_kode_akun,
kode_akun.`nama_akun` AS akun_nama_akun,
kode_akun.`saldo_normal` AS akun_saldo_normal
FROM
`kode_akun`kode_akun";
$query = mysql_query($sql);

$html.= '<table class="table table_bordered">';
echo '<tr><td colspan="6"><p>ESFERA</p>
    <p>Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung</p>
    <h4>BUKU BESAR</h4>
    <p>Dicetak tanggal :'.date('Y-m-d').'</p></td></tr>';
$html.= '<tr><td><strong>Tanggal</strong></td><td><strong>Keterangan</strong></td><td><strong>Debit</strong></td><td><strong>Kredit</strong></td><td><strong>Saldo Debit</strong></td><td><strong>Saldo Kredit</strong></td></tr>';
while ($result = mysql_fetch_assoc($query)){

    $sql2 = "SELECT
jurnal.`id` AS jurnal_id,
jurnal.`tanggal` AS jurnal_tanggal,
jurnal.`keterangan` AS jurnal_keterangan,
jurnal.`debit` AS jurnal_debit,
jurnal.`kredit` AS jurnal_kredit,
jurnal.`kode_akun` AS jurnal_kode_akun
FROM
`jurnal`jurnal
where jurnal.`kode_akun`='".$result['akun_kode_akun']."' AND Year(jurnal.`tanggal`) = '$tahun' and Month(jurnal.tanggal)<='$bulan'";
$query2 = mysql_query($sql2);
$saldo_debit= 0;
$saldo_kredit= 0;
$html.= '<tr><td><strong>'.$result['akun_nama_akun'].'</strong></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td class="right"><strong> No.'.$result['akun_kode_akun'].'</strong></td></tr>';

while($result2 = mysql_fetch_assoc($query2)){

$saldo_debit+= $result2['jurnal_debit'] - $result2['jurnal_kredit'];
$saldo_kredit+= $result2['jurnal_kredit'] - $result2['jurnal_debit'];

$html.= '<tr><td>'.$result2['jurnal_tanggal'].'</td><td>'.$result2['jurnal_keterangan'].'</td>
    <td> Rp.'.number_format($result2['jurnal_debit'],0,'','.').'</td>'.
            '<td> Rp.'.number_format($result2['jurnal_kredit'],0,'','.').
    '</td><td> Rp.'.($result['akun_saldo_normal']=="debit"?(number_format($saldo_debit,0,'','.')):0).'</td><td> Rp.'
.($result['akun_saldo_normal']=="kredit"?(number_format($saldo_kredit,0,'','.')):0).'</td></tr>';
}
$html.='<tr><td colspan="6"><hr style="border: 1px solid black"/></td></tr>';
}
$html.= '</table>';
if(isset($_POST['view_online'])){
echo $html;    
}

if(isset($_POST['print_pdf'])){
    $name = 'laporan_buku_besar.pdf';

    print_pdf('Laporan Buku Besar',$html,$name);
}
}

?>
