<?php
include"../../inc/header.php";
include"../../class/pending-invoice/pending-invoice.php";
$modul = new Modul();
?>
<style>
    .accordion-button
    {
        background:none !important;
        box-shadow: none;
        padding-bottom: 0px;
        padding-top: 0px;
    }
</style>
    <form method="POST" action="">
        <div class="container-fluid content">
            <div class="container">

                <div class="title">
                    <div class="row">
                        <div class="col-md-5">
                            <h1>Oluşturulmayı Bekleyen Faturalar</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <?php
                    if(isset($_GET['progess']))
                    {
                        if($_GET["progess"]=='delete')
                        {
                            $modul->delete();
                        }elseif($_GET["progess"]=='details-delete')
                        {
                            $modul->detailsDelete();
                        }
                    }
                    if($_POST)
                    {
                        $modul->create();
                    }
                    ?>
                </div>


                <form method="POST" action="">

                    <div class="dropdown" style="float: right;">
                        <button style="background: #91C561; color:#fff; border:1px solid #91C561 " class="btn btn-secondary download" type="submit">
                            <i class="fa-solid fa-plus fa-fw"></i> Fatura Oluştur
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="list">

                        <div class="accordion" id="accordionExample">

                            <?php
                            $all_record = $modul->all();
                            if($all_record===false)
                            {

                            }else
                            {

                                foreach ($all_record as $row)
                                {
                                    ?>
                                    <div class="accordion-item" style="margin-bottom: 15px">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$row->id?>" aria-expanded="true" aria-controls="collapse<?=$row->id?>">
                                                <table class="table table-striped" style="margin: 0px;
    padding: 0px;">
                                                    <tbody style="border: none">
                                                    <tr>

                                                        <td><input type="checkbox" name="pending_id[]" value="<?=$row->id?>"></td>
                                                        <td>Fatura Hesap Numarası<br><?=$row->customer_biling_account_number?></td>
                                                        <td>Fatura Hesap İsmi<br><?=$db->get_single('billing_account','name','id',$db->get_single('customer_account','biling_account_id','id',$row->customer_id))?></td>
                                                        <td>Fatura Tarihi<br><?=$row->invoice_date?></td>
                                                        <td>Toplam Tutar<br><?=$row->toplam?></td>
                                                        <td>
                                                            <a style="color:#7D8398" href="../../pages/pending-invoice/pending-invoice.php?progess=delete&id=<?=$row->id?>"><i class="fa-solid fa-trash-can fa-fw"></i> </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </button>
                                        </h2>
                                        <div id="collapse<?=$row->id?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <table class="table table-striped">
                                                    <tbody>
                                                    <?php
                                                    $detail_list = $modul->invoice_detail_list($row->invoice_date,$row->customer_biling_account_number);
                                                    if($detail_list===false)
                                                    {

                                                    }else
                                                    {
                                                        foreach ($detail_list as $dl)
                                                        {
                                                            ?>
                                                            <tr>

                                                                <td>Fatura Hesap Numarası<br><?=$dl->customer_biling_account_number?></td>
                                                                <td>Müşteri Hesap Numarası <br><?=$db->get_single('customer_account','custumer_id','id',$row->customer_id)?> - <?=$db->get_single('customer_account','name','id',$row->customer_id)?></td>
                                                                <td>Açıklama<br><?=$db->get_single('customer_account','name','id',$row->customer_id)?> <br><?=$dl->type?></td>
                                                                <td>Adet<br><?=$dl->quantity?></td>
                                                                <td>Adet Fiyatı<br><?=$dl->quantity_price?></td>

                                                                <td>Toplam Fiyat<br><?=$dl->total_price?></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa-solid fa-ellipsis fa-fw"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="../../pages/pending-invoice/pending-invoice.php?progess=details-delete&id=<?=$dl->id?>">Sil</a></li>
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
                                    <?php

                                }
                            }
                            ?>


                        </div>






                    </div>
                </form>

            </div>

        </div>
    </form>
<?php
include"../../inc/footer.php";
?>