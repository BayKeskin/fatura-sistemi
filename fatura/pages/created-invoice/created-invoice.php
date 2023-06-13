<?php
include"../../inc/header.php";
include"../../class/created-invoice/created-invoice.php";
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
                            <h1>Oluşturulan Faturalar</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                </div>



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
                                            <table class="table table-striped"  style="margin: 0px;
    padding: 0px;">
                                                <tbody style="border: none">
                                                <tr>

                                                    <td>Fatura Hesap Numarası<br><?=$row->customer_biling_account_number?></td>
                                                    <td>Fatura Hesap İsmi<br><?=$db->get_single('billing_account','name','id',$db->get_single('customer_account','biling_account_id','id',$row->customer_id))?></td>
                                                    <td>Fatura Tarihi<br><?=$row->invoice_date?></td>
                                                    <td>Toplam Tutar<br><?=$row->total_price?></td>
                                                    <td>
                                                        <a style="color:#7D8398" href="#">Görüntüle</a>
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
                                                $detail_list = $modul->invoice_detail_list($row->id);
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
            </div>

        </div>
    </form>
<?php
include"../../inc/footer.php";
?>