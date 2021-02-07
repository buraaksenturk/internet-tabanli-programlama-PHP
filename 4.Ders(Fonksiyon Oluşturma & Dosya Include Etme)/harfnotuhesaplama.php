<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="not">
        <input type="submit" value="Bul">
    </form>
<?php
//harf notu hesapla isimli bir fonksiyon tanımlayın.
//bu fonksiyona girilen değer 0-50 arasında ise D, 51-65 arasında ise C, 66-85 arasında ise B, 86-100 arasında ise A çıktısını versin.
if (isset($_POST["not"])) {
    harfNotuHesapla($_POST["not"]);
}
    function harfNotuHesapla($sayisalNot){
        if($sayisalNot>=0 && $sayisalNot<=50){
            echo "Harf notunuz D";
        }else if($sayisalNot>=51 && $sayisalNot<=65){
            echo "Harf notunuz C";
        }else if($sayisalNot>=66 && $sayisalNot<=85){
            echo "Harf notunuz B";
        }elseif ($sayisalNot>=86 && $sayisalNot<=100) {
            echo "Harf notunuz A";
        }else{
            echo "Lütfen 0-100 arasında bir sayısal not giriniz";
        }
    }
?>
</body>
</html>