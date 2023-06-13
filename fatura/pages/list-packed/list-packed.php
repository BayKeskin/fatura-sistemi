<?php
include"../../inc/header.php";
include"../../class/list-packed/list-packed.php";
$modul = new Modul();
?>
    <form method="POST" action="">
        <div class="container-fluid content">
            <div class="container">

                <div class="title">
                    <div class="row">
                        <div class="col-md-5">
                            <h1>Müşteri Paketleri</h1>
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
                            <th>Müşteri Adı</th>
                            <th>İşlem</th>
                            <th>Paket</th>
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
                                    <td><span><?=$db->get_single('customer_account','name','id',$row->customer_id)?></span> <br> </td>
                                    <td><?=$row->process?></td>
                                    <td><?=$row->package?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis fa-fw"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="../../pages/customer-account/customer-account-add.php?id=<?=$row->id?>">Düzenle</a></li>
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