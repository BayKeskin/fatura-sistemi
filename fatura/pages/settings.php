<?php
include"../inc/header.php";
?>
    <form method="POST" action="" class="ajaxFormFalse addform">
    <div class="container-fluid content">
        <div class="container">
            <div class="title">
                <div class="row">
                    <div class="col-md-5">
                        <h1>Bilgilerimi Düzenle</h1>
                    </div>
                </div>
            </div>


            <div class="col-md-12 response">
            </div>

            <div class="add-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="sectionbg">
                            <div class="section-title">
                                Bilgilerim:
                            </div>
                            <div class="block">
                                <div class="row ">
                                    <div class="col-md-12" >
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="arena-automobile@outlook.de"  name="mail" placeholder="Mail Adresiniz">
                                            <label for="floatingInput">Mail Adresiniz</label>
                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="145236"  name="password" placeholder="Şifre">
                                            <label for="floatingInput">Şifre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sectionbg">
                            <div class="section-title">
                                Girdi Bilgileri:
                            </div>
                            <div class="block">
                                <div class="row ">
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="privatverkauf">Test Privatverkauf </textarea>
                                            <label for="floatingTextarea">Privatverkauf Yazısı</label>
                                        </div>



                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 10px">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="gewerblicher">Gewerblicher Vertrag ABGS</textarea>
                                            <label for="floatingTextarea">Gewerblicher Yazısı</label>
                                        </div>


                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 10px">

                                        <div class="form-floating">
                                            <textarea class="form-control" name="export">Test Export </textarea>
                                            <label for="floatingTextarea">Export Yazısı</label>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sectionbg">
                            <div class="section-title">
                                Fatura ve Kontrat Başlangıç Bilgileri:
                            </div>
                            <div class="block">
                                <div class="row ">
                                    <div class="col-md-6">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="2022"  name="invoice_define"placeholder="Fatura Sabit Numarası">
                                            <label for="floatingInput">Fatura Sabit Numarası</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="11"  name="invoice_start"placeholder="Fatura Artan Numarası">
                                            <label for="floatingInput">Fatura Artan Numarası</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="2023"  name="kontrat_define"placeholder="Kontrat Sabit Numarası">
                                            <label for="floatingInput">Kontrat Sabit Numarası</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="0"  name="kontrat_start" placeholder="Kontrat Artan Numarası">
                                            <label for="floatingInput">Kontrat Sabit Numarası</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sectionbg">
                            <div class="section-title">
                                Çıktı Bilgileri:
                            </div>
                            <div class="block">
                                <div class="row">
                                    <div class="col-md-12 p-t-10">
                                        <div class="form-floating mb-3">
                                            <input type="file" value="" name="logo" class="form-control">
                                            <label for="floatingInput"> Logo (474x134):</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="Arena Automobile"  name="name" placeholder="Firma Adı">
                                            <label for="floatingInput">Firma Adı</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="Emrah Akkilic"  name="authorized_name" placeholder="Yetkili Adı">
                                            <label for="floatingInput">Yetkili Adı</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="90431 Nürnberg"  name="address" placeholder="Adres">
                                            <label for="floatingInput">Adres</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="0911 / 3215790"  name="phone" placeholder="Telefon Numarası">
                                            <label for="floatingInput">Telefon Numarası</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="0911 / 3216175"  name="fax" placeholder="Fax Numarası">
                                            <label for="floatingInput">Fax Numarası</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="www.arenaautomobile.com"  name="web_site" placeholder="Web Site">
                                            <label for="floatingInput">Web Site</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px; text-align: right">
                                        <button style="width: auto" type="submit" class="btn top-button check right"><i class="fa-regular fa-square-check fa-fw"></i> Fertigstellen</button>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>
</form>

<?php
include"../inc/footer.php";
?>