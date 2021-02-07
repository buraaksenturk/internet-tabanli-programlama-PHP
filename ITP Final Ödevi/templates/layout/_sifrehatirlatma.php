<link rel="icon" type="image/jpeg" href="../../static/img/kodomega.jpeg">
<!-- Bootstrap Css-->
<link rel="stylesheet" href="../../static/css/bootstrap.min.css">
<!-- Bootstrap Css -->
<link rel="stylesheet" href="../../static/css/sifrehatirlatma.css">
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="" method="POST">
            <h1>ŞİFREMİ UNUTTUM!<span style='font-size:50px;'>&#128549;</span></h1>
            <input type="email" class="form-control" name="email" placeholder="E-Mail Adresinizi Giriniz."><br>
            <button>Şifremi Hatırlat</button>
            <a href="../../index.html" style="text-decoration: none;">Giriş</a>
        </form>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="../../static/js/bootstrap.bundle.min.js"></script>
<script src="../../static/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<?php
require '_base.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//KOD ÜRETME
$kodOlusturma1 = date('d.m.Y H:i:s');
$kodOlusturma2 = rand(0,20000);
$aktivasyonDogrKod = hash('sha256', $kodOlusturma2.$kodOlusturma1);

$email = "";
if(isset($_POST["email"])){
    $email=$_POST["email"];
    // gerekli verileri çağırıyoruz
    $name = $database->get("385215_tbl_users","ad",["email" => $email]);
    $surname = $database->get("385215_tbl_users","soyad",["email" => $email]);
    $sifre = $database->get("385215_tbl_users","sifre",["email" => $email]);
    #try-catch
    try {
        //Server ayarlarını yapıyoruz
        $mail->SMTPDebug = 0;                                       // Hata ayıklama çıktısını etkinleştirme SMTP::DEBUG_SERVER; etkinleştirir 0 boş döndürür
        $mail->isSMTP();                                            // SMTP kullanarak gönderme
        $mail->Host       = 'smtp.gmail.com';                       // SMTP sunucusunu gönderecek şekilde ayarlama
        $mail->SMTPAuth   = true;                                   // SMTP kimlik doğrulamasını etkinleştirme
        $mail->Username   = 'phpmaildeneme1@gmail.com';             // SMTP kullanıcı adı
        $mail->Password   = 'php?deneme1';                          // SMTP şifresi
        $mail->CharSet = 'utf-8';                                   // SMTP karakter düzenleme
        $mail->SMTPSecure = 'tls';                                  // TLS şifrelemesini etkinleştirme; `PHPMailer :: ENCRYPTION_SMTPS` önerilir
        $mail->Port       = 587;                                    // Bağlanılacak TCP bağlantı noktası, yukarıdaki `PHPMailer :: ENCRYPTION_SMTPS` için 465 kullanın Gmail için 587
    
        // Alıcı
        $mail->setFrom('phpmaildeneme1@gmail.com', 'Kod Omega Chat Ailesi');
        $mail->addAddress($email, $name.' '.$surname);              // Alıcı ekleme
    
        // İçerik
        $mail->isHTML(true);                                        // E-posta biçimini HTML olarak ayarlama
        $mail->Subject = 'Şifre Hatırlatma';
        $mail->Body    ='<h3>Unutulan şifreniz :'.$sifre.'</h3>';
    
        if ($mail->send()) {
            echo '<script>alert("Şifreniz mail adresinize gönderildi.")</script>';
            
        }else {
            echo '<script>alert("Şifreniz mail adresinize gönderilemedi.")</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("Şifreniz mail adresinize gönderilemedi. Sebebi -> '.$mail->ErrorInfo.' ")</script>';
    }
    //e posta gönderme sonu   
}
?>
