<?php
require_once 'class/tcpdf/config/lang/eng.php';
 require_once 'class/tcpdf/tcpdf.php';
 class LaporanPdf extends TCPDF{
     private $LaporanData;

     function __construct($data, $orientation, $unit, $format){
         parent::__construct($orientation, $unit, $format, true, 'UTF-8', false);
         $this->LaporanData = $data;
         $this->SetMargins(72, 36, 72, true);
         $this->SetAutoPageBreak(true, 120);
         $this->SetCreator(PDF_CREATOR);
         $this->SetAuthor('Staff');
         $this->SetTitle('Laporan'.$this->LaporanData['title']);
         $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
         global $l;

         $this->setLanguageArray($l);
     }
     public function Header() {
         global $webcolor;
$this->SetMargins(72,100,72,true);
         $bigFont= 14;
         $imagescale = (128.0 / 26.0) * $bigFont;
         $smallfont= (16.0 / 26.0) * $bigFont;
         $this->SetY(20, true);
         $this->SetFont('times','b',$bigFont);
         $this->Cell(0,0,'Esfera',0,1,"C");
         $this->SetFont('times','i',$smallfont);
         $this->Cell(0,0,'Gedung E lantai 2 No. 208
Jalan Telekomunikasi 1, Terusan Buah Batu, Bandung',0,1,'C');

          $this->SetFont('times','b',$bigFont-2);
         $this->Cell(0,0,$this->LaporanData['title'],0,1,"C");

          $this->SetFont('times','',$smallfont);
         $this->Cell(0,0,'Dicetak Tanggal: '.date('d M Y'),0,1,'R');

         $this->SetY(91.5*72,true);
         $this->SetLineStyle(Array('width'=>2,'color'=>array( $webcolor['black'])));
         $this->Line(72,36+($imagescale-20),$this->getPageWidth() -72, 36+ ($imagescale-20));
     }
     public function Footer(){
         global $webcolor;

         $this->SetLineStyle(Array('width'=>2,'color'=>array( $webcolor['black'])));
         $this->Line(72,$this->getPageHeight() -1.5 * 72-2,
                 $this->getPageWidth()- 72,
                 $this->getPageHeight()-1.5 * 72 - 2);
         $this->SetFont('times','',8);
         $this->setY(-1.5 *72, true);
         $this->Cell(0,0,'page'.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,1,"R");
     }
     public function CreateReport(){
         $this->AddPage();
         $this->SetFont('helvetica','',11);
         $this->SetY(100,true);
         $this->writeHTML($this->LaporanData['html'], true, false, true, false);

     }
 }
function print_pdf($header,$html,$filename){
   
    $data = array('title'=>$header,'html'=>$html);
   $pdf = new LaporanPdf($data,'P','pt','LETTER');
   $pdf->CreateReport();

    ob_end_clean();
    return $pdf->Output($filename,"I");
    //echo $html;
}



