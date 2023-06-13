<?php
Class Modul
{
    function resimYukle($resim,$genislik,$yukseklik)
    {
        $image = new Upload($resim);
        if ($image->uploaded)
        {
            $yenisim = rand(0,9999999);
            $image->file_new_name_body = $yenisim;
            $image->image_resize = true;
            $image->image_x = $genislik;
            $image->image_y = $yukseklik;
            $image->allowed = array ("image/*");
            $image->Process(realpath('../')."/images");
            if ($image->processed)
            {
                return "images/".$image->file_dst_name;
            }else
            {
                return false;
            }
        }

    }
    function Update()
    {
        global $db;

        if(!empty($_FILES["logo"]['name']))
        {
            $resim = $this->resimYukle($_FILES['logo'],474,134);
        }else
        {
            $resim = $db->get_single("companies","logo","id",$_SESSION["id"]);
        }

        $db->update("companies",array(
        "name",
        "address",
        "phone",
        "fax",
        "logo",
        "mail",
        "password",
        "authorized_name",
        "web_site",
        "privatverkauf",
        "gewerblicher",
        "export",
        "invoice_define",
        "invoice_start",
        "kontrat_define",
        "kontrat_start"
        ),array(
          $_POST["name"],
          $_POST["address"],
          $_POST["phone"],
          $_POST["fax"],
          $resim,
          $_POST["mail"],
          $_POST["password"],
          $_POST["authorized_name"],
          $_POST["web_site"],
          $_POST["privatverkauf"],
          $_POST["gewerblicher"],
          $_POST["export"],
          $_POST["invoice_define"],
          $_POST["invoice_start"],
          $_POST["kontrat_define"],
          $_POST["kontrat_start"],
          $_SESSION["id"]),"id");

        $db->Successful("Bilgileriniz başarı ile düzenlendi");



    }

    function get_information()
    {
        global $db;
        return $db->multi_record("companies",array("id"),array($_SESSION["id"]))[0];

    }
}