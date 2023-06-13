<?php
include"../../inc/header.php";
include"../../class/editors/editors.php";
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



                <div class="list">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Kullanıcı Adı</th>
                            <th>Şifre</th>
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
                                    <td><span><?=$row->nick_name?></span> <br> </td>
                                    <td><?=$row->password?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis fa-fw"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item deletebtn" data-bs-toggle="modal" data-bs-target="#delete-mdl" data-href="editors-list.php?process=delete&id=<?=$row->id?>" href="javascript:void(0);">Sil</a></li>
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