<?php

require_once "config.php";

try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
    // $conn = new PDO("mysql:host=sql200.epizy.com;dbname=epiz_30982049_malefashion;charset=utf8", epiz_30982049, NTFqewdFcn);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
function zabeleziPristupStranici($page)
{
    $open = fopen(LOG_FAJL, "a");
    if ($open) {
        $date = date('d-m-Y H:i:s');    
        $text = $_SERVER['PHP_SELF']."?page=".$page.SEPARATOR.$date.SEPARATOR.$_SERVER['REMOTE_ADDR']."\n";
        fwrite($open, $text);
        fclose($open);
    }
}
