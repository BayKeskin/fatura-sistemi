<?php
@session_start();
ob_start();
ini_set("display_errors",1);
date_default_timezone_set('Europe/Istanbul');
include "DataLayer.php";
$db = new Database();
$settings = $db->multi_record("setting")[0];
$directory = $settings->directory;
$siteURL = $settings->site_url;
include"class.upload.php";
include"generalfunction.php";
include"language.php";

Class System
{

    function percentage_calculation($number,$percentage){
        return ($number*$percentage)/100;
    }
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
    function classLoad()
    {
        global $bulunan;
        global $file;
        if($file[2]!='admin' AND $bulunan!='inf-api.php')
        {
            if(file_exists("../../class/".str_replace(".php","",$bulunan)."/".$bulunan))
            {
                    include "../../class/".str_replace(".php","",$bulunan)."/".$bulunan;
            }

        }
    }

    function date_replace($date)
    {
        $explode   =explode("-",$date);
        $new_date=$explode[2]."-".$explode[1]."-".$explode[0];
        return $new_date;
    }

    function day_return($date){
        global $db;
        $date=explode ("-",$this->date_replace($date));
        $day = date("l",mktime(0,0,0,$date[1],$date[0],$date[2]));
        $day_english = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $day_ = array("Montag","Deinstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag");
        $day_replace = str_replace($day_english,$day_,$day);
        return $day_replace;
    }


    function get_date_day_and_month($date,$type='datetime')
    {
        $months = array("","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");

        $explode = explode(" ", $date);
        $time = isset($explode[1])?$explode[1]:'';
        $date = $explode[0];
        $dates = explode("-", $date);
        $month = $dates[1];
        if ($month < 10)
        {
            $month = str_replace("0", "", $month);
        } else
        {
            $month = $month;
        }

        $day = $this->day_return($date);

        if($type=='datetime')
        {
            echo $dates[2] . " " . $months[$month] . " " . $dates[0] . " $day " . $time;
        }else
        {
            if($type=='dateday')
            {
                echo $dates[2] . " " . $months[$month] . " " . $dates[0] . " $day ";
            }

            if($type=='date')
            {
                echo $dates[2] . " " . $months[$month] . " " . $dates[0];
            }

        }

    }



    function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Bilinmiyor';
        $mobil = 'Bilinmiyor';
        //Sonra hangi tarayıcı olduğuna  göz atalım
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        $iphone = strpos($u_agent, "iPhone");
        $android = strpos($u_agent, "Android");
        $ipod = strpos($u_agent, "iPod");
        if ($iphone == true || $android == true || $ipod == true)
        {
            $mobil = "Mobil";
        } else
        {
            $mobil = "Bilgisayar";
        }
        return array($bname, $mobil);
    }
    function add_date_day($hangitarih,$kacgun)
    {
        $bugun =$hangitarih;
        $yenitarih = strtotime("$kacgun day",strtotime($bugun));
        $yenitarih = date('Y-m-d' ,$yenitarih );
        return $yenitarih;
    }
    function delete_date_day($hangitarih,$kacgun)
    {
        $bugun =$hangitarih;
        $yenitarih = strtotime("-$kacgun day",strtotime($bugun));
        $yenitarih = date('Y-m-d' ,$yenitarih );
        return $yenitarih;
    }

    function HttpStatus($code) {
        $status = array(
          100 => 'Continue',
          101 => 'Switching Protocols',
          200 => 'OK',
          201 => 'Created',
          202 => 'Accepted',
          203 => 'Non-Authoritative Information',
          204 => 'No Content',
          205 => 'Reset Content',
          206 => 'Partial Content',
          300 => 'Multiple Choices',
          301 => 'Moved Permanently',
          302 => 'Found',
          303 => 'See Other',
          304 => 'Not Modified',
          305 => 'Use Proxy',
          306 => '(Unused)',
          307 => 'Temporary Redirect',
          400 => 'Bad Request',
          401 => 'Unauthorized',
          402 => 'Payment Required',
          403 => 'Forbidden',
          404 => 'Not Found',
          405 => 'Method Not Allowed',
          406 => 'Not Acceptable',
          407 => 'Proxy Authentication Required',
          408 => 'Request Timeout',
          409 => 'Conflict',
          410 => 'Gone',
          411 => 'Length Required',
          412 => 'Precondition Failed',
          413 => 'Request Entity Too Large',
          414 => 'Request-URI Too Long',
          415 => 'Unsupported Media Type',
          416 => 'Requested Range Not Satisfiable',
          417 => 'Expectation Failed',
          500 => 'Internal Server Error',
          501 => 'Not Implemented',
          502 => 'Bad Gateway',
          503 => 'Service Unavailable',
          504 => 'Gateway Timeout',
          505 => 'HTTP Version Not Supported');

        // gönderilen kod listede yok ise 500 durum kodu gönderilsin.
        return $status[$code] ? $status[$code] : $status[500];
    }
    // Header ayarlama fonksiyonu
    function SetHeader($code){
        header("HTTP/1.1 ".$code." ".$this->HttpStatus($code));
        header("Content-Type: application/json; charset=utf-8");
    }


    function GetIP()
    {
        if(getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
    }

    function sendmail($subject, $message, $mails = array(),$sender="",$imza="")
    {
        global $db;
        include 'class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'cartool.studiomoco.de';
        $mail->Port = 465;
        $mail->Username = 'info@cartool.studiomoco.de';
        $mail->Password = '1i-n1-e,_,0?';
        $mail->SMTPSecure = 'ssl';
        if($sender=="")
        {
            $mail->SetFrom($mail->Username, $subject);
        }else
        {
            $mail->SetFrom($sender, $subject);
        }
        foreach ($mails as $m)
        {
            $mail->addBCC($m, "Du");
        }
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        if ($mail->Send())
        {

            return true;
        } else
        {

            return false;
        }
    }
}



$system = new System();




