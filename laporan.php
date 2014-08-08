<div class="span3">
<ul class="nav nav-list">
    <li><a href="index.php?menu=laporan&jenis_laporan=jurnal_umum" >Cetak Laporan Jurnal Umum</a></li>
    <li><a href="index.php?menu=laporan&jenis_laporan=buku_besar">Cetak Laporan Buku Besar</a></li>
    <li><a href="index.php?menu=laporan&jenis_laporan=neraca_saldo">Cetak Laporan Neraca Saldo</a></li>
    <li><a href="index.php?menu=laporan&jenis_laporan=laba_rugi">Cetak Laporan Laba Rugi</a></li>
    <li><a href="index.php?menu=laporan&jenis_laporan=neraca">Cetak Laporan Neraca</a></li>
</ul>
</div>
<div class="span9">

    <?php
    if(isset($_GET['jenis_laporan']) && ($_GET['jenis_laporan']=='jurnal_umum')){
        include_once 'laporan_jurnal_umum.php';
    }else if(isset($_GET['jenis_laporan']) && ($_GET['jenis_laporan']=='buku_besar')){
        include_once 'laporan_buku_besar.php';
    }
     else if(isset($_GET['jenis_laporan']) && ($_GET['jenis_laporan']=='neraca_saldo')){
        include_once 'laporan_neraca_saldo.php';
    }
         else if(isset($_GET['jenis_laporan']) && ($_GET['jenis_laporan']=='laba_rugi')){
        include_once 'laporan_laba_rugi.php';
         }
         else if(isset($_GET['jenis_laporan']) && ($_GET['jenis_laporan']=='neraca')){
        include_once 'laporan_neraca.php';
         }
//    include_once 'class/tcpdf/tcpdf.php';
//    include_once 'class/PHPJasperXML.inc.php';
//    include_once 'setting.php';
//if(isset($_GET['jenis_laporan'])){
//    if($_GET['jenis_laporan'] == 'jurnal_umum'){
//        echo'cetak laporan';
//        $xml = simplexml_load_file("jurnal_umum.jrxml");
//        $PHPJasperXML = new PHPJasperXML();
////        $PHPJasperXML->arrayParameter=array("tahun"=>2005);
//        $PHPJasperXML->xml_dismantle($xml);
//
//        $PHPJasperXML->transferDBtoArray($server, $user, $pass, $db);
//        ob_clean();
//        $PHPJasperXML->outpage("I");
////        is_array($PHPJasperXML);
////        $vsr = 56;
//    }

    ?>
</div>