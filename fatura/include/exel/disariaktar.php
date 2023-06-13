<?php
include"../Sistem.php";
include_once("xlsxwriter.class.php");
$tarih = date("Y-m-d H-i-s");
$filename = "$tarih.xlsx";


header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

if($_GET["islem"]=="Urunler")
{
    $header = array(
      'Ürün Adı *'=>'string', //0
      'Ürün İkinci Adı *'=>'string', //1
      'Ürün Markası *'=>'string', //2
      'Mağaza Kodu'=>'string', //3
      'Ürün GTIN Kodu'=>'string', //4
      'Ürün MPN Kodu'=>'string',//5
      'Ürün Resmi *'=>'string',//6
      'Ürün Fiyatı *'=>'string',//7
      'Ürün Açıklaması *'=>'string',//8
      'Genel Stok Miktarı *'=>'string',//9
      'Kargo Hazırlık Süresi *'=>'string',//10
      'Türkiye Satışı Varmı'=>'string',//11
      'Kıbrıs Satışı Varmı'=>'string',//12
      'Kargo Türü'=>'string',//13
      'Kategori'=>'string',//14
      'Pazarlığa Açık mı'=>'string'//15
    );
    $db->bilgial=$db->VeriOkuCoklu("urunler");
    $i =0;
    foreach($db->bilgial as $row)
    {
        if($db->veriSaydir("markalar",array("MarkaID"),array($row->UrunMARKA))>0)
        {
            $marka = $db->VeriOkuTek("markalar","MarkaBASLIK","MarkaID",$row->UrunMARKA);
        }else
        {
            $marka="";
        }

        $data[$i][]=$row->UrunBASLIK;
        $data[$i][]=$row->UrunIKINCIBASLIK;
        $data[$i][]=$marka;
        $data[$i][]=$row->UrunMAGAZAKOD;
        $data[$i][]=$row->UrunGTIN;
        $data[$i][]=$row->UrunMPN;
        $resimler = "https://mgz.vitrinde.net/".$row->UrunRESIM;
        if($db->veriSaydir("urun_resimleri",array("UrunID"),array($row->UrunID))>0)
        {
            $db->bilgial =$db->VeriOkuCoklu("urun_resimleri",array("UrunID"),array($row->UrunID));
            foreach($db->bilgial as $rows)
            {
                $resimler.=";https://mgz.vitrinde.net/".$rows->ResimBASLIK;
            }
        }
        $data[$i][]=$resimler;
        $data[$i][]=$row->UrunFIYAT;
        $data[$i][]=$row->UrunACIKLAMA;
        $data[$i][]=$row->UrunGENELSTOK;
        $data[$i][]=$row->UrunKARGOSURESI;
        $data[$i][]=$row->TurkiyeSATIS;
        $data[$i][]=$row->KibrisSATIS;
        $data[$i][]=$row->KargoTURU;
        $data[$i][]=$_GET["KategoriID"];
        $data[$i][]=$row->UrunPAZARLIK;
        $i++;
    }
}elseif($_GET["islem"]=="Uyeler")
{
    $header = array(
      'Üye Adı ve Soyadı'=>'string',
      'Mail Adresi'=>'string',
      'Telefon Numarası'=>'string',
      'Şehir'=>'string'
    );
    $db->bilgial =$db->VeriOkuCoklu("uyeler");
    $i =0;
    foreach($db->bilgial as $row)
    {
        $data[$i][]=$row->UyeADISOYADI;
        $data[$i][]=$row->UyeMAIL;
        $data[$i][]=$row->UyeTELEFON;
        if($row->UyeSEHIR==0)
        {
            $data[$i][]="Şehir bilgisi girilmedi";
        }else
        {
            $data[$i][]=$db->VeriOkuTek("il","ad","ilID",$row->UyeSEHIR);
        }

        $i++;
    }
}






$writer = new XLSXWriter();
$writer->setAuthor('Some Author');
$writer->writeSheet($data,'Sheet1',$header);
$writer->writeToStdOut();
//$writer->writeToFile('example.xlsx');
//echo $writer->writeToString();
exit(0);
/*
function exportExcel($filename='ExportExcel',$columns=array(),$data=array(),$replaceDotCol=array()){
    header('Content-Encoding: UTF-8');
    header('Content-Type: text/plain; charset=utf-8');
    header("Content-disposition: attachment; filename=".$filename.".xls");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $say=count($columns);

    echo '<table border="1"><tr>';
    foreach($columns as $v){
        echo '<th style="background-color:#CCC; font-size:16px;">'.trim($v).'</th>';
    }
    echo '</tr>';

    foreach($data as $val){
        echo '<tr>';
        for($i=0; $i < $say; $i++){

            if(@in_array($i,$replaceDotCol)){
                echo '<td style="font-size:16px;">'.str_replace('.',',',@$val[$i]).'</td>';
            }else{
                echo '<td style="font-size:16px;">'.@$val[$i].'</td>';
            }
        }
        echo '</tr>';
    }
    echo"</table>";
}

$columns=array(
  'Ürün Kimlik Bilgisi',
  'Ürün Adı',
  'Ürün İkinci Adı',
  'Mağaza Kodu',
  'Ürün GTIN Kodu',
  'Ürün MPN Kodu',
  'Üretim Tarihi',
  'Son Kullanma Tarihi',
  'Ürün Açıklaması',
  'Genel Stok Miktarı',
  'Satış Aralığı Varmı',
  'Satış Başlangıç Tarihi',
  'Satış Bitiş Tarihi',
  'Kargo Hazırlık Süresi',
  'Türkiye Satışı Varmı',
  'Kıbrıs Satışı Varmı',
  'Kargo Şartı',
  'Ürün Fiyatı',
  'Ürünün Web Sitesi',
  'Ürün Resmi',
  'Ürün Markası',
  'Ürün Durumu',
  'Kargo Türü',
  'Kargo Ücreti',
  'Kategori',
  'Pazarlığa Açık mı',
);

$data[]=array(
'Kimlik-01',
'İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20',
'Ofis için ideal bilgisayar/HDMI Monitör',
'0123',
'2365988',
'1478899',
'2019-05-17',
'2021-02-20',
'Lorem Ipsum, dizgi ve baskı...',
'100',
'0',
'2020-04-03',
'2020-04-03',
'3',
'1',
'1',
'',
'100.00',
'http://www.ornek.com',
'http://www.talhakeskin.com.tr/buyuketicaret/images/1856029.jpg',
'HP',
'1',
'0',
'5',
$_GET["KategoriID"],
'1'
);
$data[]=array(
  'Kimlik-01',
  'İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20',
  'Ofis için ideal bilgisayar/HDMI Monitör',
  '0123',
  '2365988',
  '1478899',
  '2019-05-17',
  '2021-02-20',
  'Lorem Ipsum, dizgi ve baskı...',
  '100',
  '1',
  '2020-04-03',
  '2020-04-03',
  '5',
  '1',
  '0',
  '',
  '100.00',
  'http://www.ornek.com',
  'http://www.talhakeskin.com.tr/buyuketicaret/images/1856029.jpg',
  'HP',
  '1',
  '0',
  '5',
  $_GET["KategoriID"],
  '0'
);
exportExcel('excel_dosya_adı',$columns,$data,0);
*/
?>