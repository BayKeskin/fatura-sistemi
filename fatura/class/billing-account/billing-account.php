<?php
Class Modul {
    public $table ="billing_account";
    public $primary ="id";
    public $table_fields = array("biling_account_number", "name", "street", "post_code", "city", "country", "payment_day","discount","salesman","commission","mail","tax_number", "tax_exemption", "text_footer","tax_rate");
    public $table_fields_extra = array();
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
        if($db->insert($this->table,$table_cell,$field_val)>0)
        {

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
}