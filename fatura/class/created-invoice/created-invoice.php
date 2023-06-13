<?php
Class Modul
{
    public $show_page =0;
    public $total_record =0;
    public $total_page =0;
    public $order =0;
    function All()
    {

        global $db;
        return   $db->multi_record_query("SELECT * FROM created_invoice  ORDER BY id DESC");

    }

    function invoice_detail_list($created_invoice_id)
    {
        global $db;
        return $db->multi_record_query("SELECT * FROM invoice_details WHERE created_invoice_id=$created_invoice_id  ORDER BY id DESC");
    }
}