<?php

$ip = "localhost"; //host
$user = "root";  // host username
$password = "";  // password 
$db = "notpaylas"; // db name

try{
    $db = new PDO("mysql:host=$ip;dbname=$db",$user,$password);
    // türkçe karakter için utf8
    $db->exec("SET CHARSET UTF8");
    //eğer hata olursa pdo nun exception komutu ile ekrana yazdırıyoruz
}catch(PDOException $e){
    die ("Hata var");
}

?>