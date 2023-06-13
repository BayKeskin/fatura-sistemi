<?php
/**
 * @Yazar Talha Keskin
 * @copyright www.talhakeskin.com.tr
 * Bismillahirrahmanirrahim
 */

        $sonuc = array();
        $file = explode("/",$_SERVER["SCRIPT_NAME"]);
        $bulunan =  end($file);

        if($bulunan=="biyografidetay.php")
        {
            $bilgi =$db->VeriOkuCoklu("biyografi",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,etiketler")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->etiketler;
        }
        elseif($bulunan == 'canlitvdetay.php')
        {
            $bilgi = $db->VeriOkuCoklu("canlitv",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,etiketler")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->etiketler;
        }
        elseif($bulunan == 'firmarehberidetay.php')
        {
            $bilgi = $db->VeriOkuCoklu("firmarehberi",array("url"),array($_GET["url"]),"","","","","firmaadi,aciklama,etiketler")[0];
            $title = $bilgi->firmaadi;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->etiketler;
        }
        elseif($bulunan=="firmarehberikategori.php")
        {
            $bilgi = $db->VeriOkuCoklu("kategoriler",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,keywords")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->keywords;
        }
        elseif($bulunan=="fotogalerikategori.php")
        {
            $bilgi =$db->VeriOkuCoklu("kategoriler",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,keywords")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->keywords;
        }
        elseif($bulunan=="galeri.php")
        {
            $galerituru = galerituru($_GET["id"]);
            if($galerituru=="Sirali")
            {
                $baslik = $db->VeriOkuCoklu("fotogaleri",array("id"),array($_GET["id"]),"","","","","baslik,etiketler")[0];
                $bilgi = $db->VeriOkuCoklu("fotogaleri_resimler",array("galeri"),array($_GET["id"]),"","id","ASC","1","alt,aciklama")[0];
                $title = $baslik->baslik;
                $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
                $keyword = $baslik->etiketler;
            }else
            {
                $limit =1;
                $sira=@$_GET["sayfa"];
                if(($sira=="") or !is_numeric($sira))
                {
                    $sira=1;
                }
                $sinir =$baslangic=($sira-1)*$limit;
                $baslik = $db->VeriOkuCoklu("fotogaleri",array("id"),array($_GET["id"]),"","","","","baslik,etiketler")[0];
                $bilgi = $db->VeriOkuCokluSorgu("SELECT alt,aciklama FROM fotogaleri_resimler ORDER BY sira ASC LIMIT $sinir,$limit");
                $title = $baslik->baslik;
                $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
                $keyword = $baslik->etiketler;
            }
        }
        elseif($bulunan=="makale.php")
        {
            $bilgi = $db->VeriOkuCoklu("makaleler",array("id"),array($_GET["id"]),"","","","","baslik,aciklama,etiketler")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->etiketler;
        }
        elseif($bulunan=="sayfa.php")
        {
            $bilgi = $db->VeriOkuCoklu("sayfalar",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,keyws")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->keyws;
        }
        elseif($bulunan=="seriilanlardetay.php")
        {
            $bilgi = $db->VeriOkuCoklu("ilanlar",array("id"),array($_GET["id"]),"","","","","baslik,aciklama")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = '';
        }
        elseif($bulunan=="seriilanlarkategori.php")
        {
            $bilgi = $db->VeriOkuCoklu("kategoriler",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,keywords")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->keywords;
        }
        elseif($bulunan=="tag.php")
        {
            $bilgi = $db->VeriOkuCoklu("seoayarlari",array("dosya"),array("tag.php"))[0];
            $etiket =  $db->VeriOkuCoklu("etiketler",array("url"),array($_GET["url"]))[0];

            $title = $etiket->etiket." ".$bilgi->Titles;
            $aciklama = $etiket->etiket." ".$bilgi->Descs;
            $keyword = $etiket->etiket." ".$bilgi->Keyws;

        }
        elseif($bulunan=="videokategori.php")
        {
            $bilgi = $db->VeriOkuCoklu("kategoriler",array("url"),array($_GET["url"]),"","","","","baslik,aciklama,keywords")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->keywords;
        }
        elseif($bulunan=="videolardetay.php")
        {
            $bilgi = $db->VeriOkuCoklu("videolar",array("id"),array($_GET["id"]),"","","","","baslik,aciklama,etiketler")[0];
            $title = $bilgi->baslik;
            $aciklama = mb_substr(strip_tags($bilgi->aciklama),0,130,"UTF-8");
            $keyword = $bilgi->etiketler;
        }
        elseif($bulunan=="yazardetay.php")
        {
            $bilgi = $db->VeriOkuCoklu("kullanicilar",array("id"),array($_GET["id"]),"","","","","adsoyad,hakkinda")[0];
            $title = $bilgi->adsoyad;
            $aciklama = mb_substr(strip_tags($bilgi->hakkinda),0,130,"UTF-8");
            $keyword = "";
        }
        else
        {
            $title = @$db->VeriOkuTek("seoayarlari","Titles","Dosya",$bulunan);
            $aciklama = @$db->VeriOkuTek("seoayarlari","Descs","Dosya",$bulunan);
            $keyword =@$db->VeriOkuTek("seoayarlari","Keyws","Dosya",$bulunan);


        }

        function galerituru($id)
        {
            global $db;
            $tip =$db->VeriOkuTek("fotogaleri","galeritipi","id",$id);
            if($tip=="Sirali")
            {
                return "Sirali";
            }elseif($tip=="Sayfalı")
            {
                return "Sayfalı";
            }else
            {
                if($db->VeriOkuTek("ayarlar","galeritema","id",1)==1)
                {
                    return "Sayfalı";
                }elseif($db->VeriOkuTek("ayarlar","galeritema","id",1)==0)
                {
                    return "Sirali";
                }else
                {
                    return "Sayfalı";
                }
            }
        }
?>