<?php
class Database
{
    public $database="fatura";
    public $host      ="localhost";
    public $user     ="root";
    public $pass     ="";
    public $connect;
    public $connect2;
    public $get_information   =array();
    function __construct()
    {
        try
        {

            $this->connect=new PDO("mysql:host=$this->host;dbname=$this->database",$this->user,$this->pass);
            $this->connect->exec("SET NAMES UTF8 COLLATE utf8_turkish_ci");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." Hata alınan server".$this->host;;
        }


    }
    function connect_server($host,$db,$user,$pass)
    {
        try
        {

            $this->connect2=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            $this->connect2->exec("SET NAMES UTF8 COLLATE utf8_turkish_ci");
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." Hata alınan server".$host;
        }
    }
    function get_single($table,$area,$condition,$conditions,$connect='')
    {
        $return   =null;
        $query="SELECT $area FROM $table WHERE $condition=?";
        if($connect=='')
        {
            $data  =$this->connect->prepare($query);
        }else
        {
            $data  =$this->connect2->prepare($query);
        }

        $data->execute(array($conditions));
        $return=$data->fetch(PDO::FETCH_OBJ);
        return $return->{$area};
    }
    function get_single_multi($table,$area,$condition=array(),$conditions=array(),$parameters,$sign,$order=null,$order_tyoe=null,$limit=null,$connect='')
    {
        $return       =null;
        $query="";
        foreach($condition as $s)
        {
            $query.=" $s".$sign."? $parameters";
        }
        $query=substr($query,0,strlen($query)-strlen($parameters));
        if($order!=null)
        {
            if($limit!=null)
            {
                $order_query=" ORDER BY $order $order_tyoe LIMIT $limit";
            }
            else
            {
                $order_query=" ORDER BY $order $order_tyoe";
            }
        }
        else
        {
            $order_query="";
        }
        $new_query="SELECT $area FROM $table WHERE $query $order_query";
        if($connect=='')
        {
            $data  =$this->connect->prepare($new_query);
        }else
        {
            $data  =$this->connect2->prepare($new_query);
        }

        $data->execute($conditions);
        $return=$data->fetch(PDO::FETCH_OBJ);
        return $return->{$area};
    }
    function update_not_params($table,$condition=array(),$where,$id,$exceptional=array(),$exceptionals=array(),$connect='')
    {
        $number     =0;
        $combine="";
        $conditions='';
        foreach($condition as $c)
        {
            $conditions.=$c."=?,";
        }
        if(count($exceptional)>0)
        {
            foreach($exceptional as $i)
            {
                $conditions.=$i."=?,";
            }
        }

        $cut         =trim(substr($conditions,0,-1));
        if($connect=='')
        {
            $update      =$this->connect->prepare("UPDATE $table SET $cut WHERE $where=$id");
        }else
        {
            $update      =$this->connect2->prepare("UPDATE $table SET $cut WHERE $where=$id");
        }




        $condition_val=array();

        foreach($condition as $row)
        {
            $condition_val[]=$_POST[$row];
        }
        if(count($exceptionals)>0)
        {
            foreach($exceptionals as $is)
            {
                $condition_val[]=$is;
            }
        }
        $update->execute($condition_val);
        if($update)
        {
            $number=1;
        }
        else
        {
            $number=0;
        }
        return $number;
    }
    function update($table,$condition=array(),$conditions=array(),$where,$connect='')
    {
        $number     =0;
        $combine="";
        foreach($condition as $c)
        {
            $combine.=$c."=?,";
        }
        $cut   =trim(substr($combine,0,-1));
        if($connect=='')
        {
            $update=$this->connect->prepare("UPDATE $table SET $cut WHERE $where=?");
        }else
        {
            $update=$this->connect2->prepare("UPDATE $table SET $cut WHERE $where=?");
        }


        $update->execute($conditions);
        if($update)
        {
            $number=1;
        }
        else
        {
            $number=0;
        }
        return $number;
    }
    function delete($table,$condition=array(),$conditions=array(),$parameters,$connect='')
    {
        $number     =0;
        $combine="";
        foreach($condition as $c)
        {
            if($parameters=="")
            {
                $combine.=$c."=? AND ";
            }
            else
            {
                $combine.=$c."$parameters? AND ";
            }
        }
        $cut  =trim(substr($combine,0,-4));
        if($connect=='')
        {
            $delete=$this->connect->prepare("DELETE FROM $table WHERE $cut");
        }else
        {
            $delete=$this->connect2->prepare("DELETE FROM $table WHERE $cut");
        }


        $delete->execute($conditions);
        if($delete)
        {
            $number=1;
        }
        else
        {
            $number=0;
        }
    }
    function insert_return_count($table,$condition=array(),$conditions=array(),$connect='')
    {
        $number     =0;
        $combine="";
        foreach($condition as $c)
        {
            $combine.=$c.",";
        }
        $cut   =trim(substr($combine,0,-1));
        if($connect=='')
        {
            $insert=$this->connect->prepare("INSERT INTO $table VALUES ($cut)");
        }else
        {
            $insert=$this->connect2->prepare("INSERT INTO $table VALUES ($cut)");
        }



        $insert->execute($conditions);
        $number=$this->connect->lastInsertId();
        return $number;
    }
    function insert($table,$condition=array(),$conditions=array(),$connect='')
    {
        $number =0;
        $combine="";
        foreach($condition as $s)
        {
            $combine.=$s.",";
        }
        $cut=trim(substr($combine,0,-1));
        if($connect=='')
        {
            $insert=$this->connect->prepare("INSERT INTO $table VALUES ($cut)");
        }else
        {
            $insert=$this->connect2->prepare("INSERT INTO $table VALUES ($cut)");
        }



        $insert->execute($conditions);
        if($insert)
        {
            $number=1;
        }
        else
        {
            $number=0;
        }
        return $number;
    }
    function multi_record_query($query,$return_type="",$connect='')
    {
        $this->get_information=null;
        $return = "";
        if($connect=='')
        {
            $area=$this->connect->prepare("$query");
        }else
        {
            $area=$this->connect2->prepare("$query");
        }


        $area->execute();

        if($return_type=="")
        {
            if($area->rowCount()<1)
            {
                $return =false;
            }else
            {
                $return = $area->fetchAll(PDO::FETCH_OBJ);
            }
            return $return;
        }else
        {
            if($area->rowCount()<1)
            {
                $return =false;
            }else
            {
                $return =array($area->fetchAll(PDO::FETCH_OBJ),$area->rowCount());
            }
            return $return;
        }

    }
    function multi_record($table,$condition=array(),$conditions=array(),$operators="",$order="",$order_tyoe="",$limit="",$areas ="",$connect='')
    {
        $this->get_information=null;
        $return = "";
        if($areas!='')
        {
            $get = $areas;
        }else
        {
            $get="*";
        }
        $query ="SELECT $get FROM $table";
        if( count($condition)>0)
        {
            $query.=" WHERE ";
            if($operators!="")
            {
                $op =$operators;
            }else
            {
                $op ="=";
            }
            $param="$op? AND ";
            $combine=implode($param,$condition);
            $combine.=$op."?";
            $query.=$combine;
        }

        if($order!="")
        {
            $query.=" ORDER BY $order $order_tyoe";
        }

        if($limit!="")
        {
            $query.=" LIMIT $limit";
        }

        if(count($conditions)>0)
        {
            if($connect=='')
            {
                $get_area=$this->connect->prepare("$query");

            }else
            {
                $get_area=$this->connect2->prepare("$query");
            }



            $get_area->execute($conditions);
            if($get_area->rowCount()<1)
            {
                $return =false;
            }else
            {
                $return = $get_area->fetchAll(PDO::FETCH_OBJ);
            }
        }else
        {
            if($connect=='')
            {
                $get_area=$this->connect->prepare("$query");

            }else
            {
                $get_area=$this->connect2->prepare("$query");
            }



            $get_area->execute($conditions);
            if($get_area->rowCount()<1)
            {
                $return =false;
            }else
            {
                $return = $get_area->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $return;
    }
    function count_record($table,$condition=array(),$conditions=array(),$operators="",$order="",$order_tyoe="",$limit="",$connect='')
    {

        $this->get_information=null;
        $query ="SELECT * FROM $table";
        if( count($condition)>0)
        {
            $query.=" WHERE ";
            if($operators!="")
            {
                $op =$operators;
            }else
            {
                $op ="=";
            }
            $param="$op? AND ";
            $combine=implode($param,$condition);
            $combine.=$op."?";
            $query.=$combine;
        }

        if($order!="")
        {
            $query.=" ORDER BY $order $order_tyoe";
        }

        if($limit!="")
        {
            $query.=" LIMIT $limit";
        }



        if(count($conditions)>0)
        {
            if($connect=='')
            {
                $get_area=$this->connect->prepare("$query");

            }else
            {
                $get_area=$this->connect2->prepare("$query");
            }




            $get_area->execute($conditions);
            $number=$get_area->rowCount();
        }else
        {
            if($connect=='')
            {
                $get_area=$this->connect->prepare("$query");

            }else
            {
                $get_area=$this->connect2->prepare("$query");
            }



            $get_area->execute($conditions);
            $number=$get_area->rowCount();
        }

        return $number;
    }
    function count_record_query($query,$condition=array(),$connect='')
    {
        $number=0;

        $query=$this->connect->prepare("$query");
        $query->execute($condition);
        $number=$query->rowCount();
        return $number;
    }
    function Success($mesaj)
    {
        ?>
        <div class="clearfix"></div>
        <div class="alert alert-success" role="alert">
            <?=$mesaj?>
        </div>
        <div class="clearfix"></div>
        <?php
    }
    function Error($mesaj)
    {
        ?>

        <div class="clearfix"></div>
        <div class="alert alert-danger" role="alert">
            <?=$mesaj?>
        </div>
        <div class="clearfix"></div>
        <?php
    }
    function set_url($text)
    {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
        $text = strtolower(str_replace($find, $replace, $text));
        $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text));
        $text = str_replace(' ', '-', $text);
        return $text;
    }
    function get_date($date)
    {
        $explode   =explode("-",$date);
        $new_date=$explode[2]."-".$explode[1]."-".$explode[0];
        return $new_date;
    }
    function get_date_time($date)
    {
        $space  =explode(" ",$date);
        $explode =explode("-",$space[0]);
        $explode=explode(":",$space[1]);
        $new_date=$explode[2]."/".$explode[1]."/".$explode[0]." ".$explode[0].":".$explode[1];
        return $new_date;
    }
    function get_url()
    {
        $url     ="$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $explode  =explode("/",$url);
        $explode_=str_replace("-","",$explode[1]);
        return $explode_;
    }
    function full_url()
    {
        $links="$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $links;
    }

    function __destruct()
    {
        $this->connect=null;
    }
}

?>