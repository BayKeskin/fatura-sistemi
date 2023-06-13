<?php
include"../Sistem.php";
include_once("xlsxwriter.class.php");
$tarih = date("Y-m-d H-i-s");
$filename = "$tarih-diller.xlsx";

header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

if($_GET["tur"]=="detayli")
{
    $header = array(
      '(*) Ürün Adı'=>'string',//0
      'Ürün İkinci Adı'=>'string',//1
      '(*) Ürün Markası'=>'string',//2
      'Mağaza Kodu'=>'string',//3
      'Ürün GTIN Kodu'=>'string',//4
      'Ürün MPN Kodu'=>'string',//5
      '(*) Ürün Resmi'=>'string',//6
      '(*) Ürün Fiyatı'=>'string',//7
      '(*) Ürün Açıklaması'=>'string',//8
      '(*) Genel Stok Miktarı'=>'string',//9
      '(*) Kargo Hazırlık Süresi'=>'string',//10
      'Kargo Şartı'=>'string',//11
      '(*) Kargo Türü'=>'string',//12
      'Kargo Ücreti'=>'string',//13
      '(*) Türkiye Satışı Varmı'=>'string',//14
      '(*) Kıbrıs Satışı Varmı'=>'string',//15
      'Üretim Tarihi'=>'string',//16
      'Son Kullanma Tarihi'=>'string',//17
      'Satış Aralığı Varmı'=>'string',//18
      'Satış Başlangıç Tarihi'=>'string',//19
      'Satış Bitiş Tarihi'=>'string',//20
      '(*) Pazarlığa Açık mı'=>'string'//21
    );
}

if($_GET["tur"]=="pratik")
{
    $header = array(
      '(*) Ürün Adı'=>'string',
      '(*) Ürün Açıklaması'=>'string',
      '(*) Genel Stok Miktarı'=>'string',
      '(*) Ürün Resmi'=>'string',
      '(*) Ürün Markası'=>'string'
    );
}

if($_GET["tur"]=="detayli")
{
    if(isset($_GET["guncelle"]))
    {
        $db->VeriOkuCoklu("urunler",array("KategoriID","Satis","EklemeYontemi"),array($_GET["KategoriID"],1,"Exel"));
        $i =0;
        foreach($db->bilgial as $row)
        {
            $data[$i][]=$row->UrunBASLIK; //0
            $data[$i][]=$row->UrunIKINCIBASLIK; //1
            $data[$i][]=$db->VeriOkuTek("markalar","MarkaBASLIK","MarkaID",$row->UrunMARKA); //2
            $data[$i][]=$row->UrunMAGAZAKOD; //3
            $data[$i][]=$row->UrunGTIN; //4
            $data[$i][]=$row->UrunMPN; //5
            $data[$i][]='https://www.vitrinde.net/'.$row->UrunRESIM; //6
            $data[$i][]=$row->UrunFIYAT; //7
            $data[$i][]=$row->UrunACIKLAMA; //8
            $data[$i][]=$row->UrunGENELSTOK; //9
            $data[$i][]=$row->UrunKARGOSURESI; //10
            $data[$i][]=$row->KargoSARTI; //11
            $data[$i][]=$row->KargoTURU; //12
            $data[$i][]=$row->KargoUCRETI; //13
            $data[$i][]=$row->TurkiyeSATIS; //14
            $data[$i][]=$row->KibrisSATIS; //15
            $data[$i][]=$row->UrunURETIMTARIHI; //16
            $data[$i][]=$row->UrunSONKULLANMATARIHI; //17
            $data[$i][]=$row->satis_araligi; //18
            $data[$i][]=$row->UrunSATISBASLANGIC; //19
            $data[$i][]=$row->UrunSATISBITIS; //20
            $data[$i][]=$row->UrunPAZARLIK; //21
            $i++;
        }
    }else
    {
        $data[0][]='örnek - İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20'; //0
        $data[0][]='örnek - Ofis için ideal bilgisayar/HDMI Monitör'; //1
        $data[0][]='örnek - HP'; //2
        $data[0][]='örnek - 0123'; //3
        $data[0][]='örnek - 2365988'; //4
        $data[0][]='örnek - 1478899'; //5
        $data[0][]='örnek - https://www.vitrinde.net/images/1030552.jpg'; //6
        $data[0][]='örnek - 100.00'; //7
        $data[0][]='örnek - Lorem Ipsum, dizgi ve baskı...'; //8
        $data[0][]='örnek - 100'; //9
        $data[0][]='örnek - 5'; //10
        $data[0][]='100 TLye kargo bedava'; //11
        $data[0][]='örnek - 1'; //12
        $data[0][]='örnek - 5'; //13
        $data[0][]='örnek - 1'; //14
        $data[0][]='örnek - 0'; //15
        $data[0][]='örnek - 2019-05-17'; //16
        $data[0][]='örnek - 2021-02-20'; //17
        $data[0][]='örnek - 1'; //18
        $data[0][]='örnek - 2020-04-03'; //19
        $data[0][]='örnek - 2020-04-03'; //20
        $data[0][]='örnek - 0'; //21


        $data[1][]='örnek - İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20'; //0
        $data[1][]='örnek - Ofis için ideal bilgisayar/HDMI Monitör'; //1
        $data[1][]='örnek - HP'; //2
        $data[1][]='örnek - 0123'; //3
        $data[1][]='örnek - 2365988'; //4
        $data[1][]='örnek - 1478899'; //5
        $data[1][]='örnek - https://www.vitrinde.net/images/1030552.jpg'; //6
        $data[1][]='örnek - 100.00'; //7
        $data[1][]='örnek - Lorem Ipsum, dizgi ve baskı...'; //8
        $data[1][]='örnek - 100'; //9
        $data[1][]='örnek - 5'; //10
        $data[1][]='100 TLye kargo bedava'; //11
        $data[1][]='örnek - 1'; //12
        $data[1][]='örnek - 5'; //13
        $data[1][]='örnek - 1'; //14
        $data[1][]='örnek - 0'; //15
        $data[1][]='örnek - 2019-05-17'; //16
        $data[1][]='örnek - 2021-02-20'; //17
        $data[1][]='örnek - 1'; //18
        $data[1][]='örnek - 2020-04-03'; //19
        $data[1][]='örnek - 2020-04-03'; //20
        $data[1][]='örnek - 0'; //21
    }



}

if($_GET["tur"]=="pratik")
{
    if(isset($_GET["guncelle"]))
    {
        $db->VeriOkuCoklu("urunler",array("KategoriID","Satis","EklemeYontemi"),array($_GET["KategoriID"],1,"Exel"));
        $i =0;
        foreach($db->bilgial as $row)
        {
            $data[$i][]=$row->UrunBASLIK;
            $data[$i][]=$row->UrunACIKLAMA;
            $data[$i][]=$row->UrunGENELSTOK;
            $data[$i][]='https://www.vitrinde.net/'.$row->UrunRESIM;;
            $data[$i][]=$db->VeriOkuTek("markalar","MarkaBASLIK","MarkaID",$row->UrunMARKA); //2
        }
    }else
    {
        $data[0][]='örnek - İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20';
        $data[0][]='örnek - Lorem Ipsum, dizgi ve baskı...';
        $data[0][]='örnek - 100';
        $data[0][]='örnek - https://www.vitrinde.net/images/1030552.jpg';
        $data[0][]='örnek - HP';


        $data[1][]='örnek - İzoly M189 İ5-540m 3.07Ghz 8GB 320GB 20';
        $data[1][]='örnek - Lorem Ipsum, dizgi ve baskı...';
        $data[1][]='örnek - 100';
        $data[1][]='örnek - https://www.vitrinde.net/images/1030552.jpg';
        $data[1][]='örnek - HP';
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