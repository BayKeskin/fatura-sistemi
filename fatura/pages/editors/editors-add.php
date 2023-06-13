<?php
include"../../inc/header.php";
include"../../class/editors/editors.php";
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
                            <h1>Editör Ekle</h1>
                        </div>
                        <div class="col-md-7">
                            <?php
                            if(isset($_GET['id']))
                            {
                                ?>
                                <a href="editors-list.php?process=delete&id=<?=$_GET['id']?>" class="btn top-button close"><i class="fa-regular fa-rectangle-xmark fa-fw"></i> Sil</a>
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
                        $authoritys = (array) json_decode($record->authority);
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
                                                <input type="text" value="<?=isset($record)?$record->nick_name:''?>" name="nick_name" class="form-control vRequired" >
                                                <label for="floatingInput">Kullanıcı Adı</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="<?=isset($record)?$record->password:''?>" name="password" class="form-control vRequired">
                                                <label for="floatingInput">Şifre</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>






                        </div>
                        <div class="col-md-6">
                            <div class="sectionbg">
                                <div class="section-title">
                                   Yetkiler:
                                </div>
                                <div class="block">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("billing-account", $authoritys)?'checked':'':''?> value="billing-account" id="billing-account" >
                                                <label class="form-check-label" for="billing-account">
                                                    Fatura Hesapları
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("customer-account", $authoritys)?'checked':'':''?> value="customer-account" id="customer-account" >
                                                <label class="form-check-label" for="customer-account">
                                                    Müşteri Hesapları
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("dashboards", $authoritys)?'checked':'':''?> value="dashboards" id="dashboards" >
                                                <label class="form-check-label" for="dashboards">
                                                    Dashboard
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("list-packed", $authoritys)?'checked':'':''?> value="list-packed" id="list-packed" >
                                                <label class="form-check-label" for="list-packed">
                                                    Paketler
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("editors", $authoritys)?'checked':'':''?> value="editors" id="editors" >
                                                <label class="form-check-label" for="editors">
                                                    Editörler
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="authority[]" type="checkbox" <?=isset($authoritys)?in_array("customer-account-servers", $authoritys)?'checked':'':''?> value="customer-account-servers" id="customer-account-servers" >
                                                <label class="form-check-label" for="customer-account-servers">
                                                    Müşteri Hesapları Server Bilgileri
                                                </label>
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