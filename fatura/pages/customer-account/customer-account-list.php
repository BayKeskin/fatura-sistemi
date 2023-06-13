<?php
include"../../inc/header.php";
include"../../class/customer-account/customer-account.php";
$modul = new Modul();


?>
    <form method="POST" action="">
        <div class="container-fluid content">
            <div class="container">

                <div class="title">
                    <div class="row">
                        <div class="col-md-5">
                            <h1>Müşteri Hesapları</h1>
                        </div>
                        <div class="col-md-7">
                            <div class="dropdown"  style="display: inline-block">
                                <a href="<?=$modul->list_url[2]?>" class="btn btn-secondary download" type="button">
                                    <i class="fa-solid fa-plus fa-fw"></i> Yeni Ekle
                                </a>
                            </div>

                            <div class="dropdown"  style="display: inline-block">
                                <a data-bs-toggle="modal" data-bs-target="#faturamodal" class="btn btn-secondary download" type="button">
                                    <i class="fa-solid fa-plus fa-fw"></i> Fatura Ooluştur
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="process-response">
                    <?php
                    if(isset($_GET['process']))
                    {
                        if($_GET['process']=='delete')
                        {
                            $modul->delete();
                        }
                    }
                    ?>
                </div>


                <div class="inline-menu">
                    <a class="active" href="#"> Tümü</a>
                    <a class="" href="#"> Filtre 1</a>
                    <a class="" href="#"> Filtre 2</a>
                    <a class="" href="#"> Filtre 3</a>
                </div>


                <div class="list">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Başlık</th>
                            <th>Fatura Hesabı</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $all_record = $modul->all();
                        if($all_record===false)
                        {

                        }else
                        {
                            $i =0;
                            foreach ($all_record as $row)
                            {
                                ?>
                                <tr>
                                    <td><input class="customer_check_id" value="<?=$row->id?>" type="checkbox"></td>
                                    <td><span><?=$row->name?></span> <br> </td>
                                    <td><?=$db->get_single('billing_account','name','id',$row->biling_account_id)?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis fa-fw"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item deletebtn" data-bs-toggle="modal" data-bs-target="#delete-mdl" data-href="billing-account-list.php?process=delete&id=<?=$row->id?>" href="javascript:void(0);">Sil</a></li>
                                                <li><a class="dropdown-item" href="<?=$modul->list_url[2]?>?id=<?=$row->id?>">Düzenle</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </form>

    <div class="modal fade" id="faturamodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="../../pages/invoice-beetwen-page/invoice-beetwen-page.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body faturamodal">

                        <div class="form-floating mb-3">
                            <input type="date" name="start_date" class="form-control">
                            <label for="floatingInput">Başlangıç Tarihi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" name="finish_date" class="form-control">
                            <label for="floatingInput">Bitiş Tarihi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" name="invoice_date" class="form-control">
                            <label for="floatingInput">Fatura Tarihi</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary classic-btn">Devam Et</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
<?php
include"../../inc/footer.php";
?>