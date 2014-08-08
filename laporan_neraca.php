
<form action="index.php?menu=laporan&jenis_laporan=neraca" method="POST">
    tanggal <input type="text" name="tanggal" id="tanggal"><a href="javascript:NewCssCal('tanggal','yyyymmdd')"><img src="img/cal.gif"></a>
<input type="submit" name="view_online" value="view online">
<input type="submit" name="print_pdf" value="get pdf"></form>
<?php
$html = '';
if(!empty($_POST)){
     $tanggal = $_POST['tanggal'];
     $tahun= date('Y',strtotime($tanggal));
     $bulan= date('m',strtotime($tanggal));
     $tgl= date('d',strtotime($tanggal));
     $jenis_akun=array('aktiva'=>
         array('aktiva lancar','aktiva tetap'),
                       'passiva'=>
         array('hutang lancar','hutang jangka panjang','modal'));

//=========================== Ambil total pendapatan keseluruhan berdasarkan tahun yg diinput =========================//
//$total=0;
$sql = "SELECT * FROM kode_akun WHERE kode_akun LIKE '4%' OR kode_akun LIKE '5%'";
$result = mysql_query($sql) or die(mysql_error());
$debit = 0;
$kredit = 0;
$total_pendapatan = 0;
//tambahan
while ($data=  mysql_fetch_assoc($result)){


    $sql2="SELECT * FROM jurnal where kode_akun='".$data['kode_akun']."' 
        and (jurnal.`tanggal`) >=  '".$tahun."-01-01' and jurnal.`tanggal`<='$tanggal'";
    $result2=mysql_query($sql2);

    while($data2= mysql_fetch_assoc($result2)){
        $kredit+=$data2['kredit'];
        $debit+=$data2['debit'];
        if (!empty($data2['kredit'])){
            $total_pendapatan+=$data2['kredit'];
        }
        if (!empty($data2['debit'])){
            $total_pendapatan+=$data2['debit'];
        }
    }
 }

 //========================================= HITUNG LABA DITAHAN ================================================//
     $laba_ditahan=0;
     $total1=0;

    $sql2="SELECT * FROM jurnal where kode_akun='316'and jurnal.`tanggal`<=  '$tanggal'";

    $result2=mysql_query($sql2);
    $total1=0;
    while($data2= mysql_fetch_assoc($result2)){
      //$kredit+=$data2['kredit'];
        if (!empty($data2['kredit'])){
            $total1+=$data2['kredit'];

        }
        if (!empty($data2['debit'])){
            $total1+=$data2['debit'];

        }
    }
    
    $laba_ditahan=$total1;
// ==============================================Hitung total Biaya===============================================

   $sql = "SELECT * FROM kode_akun WHERE kode_akun LIKE '6%' order by kode_akun asc";
    $result = mysql_query($sql) or die(mysql_error());
    $kredit=0; $debit=0 ; $total_biaya=0;
    while ($data=  mysql_fetch_assoc($result)){


    $sql2="SELECT * FROM jurnal where kode_akun='".$data['kode_akun']."'and (jurnal.`tanggal`) >=  '".$tahun."-01-01' and jurnal.`tanggal`<='$tanggal'";
    $result2=mysql_query($sql2);
   $total=0;
    while($data2= mysql_fetch_assoc($result2)){
       // $html.='<tr><td style="pading-left:50px">'.$data2['nama_akun'].'</td><td> Rp.'.number_format($data2['debit'],0,'','.').'</td><td> Rp.'.number_format($data2['kredit'],0,'','.').'</td></tr>';
        $kredit+=$data2['kredit'];
        $debit+=$data2['debit'];
        if (!empty($data2['kredit'])){
            $total+=$data2['kredit'];
            $total_biaya+=$data2['kredit'];
        }
        if (!empty($data2['debit'])){
            $total+=$data2['debit'];
            $total_biaya+=$data2['debit'];
        }
    }
    }
 // ==============================================MULAI PERHITUNGAN AKTIVA===============================================

$html.= '<table class="table table_bordered">';
echo '<tr><td colspan="3" style="text-align:center"><p ><h2>ESFERA</h2></p>
    <p>Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung</p>
    <h4>Neraca</h4>
    <p>Periode Sampai : '.$tanggal.'</p>
    <p>Dicetak tanggal : '.date('Y-m-d').'</p></td></tr>';
$tp = 0;
//=========================== Cetak Jenis Akun Utama (Aktiva, Passiva) ========================//
foreach($jenis_akun as $jenis_utama=>$jenis_sub){
    $html.='<tr><td colspan="2"><strong>'.ucfirst($jenis_utama).'</strong></td><td></td></tr>';
    $total_Aktiva=0;
    $total = 0;
    
    $dividen = 0;
    $total_perakun=0;
//========================= Ambil dan cetak jenis sub akun (aktiva lancar, aktiva tetap, hutang lancar, modal) ======================//
    foreach($jenis_sub as $jns){
//        $sql="SELECT jurnal.nama_akun,SUM(jurnal.debit) as debit, SUM(jurnal.kredit) as kredit, kode_akun.saldo_normal,
//            jurnal.keterangan
//            from kode_akun
//            inner join jurnal on jurnal.kode_akun=kode_akun.kode_akun
//            where kode_akun.jenis='$jns' and Year(jurnal.`tanggal`)=  '$tahun' and Month(jurnal.tanggal)<='$bulan'
//            group by kode_akun.kode_akun";
         $sql="SELECT jurnal.nama_akun,SUM(jurnal.debit) as debit, SUM(jurnal.kredit) as kredit, kode_akun.saldo_normal,
            jurnal.keterangan
            from kode_akun
            inner join jurnal on jurnal.kode_akun=kode_akun.kode_akun
            where kode_akun.jenis='$jns' and (jurnal.`tanggal`) >=  '".$tahun."-01-01' and jurnal.`tanggal`<='$tanggal'
            group by kode_akun.kode_akun";
        $result=mysql_query($sql) or die (mysql_error());
        $debit=0;
        $kredit=0;
        $total_perakun=0;
        $tp=0;
        $html.='<tr><td style="padding-left:40px">&nbsp;&nbsp;<strong>'.ucfirst($jns).'</strong></td><td></td></tr>';

        while($data= mysql_fetch_assoc($result)){

            if($data['saldo_normal']=='debit'){
                $debit+=$data['debit'] - $data['kredit'];
                $total_perakun=$debit;
               
            }
            if($data['saldo_normal']=='kredit'){
                $kredit+=$data['kredit'] - $data['debit'];
                $total_perakun=$kredit;
                
            }
            //==============CETAK PER AKUN ============================//
            if(strstr($data['nama_akun'],'Akumulasi')){
                $total_perakun=0-$total_perakun;
                $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;'.$data['nama_akun'].'</td>
                <td> Rp. '.number_format($total_perakun,0,'','.').'</td><td></td></tr>';
                }
            else if($data['nama_akun']=='Kas'){
                if($tanggal==31 && $bulan==12){
                    $total_perakun+=$laba_ditahan;//disini ini yang bikin laba ditahan,jadi dpbel datanya
                }
                 $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;'.$data['nama_akun'].'</td>
                <td> Rp. '.number_format($total_perakun,0,'','.').'</td><td></td></tr>';
                }
            else if($data['nama_akun']=='Laba ditahan'){
		continue;
            }
            
            else if($data['nama_akun'] == 'Dividen'){
                $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;'.$data['nama_akun'].'</td>
                <td> Rp. '.number_format($total_perakun,0,'','.').'</td><td></td></tr>';
                $dividen = $data['debit'];
            }
            else {

                $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;'.$data['nama_akun'].'</td>
                <td> Rp. '.number_format($total_perakun,0,'','.').'</td><td></td></tr>';
                }
            $total+=$total_perakun;
            $total_Aktiva+=$total_perakun;
           $tp = $total_perakun;

            }

//            $total_perakun=0;
    if($jns=="modal"){ 
        $laba_berjalan = $total_pendapatan-$total_biaya;
        if ($bulan==12 && $tgl==31){
            $laba_ditahan += $laba_berjalan;
            $laba_ditahan -= $dividen;
            $laba_berjalan = 0;
            $laba = $laba_ditahan+$laba_berjalan;
        }else{
           $laba = $laba_ditahan+$laba_berjalan;
        }
        $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;Laba Ditahan</td><td> Rp. '.number_format($laba_ditahan,0,'','.').'</td><td></td></tr>';
        $html.='<tr><td style="padding-left:60px">&nbsp;&nbsp;&nbsp;&nbsp;Laba Tahun Berjalan</td><td> Rp. '.number_format($laba_berjalan,0,'','.').'</td><td></td></tr>';
       
       $tp += $laba;
       $total += $laba;
    }

    
//===================Total per sub jenis akun (aktiva lancar, aktiva tetap, modal, hutang)===========================================
            $html.='<tr><td style="padding-left:40px">&nbsp;&nbsp;<strong>Total '.$jns.'</strong></td><td></td><td>Rp. '.number_format($tp,0,'','.').'</td><td></td></tr>';
    }
   
//=================Total per jenis akun utama===================================//
    $html.='<tr><td></td><td></td><td>---------------------- +</td><td></td><td></td></tr>';
    $html.='<tr><td style="padding-left:40px">&nbsp;&nbsp;<strong>Total '.$jenis_utama.'</strong></td><td></td><td> Rp. '.number_format($total,2,',','.').'</td><td></td></tr>';
    $total=0;
    $html.='<tr><td></td><td></td></tr>';}
    $html.='</table>';
    
    if(isset($_POST['print_pdf'])){
    $name='laporan_neraca.pdf';
    include_once 'print_pdf.php';
    print_pdf('Laporan Neraca',$html, $name);}
    if(isset($_POST['view_online'])){
     echo $html;
    }
}





?>


