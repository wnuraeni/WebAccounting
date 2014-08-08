<form action="index.php?menu=laporan&jenis_laporan=neraca_saldo" method="POST">
    tanggal <input type="text" name="tanggal" id="tanggal"><a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a>
<input type="submit" name="view_online" value="view online">
<input type="submit" name="print_pdf" value="get pdf"></form>
<?php
    include_once'print_pdf.php';
$html = '';
if(!empty($_POST)){
  $tanggal = $_POST['tanggal'];
 $tahun= date('Y',strtotime($tanggal));
 $bulan= date('m',strtotime($tanggal));

$sql = "SELECT `kode_akun`.kode_akun, kode_akun.nama_akun, jurnal.keterangan,
CASE
WHEN kode_akun.saldo_normal = 'debit' THEN sum(jurnal.debit - jurnal.kredit)
ELSE 0
END AS debit,
CASE
WHEN kode_akun.saldo_normal = 'kredit' THEN SUM(jurnal.kredit - jurnal.debit)
ELSE 0
END AS kredit
FROM kode_akun LEFT JOIN jurnal ON kode_akun.kode_akun = jurnal.kode_akun WHERE (jurnal.`tanggal`) >=  '".$tahun."-01-01' and jurnal.`tanggal`<='$tanggal'
    GROUP BY kode_akun.kode_akun";
$result = mysql_query($sql) or die(mysql_error());
$html.= '<table class="table table_bordered">';
echo '<tr><td colspan="3"><p>ESFERA</p>
    <p>Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung</p>
    <h4>NERACA SALDO</h4>
    <p>Dicetak tanggal :'.date('Y-m-d').'</p></td></tr>';

 $html.='<tr><td><strong>Kode Akun</strong></td><td><strong>Nama Akun</strong></td><td><strong>Debit</strong></td><td><strong>Kredit</strong></td></tr>';
 $html.='<tr><td colspan="4"><hr style="border: 1px solid black"/></td></tr>';
 $total1=0;
 $total2=0;
 while($data= mysql_fetch_assoc($result)){
     $html.='<tr><td>'.$data ['kode_akun'].'</td>
     <td>'.$data['nama_akun'].'</td>
         <td> Rp.'.number_format($data['debit'],0,'','.').'</td>
             <td> Rp.'.number_format($data['kredit'],0,'','.').'</td></tr>';
     $total1+=$data['debit'];
     $total2+=$data['kredit'];

 }$html.='<tr><td colspan="4"><hr style="border: 1px solid black"/></td></tr>';
 $html.='<tr><td>Total</td><td></td><td> Rp.'.number_format($total1,0,'','.').'</td><td> Rp.'.number_format($total2,0,'','.').'</td></tr>';
 $html.='</table>';
$total1=0;
 $total2=0;
 
if(isset($_POST['view_online'])){
echo $html;
}
if(isset($_POST['print_pdf']))
    {

    $name = 'laporan_neraca_saldo.pdf';

    print_pdf('Laporan Neraca Saldo',$html,$name);
}
}

?>
