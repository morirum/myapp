<?php
$host="db";
$kullanici="db_mori";
$parola="1234a";
$veri_tabani="db_moria";

$conn =mysqli_connect($host, $kullanici, $parola, $veri_tabani);
mysqli_set_charset($conn, "UTF8");

?>