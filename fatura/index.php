<?php
include"include/System.php";
session_destroy();
if(isset($_SESSION["id"]))
{
    header('Location: '.$siteURL.'/pages/list.php');
}else
{
    header('Location: '.$siteURL.'/pages/login.php');
}
