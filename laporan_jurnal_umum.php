<form action="index.php?menu=laporan&jenis_laporan=jurnal_umum" method="POST">
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
 $html.= '<table class="table table-bordered">';
echo '<tr><td colspan="3"><p>ESFERA</p>
    <p>Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung</p>
    <h4>JURNAL UMUM</h4>
    <p>Dicetak tanggal :'.date('Y-m-d').'</p></td></tr>';
$result = mysql_query("SELECT
     jurnal.`tanggal` AS jurnal_tanggal,
SUM(jurnal.`debit`) AS jurnal_debit,
SUM(jurnal.`kredit`) AS jurnal_kredit
FROM
 `jurnal` jurnal
WHERE
        Year (jurnal.`tanggal`)='$tahun' and Month(jurnal.tanggal)<='$bulan'
  
GROUP BY
 jurnal.`tanggal`");

while($data= mysql_fetch_array($result)){
    $html.= '<tr style="font-weight:bold"><td>Tanggal : '.$data['jurnal_tanggal'].'</td><td>Debit</td><td>Kredit</td></tr>';
 $sql2 = "SELECT jurnal.nama_akun as nama_akun,jurnal.debit,jurnal.kredit,jurnal.keterangan FROM jurnal LEFT JOIN kode_akun ON jurnal.kode_akun = kode_akun.kode_akun
    WHERE jurnal.tanggal='".$data['jurnal_tanggal']."'
        ORDER BY jurnal.bukti ASC";
 $result2 =mysql_query($sql2) or die(mysql_error());
 while($data2 = mysql_fetch_assoc($result2)){

     $html.= '<tr><td style="padding-left:20px">&nbsp;'.$data2['nama_akun'].'</td><td> Rp.'.number_format($data2['debit'],0,'','.').'</td><td> Rp.'.number_format($data2['kredit'],0,'','.').'</td></tr>';
 }
 $html.= '<tr><td>Total</td><td> Rp.'.number_format($data['jurnal_debit'],0,'','.').'</td><td> Rp.'.number_format($data['jurnal_kredit'],0,'','.').'</td></tr>';
$html.='<tr><td colspan="3"><hr style="border: 1px solid black"/></td></tr>';

}

$html.= '</table>';
if(isset($_POST['view_online'])){
 echo $html;   
}

if(isset($_POST['print_pdf'])){
    $name = 'laporan_jurnal_umum.pdf';
  
    print_pdf('Laporan Jurnal Umum',$html,$name);
}
}

?>
