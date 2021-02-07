<?php
require 'Medoo.php';
 
// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'ogrenci',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Tabloya ait Css kodları*/
        table.blueTable {
        border: 1px solid #1C6EA4;
        background-color: #EEEEEE;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
        }
        table.blueTable td, table.blueTable th {
        border: 1px solid #AAAAAA;
        padding: 3px 2px;
        }
        table.blueTable tbody td {
        font-size: 13px;
        }
        table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
        }
        table.blueTable thead {
        background: #1C6EA4;
        background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
        border-bottom: 2px solid #444444;
        }
        table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #FFFFFF;
        border-left: 2px solid #D0E4F5;
        }
        table.blueTable thead th:first-child {
        border-left: none;
        }

        table.blueTable tfoot td {
        font-size: 14px;
        }
        table.blueTable tfoot .links {
        text-align: right;
        }
        table.blueTable tfoot .links a{
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
        }
    </style>
</head>
<body>
<!-- Form Alanımız -->
<form action="" method="POST">
    Ad Soyad: <input type="text" name="ad_soyad"><br>
    Vize: <input type="text" name="vize"><br>
    Final: <input type="text" name="final"><br>
    <input type="submit" value="Gönder">
    <input type="reset" value="Temizle"><br><br><hr>
</form>
<?php
/* Veri Tabanına Kayıt Ettiğimiz Alan */
$adSoyad="";
$vize="";
$final="";
/* 'if' komutu gelen değer olup olmadığımızı kontrol ediyoruz */
if(isset($_POST["ad_soyad"]) && isset($_POST["vize"]) && isset($_POST["final"])){
    /* Gelen değerler varsa bu değerler yukarıda atadığımız değişkenlere atanıyor */
    $adSoyad=$_POST["ad_soyad"];
    $vize=$_POST["vize"];
    $final=$_POST["final"];
    $database->insert("tbl_123456", ["ad_soyad" => $adSoyad,"vize" => $vize,"final" => $final]);
    $sonKayit=0;
    $sonKayit = $database->id();
    /* 'if & else' ile değerler doğru şekilde atanıp atanamadığı kontrol ediliyor ve 'alert' ile uyarı veriliyor  */
    if($sonKayit>0){
        echo '<script>alert("Kayıt Başarılı");</script>';
    }else{
        echo '<script>alert("Hata!");</script>';
    }
}
?>
<!-- Tablo Başlangıcı -->
<table class="blueTable">
<thead>
<!-- Tablomuzda bulanacak alanların isimleri 'th'lerin içerisine yazılıyor -->
<tr>
<th>Sıra</th>
<th>Ad Soyad</th>
<th>Vize Notu</th>
<th>Final Notu</th>
</tr>
</thead>
<tbody>
<!-- Bu alanda sürekli dönecek olan alanlarımız Php içinde 'foreach' ile döndürülüyor -->
<?php
$kayitlar = $database->select("tbl_123456", "*");
/* 'idSira' ile veri tabanından kayıt silinince oluşacak olan bozuk görüntü engelleniyor  */
$sira=1;
foreach($kayitlar as $kayit){
    echo "<tr>
    <td>$sira</td>
    <td>".$kayit["ad_soyad"]."</td>
    <td>".$kayit["vize"]."</td>
    <td>".$kayit["final"]."</td>
    </tr>";
    /* 'idSira' Bu alanda her seferinde bir arttırılır */
    $sira++;
};
?>
</tbody>
</table>
</body>
</html>