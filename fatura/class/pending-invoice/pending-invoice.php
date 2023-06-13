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
     
        $query =  " SELECT *,SUM(total_price) as toplam FROM invoice_details WHERE created_invoice_id=0";


        return   $db->multi_record_query("$query GROUP BY invoice_date,customer_biling_account_number ORDER BY id DESC");

    }

    function invoice_detail_list($date,$account_number)
    {
        global $db;
        return $db->multi_record_query("SELECT * FROM invoice_details WHERE invoice_date='$date' AND customer_biling_account_number='$account_number' AND created_invoice_id=0");
    }

    function detailsDelete()
    {
        global $db;
        $db->delete('invoice_details',array("id"),array($_GET['id']),"=");
       // echo "<script>setTimeout(function() { document.location = '../../pages/pending-invoice/pending-invoice.php';}, 0)</script>";
    }
    function delete()
    {
        global $db;
        $customer_biling_account_number = $db->get_single('invoice_details','customer_biling_account_number','id',$_GET["id"]);
        $invoice_date= $db->get_single('invoice_details','invoice_date','id',$_GET["id"]);
        $db->delete('invoice_details',array("customer_biling_account_number","invoice_date"),array($customer_biling_account_number,$invoice_date),"=");
        echo "<script>setTimeout(function() { document.location = '../../pages/pending-invoice/pending-invoice.php';}, 0)</script>";
    }

    function create()
    {
        global $db;
        foreach ($_POST["pending_id"] as $id)
        {
            $b_a_n = $db->get_single('invoice_details','customer_biling_account_number','id',$id);
            $i_date= $db->get_single('invoice_details','invoice_date','id',$id);
            $c_id  = $db->get_single('invoice_details','customer_id','id',$id);
            $total_price = $db->multi_record_query("SELECT SUM(total_price) as toplam FROM invoice_details WHERE invoice_date ='$i_date' AND customer_biling_account_number='$b_a_n' ")[0];
            $invoice_id =$db->insert_return_count('created_invoice',array('NULL',"?","?","?","NOW()","?"),
                array(
                    $c_id,
                    $b_a_n,
                    $i_date,
                    $total_price->toplam
                )
            );
            $record = $db->multi_record('invoice_details',array("customer_biling_account_number","invoice_date"),array($b_a_n,$i_date));
            foreach ($record as $r)
            {
                $db->update('invoice_details',array("created_invoice_id"),array($invoice_id,$r->id),"id");
            }
        }
        echo "<script>setTimeout(function() { document.location = '../../pages/created-invoice/created-invoice.php';}, 0)</script>";
    }

}