
<form action="index.php?menu=laporan&jenis_laporan=laba_rugi" method="POST">
    tanggal <input type="text" name="tanggal" id="tanggal"><a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a>
<input type="submit" name="view_online" value="view online">
<input type="submit" name="print_pdf" value="get pdf"></form>
<?php
$html = '';
include_once'print_pdf.php';
if(!empty($_POST)){
  $tanggal = $_POST['tanggal'];
 $tahun= date('Y',strtotime($tanggal));
 $bulan= date('m',strtotime($tanggal));



 $sql = "SELECT * FROM kode_akun WHERE kode_akun LIKE '4%' OR kode_akun LIKE '5%' 
     OR kode_akun LIKE '1%' order by kode_akun asc";
$result = mysql_query($sql) or die(mysql_error());


$html.= '<table class="table table_bordered">';
echo '<tr><td colspan="3"><p>ESFERA</p>
    <p>Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung</p>
    <h4>Laba Rugi</h4>
    <p>Dicetak tanggal :'.date('Y-m-d').'</p></td></tr>';
$kredit=0; $debit=0; $kas=0;
$total_pendapatan=0;
while ($data=  mysql_fetch_assoc($result)){
 
    //tarik data pendapatan dan kas
$sql = "SELECT * FROM kode_akun WHERE kode_akun LIKE '5%' OR kode_akun LIKE '1%' order by kode_akun asc";
$result = mysql_query($sql) or die(mysql_error());
$kredit=0; $debit=0 ; $total_pendapatan=0;
$html.='<tr><td><strong>Pendapatan :</strong></td><td></td><td></td><td></td></tr>';
while ($data=  mysql_fetch_assoc($result)){

if ($data['kode_akun']=='111' || substr($data['kode_akun'],0,1)=='5'){

$sql2="SELECT * FROM jurnal where kode_akun='".$data['kode_akun']."' and Year(jurnal.`tanggal`)=  '$tahun' and Month(jurnal.tanggal)<='$bulan'
   ";
    $result2=mysql_query($sql2);
   $total=0;
    while($data2= mysql_fetch_assoc($result2)){
      if (($data['kode_akun']=='111' && $data2['keterangan']== 'Laba')|| strstr($data['kode_akun'],'5')){
        // $html.='<tr><td style="pading-left:50px">'.$data2['nama_akun'].'</td><td> Rp.'.number_format($data2['debit'],0,'','.').'</td><td> Rp.'.number_format($data2['kredit'],0,'','.').'</td></tr>';
        $kredit+=$data2['kredit'];
        $debit+=$data2['debit'];
        if (!empty($data2['kredit'])){
            $total+=$data2['kredit'];
$total_pendapatan+=$data2['kredit'];
        }
        if (!empty($data2['debit'])){
            $total+=$data2['debit'];
            $total_pendapatan+=$data2['debit'];
            }
            if ($data['kode_akun']=='111' && $data2['keterangan']== 'Laba'){$kas+=$data2['debit'];}
      if ($data['nama_akun']=='Pendapatan lain-lain'){$kas+=$data2['debit'];}
    }}
     if ((!$data['kode_akun']=='111' && $data2['keterangan']!= 'Laba')|| strstr($data['kode_akun'],'5')){

if ($data['nama_akun']=='Pendapatan lain-lain'){
     $html.= '<tr><td style="padding-left:50px">&nbsp;&nbsp;'.$data['nama_akun'].'</td><td></td><td>Rp.'.number_format($kas,0,'','.').'</td><td></td><td></td></tr>';
} else {
//$html.='<tr><td></td><td></td><td>------------- +</td></tr>';
     $html.= '<tr><td style="padding-left:50px">&nbsp;&nbsp;'.$data['nama_akun'].'</td><td></td><td>Rp.'.number_format($total,0,'','.').'</td><td></td><td></td></tr>';
     }}
    }}
      $html.='<tr><td></td><td></td><td>---------------------- +</td><td></td><td></td></tr>';
    $html.='<tr><td><strong>Total Pendapatan</strong></td><td></td><td></td><td>Rp.'.number_format($total_pendapatan,0,'','.').'</td></tr>';
 $html.='<tr><td></td><td></td><td></td><td></td></tr>';
   }

//biaya
   $sql = "SELECT * FROM kode_akun WHERE kode_akun LIKE '6%' order by kode_akun asc";
$result = mysql_query($sql) or die(mysql_error());
$kredit=0; $debit=0 ; $total_biaya=0;
$html.='<tr><td><strong>Biaya :</strong></td><td></td><td></td><td></td></tr>';
$Deviden=0;
$Biaya_pajak=0;
while ($data=  mysql_fetch_assoc($result)){

   
    $sql2="SELECT * FROM jurnal where kode_akun='".$data['kode_akun']."'and Year(jurnal.`tanggal`)=  '$tahun' and Month(jurnal.tanggal)<='$bulan'
   ";
    $result2=mysql_query($sql2);
   $total=0;
    while($data2= mysql_fetch_assoc($result2)){
       // $html.='<tr><td style="pading-left:50px">'.$data2['nama_akun'].'</td><td> Rp.'.number_format($data2['debit'],0,'','.').'</td><td> Rp.'.number_format($data2['kredit'],0,'','.').'</td></tr>';
        $kredit+=$data2['kredit'];
        $debit+=$data2['debit'];
        if (!empty($data2['kredit'])){
           if ($data['nama_akun']=='Deviden'){$Deviden+=$data['kredit'];}

            $total+=$data2['kredit'];
$total_biaya+=$data2['kredit'];
        }
        if (!empty($data2['debit'])){
            if ($data['nama_akun']=='Biaya pajak'){$Biaya_pajak+=$data2['debit'];}
     elseif ($data['nama_akun']=='Deviden'){$Deviden+=$data2['debit'];}
else{
            $total+=$data2['debit'];
            $total_biaya+=$data2['debit'];
            }
        }
    }
    //$html.='<tr><td></td><td></td><td>------------- +</td></tr>';
    if($data ['nama_akun']=='Biaya pajak'||$data['nama_akun']=='Deviden'){}
    else{
$html.= '<tr><td style="padding-left:50px">&nbsp;&nbsp;'.$data['nama_akun'].'</td><td></td><td>Rp.'.number_format($total,0,'','.').'</td><td></td><td></td></tr>';
    }
    }
      $html.='<tr><td></td><td></td><td>---------------------- +</td><td></td><td></td></tr>';
    $html.='<tr><td><strong>Total Biaya</strong></td><td></td><td></td><td>Rp.'.number_format($total_biaya,0,'','.').'</td></tr>';
     $html.='<tr><td></td><td></td><td></td><td>---------------------- -</td></tr>';
 $html.= '<tr><td><strong>Laba Sebelum Pajak</strong></td><td></td><td></td><td>Rp.'.number_format($total_pendapatan-$total_biaya,0,'','.').'</td></tr>';
  $html.= '<tr><td><strong>Pajak</strong></td><td></td><td></td><td>Rp.'.number_format($Biaya_pajak,0,'','.').'</td></tr>';
 $html.='<tr><td></td><td></td><td></td><td>---------------------- -</td></tr>';
 $html.= '<tr><td><strong>Laba Setelah Pajak</strong></td><td></td><td></td><td>Rp.'.number_format($total_pendapatan-$total_biaya-$Biaya_pajak,0,'','.').'</td></tr>';
$html.= '<tr><td><strong>Deviden</strong></td><td></td><td></td><td>Rp.'.number_format($Deviden,0,'','.').'</td></tr>';
 $html.='<tr><td></td><td></td><td></td><td>---------------------- -</td></tr>';
  $html.= '<tr><td><strong>Laba Bersih</strong></td><td></td><td></td><td>Rp.'.number_format($total_pendapatan-$total_biaya-$Biaya_pajak-$Deviden,0,'','.').'</td></tr>';
 
 $html.='</table>';
 if(isset($_POST['print_pdf'])){
    $name = 'laporan_laba_Rugi.pdf';

    print_pdf('Laporan Laba Rugi',$html,$name);
}
if(isset($_POST['view_online'])){
    echo $html;}
    }



?>
