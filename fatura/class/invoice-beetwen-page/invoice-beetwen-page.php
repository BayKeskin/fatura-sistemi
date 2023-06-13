<?php
Class Modul {
    public $table ="customer_account";
    public $primary ="id";
    public $table_fields = array("custumer_id","name","biling_account_id","by_location","payment_day","discount","salesman","commission","mail","set_invoice");
    public $table_fields_extra = array('database_information');
    public $table_fields_extra_val = array();
    public $list_url =array();


    function __construct()
    {
        global $db;
        global $siteURL;
        $server_url = explode('/',$_SERVER["SCRIPT_NAME"]);
        $this->list_url[0]=str_replace('add.php','list.php',end($server_url));
        $this->list_url[1]=str_replace('-add.php','',end($server_url));
        $this->list_url[2]=str_replace('list.php','add.php',end($server_url));
    }
    function all()
    {
        global $db;
        return $db->multi_record($this->table);
    }

    function insert()
    {
        global $db;
        $table_cell_count = count($this->table_fields)+count ($this->table_fields_extra);
        $table_cell = array("NULL");
        for ($i =0; $i<$table_cell_count; $i++)
        {
            $table_cell[]="?";
        }
        $field_val = array();
        foreach ($this->table_fields as $a)
        {
            $field_val[]=$_POST[$a];
        }
        $field_val[]=json_encode(
            array(
                'database_host'=>$_POST["database_host"],
                'database_name'=>$_POST["database_name"],
                'database_user'=>$_POST["database_user"],
                'database_pass'=>$_POST["database_pass"]
            )
        );
        $id =$db->insert_return_count($this->table,$table_cell,$field_val);
        if($id>0)
        {
            $db->insert(' customer_packets',array("NULL","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?","?"),
                array($id, $_POST["process"], $_POST["process_price"], $_POST["package"], $_POST["package_price"], $_POST["fixed_price"]	, $_POST["fixed_price_price"], $_POST["fixed_price_desc"], $_POST["taking_picture"], $_POST["taking_picture_price"], $_POST["image_cleaning"], $_POST["image_cleaning_price"], $_POST["outdoor_shooting_360"], $_POST["outdoor_shooting_360_pice"], $_POST["outdoor_shooting_360_clear"], $_POST["outdoor_shooting_360_clear_price"], $_POST["inner_shooting_360"], $_POST["inner_shooting_360_price"], $_POST["inner_shooting_360_clear"], $_POST["inner_shooting_360_clear_price"]));


            $db->Success('Kayıt Eklendi');
        }else
        {
            $db->Error('Kayıt Eklenirken Bir Sorun Oluştu');
        }
    }

    function update()
    {
        global $db;
        if($db->update_not_params
            (
                $this->table,
                $this->table_fields,
                $this->primary,
                $_GET["id"],
                $this->table_fields_extra,
                $this->table_fields_extra_val
            )>0
        )
        {
            $db->Success('Kayıt Başarı İle Düzenlendi');
        }else
        {
            $db->Error('Kayıt Düzenlenirken Bir Sorun Oluştu');
        }
    }

    function delete()
    {
        global $db;
        $db->delete($this->table,array($this->primary),array($_GET['id']),'=');
        ?>
        <script>
            setTimeout(function() {
                location.href='<?=$_SERVER["SCRIPT_NAME"]?>';
            }, 0)
        </script>
        <?php
    }

    function biling_account_list()
    {
        global $db;
        return $db->multi_record('billing_account');
    }
}