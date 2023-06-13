<?php
include"../../include/System.php";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

</head>
<body>


<div class="container-fluid header">
    <div class="container">

        <div class="row">
            <div class="col-md-11 p-r-0">
                <nav class="navbar navbar-expand-lg">

                    <a class="navbar-brand" href="#"><img src="/<?=$directory?>images/logo.png"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        </ul>
                        <form class="d-flex" role="search">
                            <div class="input-group mb-3">
                                <button class="btn" type="button"
                                        id="button-addon1"><i class="fa-solid fa-magnifying-glass fa-fw"></i></button>
                                <input type="text" class="form-control" placeholder="Arama yap.." aria-label="Example text with button addon" aria-describedby="button-addon1">
                            </div>
                        </form>
                    </div>

                </nav>
            </div>

            <div class="col-md-1 p-l-0 text-right">
                <a href="javascript:void(0)" ><i onclick="myFunction()" class="fa-solid fa-braille dropbtn"></i></a>
            </div>

            <div class="dropdown-drop">
                <div id="myDropdown" class="dropdown-content">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Müşteri Hesapları
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../pages/customer-account/customer-account-list.php">Liste</a></li>
                            <li><a class="dropdown-item" href="../../pages/customer-account/customer-account-add.php">Ekle</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fatura Hesapları
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../pages/billing-account/billing-account-list.php">Liste</a></li>
                            <li><a class="dropdown-item" href="../../pages/billing-account/billing-account-add.php">Ekle</a></li>
                        </ul>
                    </li>

                    <li class="nav-item" >
                        <a class="nav-link" aria-current="page" href="../../pages/list-packed/list-packed.php">Paketler</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Faturalar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../pages/pending-invoice/pending-invoice.php">Oluşturulmayı Bekleyenler</a></li>
                            <li><a class="dropdown-item" href="../../pages/created-invoice/created-invoice.php">Oluşturulanlar</a></li>
                        </ul>
                    </li>
                    <div style="float: right">

                        <li class="nav-item" >
                            <a class="nav-link" aria-current="page" href="#">Ayarlar</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link" aria-current="page" href="../../pages/editors/editors-list.php">Editörler</a>
                        </li>
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>