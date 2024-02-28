<?php
$host = "localhost";
$kullanici = "root";
$parola = "";
$vt = "uyelik";

$baglanti = mysqli_connect($host, $kullanici, $parola, $vt);
mysqli_set_charset($baglanti, "UTF8");

try {
    $db = new PDO("mysql:host=localhost;dbname=uyelik", "root", "");
    // Diğer PDO ayarlarını burada yapabilirsiniz
} catch (PDOException $e) {
    die("Veritabanına bağlantı sağlanamadı: " . $e->getMessage());
}
?>
