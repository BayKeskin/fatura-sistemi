<?php

    
    ini_set("display_errors",1);
    // If you need to parse XLS files, include php-excel-reader

    require('php-excel-reader/excel_reader2.php');

    require('SpreadsheetReader.php');

    $Reader = new SpreadsheetReader("example.xlsx");
    foreach ($Reader as $Row)
    {
        echo $Row[0]."-".$Row[1]."<br><br>";
    }
?>