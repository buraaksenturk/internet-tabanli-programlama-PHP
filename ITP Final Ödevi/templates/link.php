<?php
// Navbar kısmında yer alan linkleri burada giriyoruz
    if(isset($_SESSION["kullaniciID"])){
        echo '<div>
        <a href="listele.php"><button class="btn btn-secondary btn-md my-2 my-sm-0">Listeleme</button></a>
        <a href="chatuygulamalari.php"><button class="btn btn-secondary btn-md my-2 my-sm-0">Chat Uygulamaları</button></a>
        <a href="mesajlarilistele.php"><button class="btn btn-secondary btn-md my-2 my-sm-0">Mesajlarım</button></a>
        <a href="layout/_cikis.php"><button class="btn btn-danger btn-md my-2 my-sm-0">Çıkış</button></a>
    </div>';
    }else{
        header('Location: ../index.html');
    }
?>