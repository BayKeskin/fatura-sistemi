<?php
    
    session_start();
    include realpath('../../../')."/include/VeriKatmani.php";
    $db = new veritabaniislem();
    // If you need to parse XLS files, include php-excel-reader
    $klasor ="iceaktar";
    $uzanti = explode(".",$_FILES["ExelDOSYASI"]['name']);
    $uzantial = end($uzanti);
    $isim = md5(rand(0,99999));
    $yenisim = $isim.".".$uzantial;
    if(!empty($_FILES["ExelDOSYASI"]['name']))
    {
                    $ekle = move_uploaded_file($_FILES["ExelDOSYASI"]['tmp_name'],$klasor."/".$yenisim);
                    if($ekle)
                    {
                        $yeniadres =$klasor."/".$yenisim;
                        
                    }
    }
    require('iceaktar/php-excel-reader/excel_reader2.php');

    require('iceaktar/SpreadsheetReader.php');

    $Reader = new SpreadsheetReader($yeniadres);
    foreach ($Reader as $Row)
    {
        if($db->veriSaydir("markalar",array("MarkaBASLIK"),array($Row[0]))<1)
        {
            $markaID = $db->veriEkleSayiAl("markalar",array("NULL","?","?"),array($Row[0],""));
        }ELSE
        {
            $markaID = $db->VeriOkuTek("markalar","MarkaID","MarkaBASLIK",$Row[0]);
        }
        
        if($db->veriSaydir("seriler",array("SeriBASLIK"),array($Row[1]))<1)
        {
            
            $seriID = $db->veriEkleSayiAl("seriler",array("NULL","?","?"),array($markaID,$Row[1]));
        }ELSE
        {
            $seriID = $db->VeriOkuTek("seriler","SeriID","SeriBASLIK",$Row[1]);
        }
        
        if($db->veriEkle("modeller",array("NULL","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?"),
        array($markaID,$seriID,$Row[2],$Row[3],$Row[4],$Row[5],$Row[6],$Row[7],$Row[8],"","",$Row[9],$Row[10],$Row[11],"",""))>0)
        {
            
        }
    }
    $db->Basarili("İçeri aktarma tamamlandı");
    
    
?>