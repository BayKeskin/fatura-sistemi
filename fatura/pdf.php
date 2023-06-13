<?php
ini_set('display_errors',1);
include"include/System.php";
function getRandomUserAgent()
{
    $userAgents=array(
      "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6",
      "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
      "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
      "Opera/9.20 (Windows NT 6.0; U; en)",
      "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.50",
      "Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1) Opera 7.02 [en]",
      "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; fr; rv:1.7) Gecko/20040624 Firefox/0.9",
      "Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48"
    );
    $random = rand(0,count($userAgents)-1);

    return $userAgents[$random];
}
function GetMetodu($url) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_USERAGENT,getRandomUserAgent());
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
    curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90s
    // curl_setopt($ch,CURLOPT_HEADER, false);

    $output=curl_exec($ch);
    curl_close($ch);
    return  $output;
}

$html = GetMetodu('https://cartool.studiomoco.de/print/'.$_GET["document_type"].'.php?id='.$_GET["id"].'');

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
// DomPdf options ile Php kullanımını aktif etmeniz gerekiyor. Aksi takdirde php ile gönderdiğiniz sorgular çalışmayacaktır.
$options = new Options();
$options->set('isPhpEnabled', TRUE);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview)
if($_GET["document_type"]=='kontrat')
{
    $record = $db->multi_record('rental_records',array("id"),array($_GET["id"]))[0];
    if(isset($record->id))
    {
        $customer =json_decode($record->customer_json);
    }
    $dompdf->stream('Kaufvertrag'."-".$customer->name_surname."-".$record->document_number, array("Attachment" => 1));
}else
{
    $record = $db->multi_record('rental_records',array("id"),array($_GET["id"]))[0];
    if(isset($record->id))
    {
        $customer =json_decode($record->customer_json);
    }


    $dompdf->stream('Rechnung'."-".$customer->name_surname."-".$record->document_number, array("Attachment" => 1));
}



?>