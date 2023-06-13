<?php
include"../../inc/header.php";
include"../../class/customer-account/customer-account.php";
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
                            <h1>Müşteri Hesabı Ekle</h1>
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
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->custumer_id:''?>" name="custumer_id" class="form-control vRequired" >
                                                <label for="floatingInput">Müşteri ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->name:''?>" name="name" class="form-control vRequired">
                                                <label for="floatingInput">Müşteri Adı</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control form-select vRequired" name="biling_account_id">
                                                    <?php
                                                    $biling_account_list = $modul->biling_account_list();
                                                    if($biling_account_list===false)
                                                    {

                                                    }else
                                                    {
                                                        foreach ($biling_account_list as $bal)
                                                        {
                                                            ?>
                                                            <option <?=isset($record)?$record->biling_account_id==$bal->id?'selected':'':''?> value="<?=$bal->id?>"><?=$bal->name?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingSelect">Fatura Hesabı Seçin</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="sectionbg">
                                <div class="section-title">
                                    Paket Bilgileri:
                                </div>
                                <?php
                                if(isset($record))
                                {
                                    $packed = $db->multi_record('customer_packets',array('customer_id'),array($_GET["id"]))[0];
                                }
                                ?>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="process" data-div="process">
                                                    <option <?=isset($packed)?$packed->process=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->process=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">İşlem</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 process" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->process_price:''?>" name="process_price" class="form-control  currency" >
                                                <label for="floatingInput">İşlem Fiyatı</label>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="package" data-div="package">
                                                    <option <?=isset($packed)?$packed->package=='0'?'selected':'':''?>  value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->package=='1'?'selected':'':''?>  value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">Paket</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 package" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->package_price:''?>" name="package_price" class="form-control  currency" >
                                                <label for="floatingInput">Paket Fiyatı</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="fixed_price" data-div="fixed_price">
                                                    <option <?=isset($packed)?$packed->fixed_price=='0'?'selected':'':''?> value="0">Hayır</option>

                                                    <option <?=isset($packed)?$packed->fixed_price=='1'?'selected':'':''?> value="1">Evet</option>


                                                </select>
                                                <label for="floatingSelect">Sabit Fiyat</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 fixed_price" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->fixed_price_price:''?>" name="fixed_price_price" class="form-control  currency">
                                                <label for="floatingInput">Sabit Fiyat Fiyatı</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 fixed_price" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <textarea style="height: 300px"  name="fixed_price_desc" class="form-control " ><?=isset($packed)?$packed->fixed_price_desc:''?></textarea>
                                                <label for="floatingInput">Sabit Fiyat Açıklaması</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 fixed_price" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->fixed_price_quantity:''?>" name="fixed_price_quantity" class="form-control  currency">
                                                <label for="floatingInput">Sabit Fiyat Adet</label>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="taking_picture" data-div="taking_picture">
                                                    <option <?=isset($packed)?$packed->taking_picture=='0'?'selected':'':''?>  value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->taking_picture=='1'?'selected':'':''?>  value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">Resim Çekilecek mi</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 taking_picture" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->taking_picture_price:''?>" name="taking_picture_price" class="form-control  currency" >
                                                <label for="floatingInput">Resim Çekme Fiyatı</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="image_cleaning" data-div="image_cleaning">
                                                    <option <?=isset($packed)?$packed->image_cleaning=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->image_cleaning=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">Resim Temizleme</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 image_cleaning" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->image_cleaning_price:''?>" name="image_cleaning_price" class="form-control  currency" >
                                                <label for="floatingInput">Resim Temizleme Fiyatı</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="outdoor_shooting_360" data-div="outdoor_shooting_360">
                                                    <option <?=isset($packed)?$packed->outdoor_shooting_360=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->outdoor_shooting_360=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">360 Derece Dış Çekim</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 outdoor_shooting_360" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->outdoor_shooting_360_pice:''?>" name="outdoor_shooting_360_pice" class="form-control  currency" >
                                                <label for="floatingInput">360 Derece Dış Çekim Fiyatı</label>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="outdoor_shooting_360_clear" data-div="outdoor_shooting_360_clear">
                                                    <option <?=isset($packed)?$packed->outdoor_shooting_360_clear=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->outdoor_shooting_360_clear=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">360 Derece Dış Çekim Temizleme</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 outdoor_shooting_360_clear" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->outdoor_shooting_360_clear_price:''?>" name="outdoor_shooting_360_clear_price" class="form-control  currency" >
                                                <label for="floatingInput">360 Derece Dış Çekim Temizleme Fiyatı</label>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="inner_shooting_360" data-div="inner_shooting_360">
                                                    <option <?=isset($packed)?$packed->inner_shooting_360=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->inner_shooting_360=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">360 Derece İç Çekim</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 inner_shooting_360" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->inner_shooting_360_price:''?>" name="inner_shooting_360_price" class="form-control  currency" >
                                                <label for="floatingInput">360 Derece İç Çekim Fiyatı</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control true_false_select vRequired" name="inner_shooting_360_clear" data-div="inner_shooting_360_clear">
                                                    <option <?=isset($packed)?$packed->inner_shooting_360_clear=='0'?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($packed)?$packed->inner_shooting_360_clear=='1'?'selected':'':''?> value="1">Evet</option>

                                                </select>
                                                <label for="floatingSelect">360 Derece İç Çekim Temizleme</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 inner_shooting_360_clear" style="<?=isset($packed)?'display:block':'display:none'?>">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($packed)?$packed->inner_shooting_360_clear_price:''?>" name="inner_shooting_360_clear_price" class="form-control  currency" >
                                                <label for="floatingInput">360 Derece İç Çekim Temizleme Fiyatı</label>
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
                                                <input type="text" value="<?=isset($record)?$record->by_location:''?>" name="by_location" class="form-control vRequired" >
                                                <label for="floatingInput">Şubeye Göre mi?</label>
                                            </div>

                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <select class="form-control" name="set_invoice">
                                                    <option <?=isset($record)?$record->set_invoice==0?'selected':'':''?> value="0">Hayır</option>
                                                    <option <?=isset($record)?$record->set_invoice==1?'selected':'':''?> value="1">Evet</option>
                                                </select>
                                                <label for="floatingSelect">Fatura Olacak mı?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sectionbg">
                                <div class="section-title">
                                    Server Bilgileri:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <?php
                                        if(isset($record))
                                        {
                                            $database_information = json_decode($record->database_information);
                                        }

                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($database_information)?$database_information->database_host:''?>" name="database_host" class="form-control " >
                                                <label for="floatingInput">Sunucu Adresi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($database_information)?$database_information->database_name:''?>" name="database_name" class="form-control ">
                                                <label for="floatingInput">Database İsmi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($database_information)?$database_information->database_user:''?>" name="database_user" class="form-control " >
                                                <label for="floatingInput">Database Kullanıcı Adı</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($database_information)?$database_information->database_pass:''?>" name="database_pass" class="form-control " >
                                                <label for="floatingInput">DataBase Kullanıcı Şifresi</label>
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