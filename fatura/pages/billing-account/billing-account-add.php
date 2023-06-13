<?php
include"../../inc/header.php";
include"../../class/billing-account/billing-account.php";
$modul = new Modul();
?>
    <form method="POST" action="" class="ajaxFormFalse addform">
        <div class="container-fluid content">
            <div class="container">
                <div class="title">
                    <div class="row">
                        <div class="col-md-12 turn-back">
                            <a href="../../pages/<?=$modul->list_url[1]?>/<?=$modul->list_url[0]?>"><i class="fa-solid fa-chevron-left "></i> Geri Dön</a>
                        </div>

                        <div class="col-md-5">
                            <h1>Fatura Hesabı Ekle</h1>
                        </div>
                        <div class="col-md-7">
                            <?php
                            if(isset($_GET['id']))
                            {
                                ?>
                                <a href="billing-account-list.php?process=delete&id=<?=$_GET['id']?>" class="btn top-button close"><i class="fa-regular fa-rectangle-xmark fa-fw"></i> Sil</a>
                                <div class="add-head-btn">
                                    <input type="submit" name="insert" class="btn check" value='Düzenle'>
                                    <i class="fa-regular fa-square-check fa-fw"></i>
                                </div>
                                <?php
                            }else
                            {
                                ?>
                                <div class="add-head-btn">
                                    <input type="submit" name="insert" class="btn check" value='Ekle'>
                                    <i class="fa-regular fa-square-check fa-fw"></i>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="process-response">
                    <?php
                    if($_POST)
                    {
                        if(isset($_GET['id']))
                        {
                            $modul->update();
                        }else
                        {
                            $modul->insert();
                        }
                    }
                    if(isset($_GET["id"]))
                    {
                        $record = $db->multi_record($modul->table,array($modul->primary),array($_GET["id"]))[0];
                    }

                    ?>
                </div>

                <div class="add-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sectionbg">
                                <div class="section-title">
                                    Bilgiler:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->biling_account_number:''?>" name="biling_account_number" class="form-control vRequired">
                                                <label for="floatingInput">Fatura hesap numarası</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                               <input type="text" value="<?=isset($record)?$record->name:''?>" name="name" class="form-control vRequired">
                                               <label for="floatingInput">Başlık</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sectionbg">
                                <div class="section-title">
                                    Adres Bilgileri:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12" >
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->street:''?>" name="street" class="form-control vRequired" >
                                                <label for="floatingInput">Sokak Adı</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->post_code:''?>" name="post_code" class="form-control vRequired">
                                                <label for="floatingInput">Posta Kodu</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12" >
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->city:''?>" name="city" class="form-control vRequired">
                                                <label for="floatingInput">Şehir</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->country:''?>" name="country" class="form-control vRequired">
                                                <label for="floatingInput">Ülke</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="col-md-6">
                            <div class="sectionbg">
                                <div class="section-title">
                                    Diğer Bilgiler:
                                </div>
                                <div class="block">
                                    <div class="row ">

                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->payment_day:''?>" name="payment_day" class="form-control vRequired" >
                                                <label for="floatingInput">Ödeme Günü</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->discount:''?>" name="discount" class="form-control vRequired" >
                                                <label for="floatingInput">İndirim</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->salesman:''?>" name="salesman" class="form-control vRequired" >
                                                <label for="floatingInput">Satış Elemanı</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->commission:''?>" name="commission" class="form-control vRequired" >
                                                <label for="floatingInput">Komisyon</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->mail:''?>" name="mail" class="form-control vRequired" >
                                                <label for="floatingInput">Mail</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="sectionbg">
                                <div class="section-title">
                                    Vergi Bilgileri:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12" >
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->tax_number:''?>" name="tax_number" class="form-control vRequired">
                                                <label for="floatingInput">Vergi Numarası</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control tax_exemption" name="tax_exemption">
                                                    <option <?=isset($record)?$record->tax_exemption==0?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($record)?$record->tax_exemption==1?'selected':'':''?> value="1">Evet</option>
                                                </select>
                                                <label for="floatingInput">Vergi Muafiyeti</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 tax_rate">
                                            <div class="form-floating">
                                                <input type="text" value="<?=isset($record)?$record->tax_rate:''?>" name="tax_rate" class="form-control">
                                                <label for="floatingInput">Vergi Oranı</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sectionbg">
                                <div class="section-title">
                                   Footer Yazısı:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12" >
                                            <div class="form-floating">
                                                <textarea class="form-control" name="text_footer"><?=isset($record)?$record->text_footer:''?></textarea>
                                                <label for="floatingInput">Text Footer</label>
                                            </div>
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
include"../../inc/footer.php";
?>