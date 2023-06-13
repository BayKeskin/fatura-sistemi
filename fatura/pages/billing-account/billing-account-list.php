<?php
include"../../inc/header.php";
include"../../class/billing-account/billing-account.php";
$modul = new Modul();
?>
    <form method="POST" action="">
        <div class="container-fluid content">
            <div class="container">

                <div class="title">
                    <div class="row">
                        <div class="col-md-5">
                            <h1>Fatura Hesapları</h1>
                        </div>
                        <div class="col-md-7">

                            <div class="dropdown"  style="display: inline-block">
                                <a href="<?=$modul->list_url[2]?>" class="btn btn-secondary download" type="button">
                                    <i class="fa-solid fa-plus fa-fw"></i> Yeni Ekle
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
                            <th>Başlık</th>
                            <th>Posta Kodu</th>
                            <th>Vergi Numarası</th>
                            <th>Şehir</th>
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
                            foreach ($all_record as $row)
                            {
                                ?>
                                <tr>
                                    <td><span><?=$row->name?></span> <br> </td>
                                    <td><?=$row->post_code?></td>
                                    <td><?=$row->tax_number?></td>
                                    <td><?=$row->country?></td>
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
                            }
                        }
                        ?>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </form>
<?php
include"../../inc/footer.php";
?>