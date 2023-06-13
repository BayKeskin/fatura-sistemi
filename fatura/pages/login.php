<?php
include"../include/System.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Die smarte Art der Fahrzeugverwaltung für Autohändler</title>

    <link rel="stylesheet" href="/<?=$directory?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/fonts/font-avasome/css/all.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/css/style.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/css/validation_master.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/<?=$directory?>assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

</head>
<body>
<div class="container-fluid login-header">
    <div class="container ">
        <div class="row">
            <div class="col-md-6">
                <img src="/fatura/images/general-logo.png">
            </div>
            <div class="col-md-6">
                <p>Die smarte Art der Fahrzeugverwaltung für Autohändler</p>
            </div>
        </div>
    </div>
</div>

<video autoplay muted loop id="myVideo">
    <source src="/fatura/video.mp4" type="video/mp4">
</video>


<div class="login-content">
    <form method="POST">
        <div class="response">
            <h3>Login</h3>
            <input name="mail" type="text" class="form-control" placeholder="E-Mail">
            <input name="password" type="password" class="form-control" placeholder="Passwort">
            <button class="btn btn-primary" type="submit"><i class="far fa-square-check fa-fw"></i> Anmelden </button>
            <div class="row">
                <div class="col-md-6">
                    <a class="forgot-pass" href="javascript:void(0)">Passwort vergessen?</a>
                </div>
            </div>
        </div>


    </form>

</div>
<script type="text/javascript">
    var dizin = 'fatura/';
    var vMinTarmesaj = "";
    var vMaxTarmesaj = "";
    var vCheckMinTarmesaj = "";
    var vCheckRequiredmaxmesaj = "";
    var vRequiredmesaj = "Bu alanı boş bıraktınız";
    var vNumericmesaj = "Bu alana sadece rakam girebilirsiniz";
    var vNumericNotmesaj = "Bu alanda sadece hatf girebilirsiniz";
    var vEmailFiltermesaj = "Geçerli bir mail adresi giriniz";
    var vMaxcharmesaj = "Bu alanda minimum seçim yapmanız gerekiyor";
    var vMincharmesaj = "Bu alanda minimum seçim yapmanız gerekiyor";
    var vPasswordConfirmmesaj = "Girdiğiniz şifreler birbiri ile aynı olmalıdır";
    var vCheckRequiredmesaj = "Bu alanda seçim yapmalısınız";
    var vCheckRequiredminmesaj = "Bu alanda seçim yapmalısınız";
    var vTcRequiredmesaj = "Geçerli bir TC Numarası giriniz";
    var vYoutubemesaj = "Geçerli Bir Adres Giriniz";
    var vFileSizemesaj = "%c KB'den fazla resim veya dosya yükleyemezsiniz.";
    var js_kalan_stok_uyari = "Bu ürünün kalan stok adeti : ";
    var js_tc_uyari = "Bu kategoride ürün alabilmek için tc kimlik numaranızı doğrulamanız gerekmektedir TC Kimlik numaranızı doğrulamak için";
    var js_tikla = "Bu kategoride ürün alabilmek için tc kimlik numaranızı doğrulamanız gerekmektedir TC Kimlik numaranızı doğrulamak için";
</script>
<script type="text/javascript" src="/<?=$directory?>assets/js/popper.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/validation_master.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/<?=$directory?>assets/js/owl.carousel.js"></script>
<link rel="stylesheet" href="/<?=$directory?>assets/css/animate.css">
<script type="text/javascript" src="/<?=$directory?>assets/js/app.js"></script>

</body>
</html>