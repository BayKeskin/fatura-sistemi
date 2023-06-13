<?php
Class Modul
{
    function Login()
    {
        global $db;
        global $siteURL;
        if($db->count_record("companies",array('mail','password'),array($_POST['mail'],$_POST['password']))>0)
        {
            $_SESSION["id"]=$db->get_single('companies','id','mail',$_POST['mail']);
            $db->Successful(page_login_success_message);
            ?>
            <script>
                setTimeout(function() { document.location = '<?=$siteURL?>/pages/list.php'; }, 2000)
            </script>
            <?php

        }else
        {
            $db->Error(page_login_error_message);
        }
    }

    function ForgotPass()
    {
        global $system;
        global $db;
        if($db->count_record("companies",array('mail'),array($_POST['mail']))>0)
        {
            $pass = $db->get_single('companies','password','mail',$_POST['mail']);
            $system->sendmail('Ihr Passwort','Ihr Passwort:'.$pass,array($_POST['mail']));
            $db->Successful(page_login_forgot_response_message);
        }else
        {
            $db->Error(page_login_forgot_response_error_message);
        }


    }
}