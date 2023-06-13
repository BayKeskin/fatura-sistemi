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
                            <h1>Araçlar</h1>
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

                        </thead>
                        <tbody>

                        <?php
                        $query = "SELECT *,ca.id as caid FROM customer_account ca INNER JOIN  customer_packets cp ON cp.customer_id=ca.id WHERE ca.set_invoice=1";
                        $sonuclar = $db->multi_record_query($query);

                        $fatura_baslangic = $_POST['start_date'];
                        $fatura_bitis = $_POST['finish_date'];

                        foreach ($sonuclar as $s)
                        {
                            $json = json_decode($s->database_information);
                            $db->connect_server($json->database_host,$json->database_name,$json->database_user,$json->database_pass);
                            $erstelltam_query = "SELECT * FROM (SELECT blType,standort, STR_TO_DATE(erstelltam,'%d.%m.%Y') as erstelltam, STR_TO_DATE(freigestelltam,'%d.%m.%Y') as freigestelltam, STR_TO_DATE(freigestelltam360,'%d.%m.%Y') as freigestelltam360, STR_TO_DATE(exportstatus,'%d.%m.%Y') as exportstatus, STR_TO_DATE(faktura,'%d.%m.%Y') as faktura, STR_TO_DATE(images,'%d.%m.%Y') as images, STR_TO_DATE(images,'%d.%m.%Y') as images360 FROM fahrzeug) as x WHERE x.erstelltam>='$fatura_baslangic' AND x.erstelltam<='$fatura_bitis'";

                            if($s->by_location!='')
                            {
                                $erstelltam_query.=" AND x.standort='$s->by_location'";
                            }

                            $erstelltam_car_record =$db->multi_record_query($erstelltam_query,"",1);

                            $erstelltam_car_count = 0;
                            if($erstelltam_car_record===false)
                            {

                            }else
                            {
                                foreach ($erstelltam_car_record as $cars)
                                {

                                    $erstelltam_car_count++;
                                }
                            }



                            $faktura_query = "SELECT * FROM (SELECT blType,standort,interior,removebginterior, STR_TO_DATE(erstelltam,'%d.%m.%Y') as erstelltam, STR_TO_DATE(freigestelltam,'%d.%m.%Y') as freigestelltam, STR_TO_DATE(freigestelltam360,'%d.%m.%Y') as freigestelltam360, STR_TO_DATE(exportstatus,'%d.%m.%Y') as exportstatus, STR_TO_DATE(faktura,'%d.%m.%Y') as faktura, STR_TO_DATE(images,'%d.%m.%Y') as images, STR_TO_DATE(images,'%d.%m.%Y') as images360 FROM fahrzeug) as x WHERE x.faktura>='$fatura_baslangic' AND x.faktura<='$fatura_bitis'";

                            if($s->by_location!='')
                            {
                                $faktura_query.=" AND x.standort='$s->by_location'";
                            }



                            if($s->process==1)
                            {
                                if($erstelltam_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "Prozess",
                                        $erstelltam_car_count,
                                        $s->process_price,
                                        $erstelltam_car_count* str_replace(',','.',$s->process_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> Prozess</td>
                                        <td><?=$erstelltam_car_count?></td>
                                        <td><?=$s->process_price?></td>
                                        <td><?=$erstelltam_car_count* str_replace(',','.',$s->process_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }

                            if($s->package==1)
                            {

                                $faktura_car_record =$db->multi_record_query($faktura_query,"",1);

                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }
                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "Paket",
                                        $faktura_car_count,
                                        $s->package_price,
                                        $faktura_car_count* str_replace(',','.',$s->package_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>

                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> Paket</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->package_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->package_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }



                            if($s->fixed_price==1)
                            {
                                if($s->fixed_price_quantity>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        $s->fixed_price_desc,
                                        $s->fixed_price_quantity,
                                        $s->fixed_price_price,
                                        $s->fixed_price_quantity* str_replace(',','.',$s->fixed_price_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");

                                    ?>
                                    <tr>

                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br><?=$s->fixed_price_desc?></td>
                                        <td><?=$s->fixed_price_quantity?></td>
                                        <td><?=$s->fixed_price_price?></td>
                                        <td><?=$s->fixed_price_quantity* str_replace(',','.',$s->fixed_price_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>

                                    <?php
                                }

                            }

                            if($s->taking_picture==1 AND $s->image_cleaning==1)
                            {
                                $in_query=" AND x.images IS NOT NULL";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);

                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "Bilder erstellen",
                                        $faktura_car_count,
                                        $s->taking_picture_price,
                                        $faktura_car_count* str_replace(',','.',$s->taking_picture_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> Bilder erstellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->taking_picture_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->taking_picture_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }

                                $in_query=" AND x.freigestelltam IS NOT NULL";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "Bilder freistellen",
                                        $faktura_car_count,
                                        $s->image_cleaning_price,
                                        $faktura_car_count* str_replace(',','.',$s->image_cleaning_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> Bilder freistellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->image_cleaning_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->image_cleaning_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }

                            if(($s->taking_picture==1 AND $s->image_cleaning==0) OR ($s->taking_picture==0 AND $s->image_cleaning==1))
                            {

                                $in_query=" AND (x.images  IS NOT NULL OR x.freigestelltam IS NOT NULL  )";

                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "Bilder Paket",
                                        $faktura_car_count,
                                        str_replace(',','.',$s->taking_picture_price)+str_replace(',','.',$s->image_cleaning_price),
                                        $faktura_car_count* (str_replace(',','.',$s->taking_picture_price)+str_replace(',','.',$s->image_cleaning_price) ),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> Bilder Paket</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=str_replace(',','.',$s->taking_picture_price)+str_replace(',','.',$s->image_cleaning_price)?></td>
                                        <td><?=$faktura_car_count* (str_replace(',','.',$s->taking_picture_price)+str_replace(',','.',$s->image_cleaning_price) )?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }


                            if($s->outdoor_shooting_360==1 AND $s->outdoor_shooting_360_clear==1)
                            {

                                $in_query=" AND x.images360 IS NOT NULL";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Ext erstellen",
                                        $faktura_car_count,
                                        $s->outdoor_shooting_360_pice,
                                        $faktura_car_count* str_replace(',','.',$s->outdoor_shooting_360_pice),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> 360 Ext erstellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->outdoor_shooting_360_pice?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->outdoor_shooting_360_pice) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                                $in_query=" AND x.freigestelltam360 IS NOT NULL";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Ext freistellen",
                                        $faktura_car_count,
                                        $s->outdoor_shooting_360_clear_price,
                                        $faktura_car_count* str_replace(',','.',$s->outdoor_shooting_360_clear_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> 360 Ext freistellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->outdoor_shooting_360_clear_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->outdoor_shooting_360_clear_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }


                            if(($s->outdoor_shooting_360==1 AND $s->outdoor_shooting_360_clear==0) OR ($s->outdoor_shooting_360_clear==0 AND $s->outdoor_shooting_360==1))
                            {

                                $in_query=" AND (x.freigestelltam360 IS NOT NULL OR x.images360 IS NOT NULL)";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Ext Paket",
                                        $faktura_car_count,
                                        str_replace(',','.',$s->outdoor_shooting_360_clear_price)+str_replace(',','.',$s->outdoor_shooting_360_pice),
                                        $faktura_car_count* ( str_replace(',','.',$s->outdoor_shooting_360_clear_price)+str_replace(',','.',$s->outdoor_shooting_360_pice) ) ,
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> 360 Ext Paket</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=str_replace(',','.',$s->outdoor_shooting_360_clear_price)+str_replace(',','.',$s->outdoor_shooting_360_pice)?></td>
                                        <td><?=$faktura_car_count* ( str_replace(',','.',$s->outdoor_shooting_360_clear_price)+str_replace(',','.',$s->outdoor_shooting_360_pice) ) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }

                            if($s->inner_shooting_360==1 AND $s->inner_shooting_360_clear==1)
                            {
                                $in_query=" AND x.interior!='' ";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);

                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }


                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Int erstellen",
                                        $faktura_car_count,
                                        $s->inner_shooting_360_price,
                                        $faktura_car_count* str_replace(',','.',$s->inner_shooting_360_price) ,
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> 360 Int erstellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->inner_shooting_360_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->inner_shooting_360_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }

                                $in_query=" AND x.removebginterior!='' ";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);


                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Int freistellen",
                                        $faktura_car_count,
                                        $s->inner_shooting_360_clear_price,
                                        $faktura_car_count* str_replace(',','.',$s->inner_shooting_360_clear_price),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");
                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br> 360 Int freistellen</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=$s->inner_shooting_360_clear_price?></td>
                                        <td><?=$faktura_car_count* str_replace(',','.',$s->inner_shooting_360_clear_price) ?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }
                            if(($s->inner_shooting_360==1 AND $s->inner_shooting_360_clear==0) OR ($s->inner_shooting_360_clear==0 AND $s->inner_shooting_360==1))
                            {
                                $in_query=" AND (x.interior!='' OR  x.removebginterior!='')";
                                $faktura_car_record =$db->multi_record_query($faktura_query.$in_query,"",1);

                                $faktura_car_count = 0;
                                if($faktura_car_record===false)
                                {

                                }else
                                {
                                    foreach ($faktura_car_record as $ss)
                                    {
                                        $faktura_car_count++;
                                    }
                                }

                                if($faktura_car_count>0)
                                {
                                    $db->insert('invoice_details',array("NULL", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?"),array(
                                        $s->caid,
                                        $db->get_single('billing_account','biling_account_number','id',$s->biling_account_id),
                                        $s->by_location,
                                        $s->name,
                                        "360 Int Paket",
                                        $faktura_car_count,
                                        str_replace(',','.',$s->inner_shooting_360_clear_price)+str_replace(',','.',$s->inner_shooting_360_price),
                                        $faktura_car_count*( str_replace(',','.',$s->inner_shooting_360_clear_price)+str_replace(',','.',$s->inner_shooting_360_price) ),
                                        $_POST["start_date"],
                                        $_POST["finish_date"],
                                        $_POST["invoice_date"],
                                        0
                                    ),"");


                                    ?>
                                    <tr>
                                        <td>
                                            <?=$s->caid?>
                                        </td>
                                        <td><?=$db->get_single('billing_account','biling_account_number','id',$s->biling_account_id)?></td>
                                        <td><?=$s->by_location?></td>
                                        <td><?=$s->name?><br>360 Int Paket</td>
                                        <td><?=$faktura_car_count?></td>
                                        <td><?=str_replace(',','.',$s->inner_shooting_360_clear_price)+str_replace(',','.',$s->inner_shooting_360_price) ?></td>
                                        <td><?=$faktura_car_count*( str_replace(',','.',$s->inner_shooting_360_clear_price)+str_replace(',','.',$s->inner_shooting_360_price) )?></td>
                                        <td><?=$_POST["invoice_date"]?></td>
                                    </tr>
                                    <?php

                                }
                            }

                        }
                        ?>
                        </tbody>
                    </table>

                    <div class="col-md-12">
                        <?=$db->Success('Faturalar oluşturuldu')?>
                    </div>


                </div>
            </div>

        </div>
    </form>
<?php
include"../../inc/footer.php";
?>