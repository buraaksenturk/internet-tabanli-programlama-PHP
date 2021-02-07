<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" value="" name="yapilacaklar"><input type="submit" value="EKLE">
    </form>
    <?php 
        //Dosyamızı belirliyoruz
        $dosya="yapilacaklar.txt";

        //Formdan gelen değer var mı?
        if (isset($_POST["yapilacaklar"])) {
            //varsa gelen; yazdıralacak değişkeni belirleyin ve gelen değeri ona atayalım
            $icerik=$_POST["yapilacaklar"]."\n";
            //yazma ve okuma işlemi için dosyamızı açalarım burada a+ kullanıldı anlamı dosya hem okuma hem de yazma için açılıyor, ve işaretçi dosyanın sonuna ekleniyor.
            $islem=fopen($dosya,"a+");
            //içerik yazma işlemi için belirlediğimiz değişkeni kullanıp yazılıyor (dosya sonuna)
            fwrite($islem,$icerik);
            //işaretçi dosya sonunda olduğu için a+ o şekilde açılıyor ve ekleniyor işaretçiyi fseek ile 0 konumuna yani en başa alıyoruz
            fseek($islem,0);
            //döngü ile dosya sonuna gelinceye kadar okuyup yazıyoruz
            $dosya_konumu=0;
            while (!feof($islem)) {
                echo "dosya konumu $dosya_konumu".str_replace("\n","<br>",fgets($islem));
                $dosya_konumu++;
            }
            //işlem bitti açtığımız okuma/yazma işlemi kapatalım
            fclose($islem);
        }
    ?>
</body>
</html>