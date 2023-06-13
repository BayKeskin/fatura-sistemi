<?php
include"include/System.php";
$system = new System();
if($_GET["process"]=="kdv-calculate")
{
    $array=array();
    $price = str_replace(array(".",","),array("","."), $_POST["price"]);
    $percentage =$system->percentage_calculation($price,19);
    $array[]= number_format($percentage, 2, ',', '.')."";
    $array[]=  number_format($price+$percentage, 2, ',', '.');
    echo json_encode($array);
}
if($_GET["process"]=="get-customer")
{
    $customers = $db->multi_record("customers",array("id"),array($_POST["id"]))[0];
    if($customers===False)
    {

    }else
    {
        $customers_information[]=$customers->name_surname;
        $customers_information[]=$customers->address;
        $customers_information[]=$customers->city;
        $customers_information[]=$customers->mail;
        $customers_information[]=$customers->phone_number;
        echo json_encode($customers_information);
    }

}
if($_GET["process"]=="get-cars")
{
    $cars = $db->multi_record("cars",array("id"),array($_POST["id"]))[0];
    if($cars===False)
    {

    }else
    {
        $cars_information[]=$cars->brand;
        $cars_information[]=$cars->model;
        $cars_information[]=$cars->chassis_number;
        $cars_information[]=$cars->engine_capacity;
        $cars_information[]=$cars->motor_power;
        $cars_information[]=$cars->number_of_owners;
        $cars_information[]=$cars->color;
	    $cars_information[]=$cars->traffic_release_date;
        $cars_information[]=$cars->total_kilometers;
        $cars_information[]=$cars->next_inspection_date;

        echo json_encode($cars_information);
    }

}
if($_GET["process"]=="forgot-pass")
{
    ?>
    <h3><?=page_login_forgot_pass_title?></h3>
    <input name="mail" type="text" class="form-control" placeholder="<?=page_login_email?>">
    <input type="hidden" name="change" value="forgot">

    <button class="btn btn-primary" type="submit"><i class="far fa-square-check fa-fw"></i> <?=page_login_forgot_btn?> </button>
    <?php
}
