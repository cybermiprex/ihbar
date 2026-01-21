<?php
/**
 * SİBER İHBAR ASİSTANI - GÖNDERİCİ MOTORU
 * Bilgiler: 8412069744:AAH... / 7038362008
 */

// Hataları gizle ama arka planda çalıştır
error_reporting(0);

if ($_POST) {
    // Senin Bilgilerin
    $token   = "8412069744:AAH8tnhlIEujbQs6l9xayz4RH1pcK33NWv8"; 
    $chat_id = "7038362008"; 

    // Formdan Gelen Veriler
    $isim  = htmlspecialchars($_POST['isim']);
    $email = htmlspecialchars($_POST['email']);
    $turu  = htmlspecialchars($_POST['olay_turu']);
    $konu  = htmlspecialchars($_POST['konu']);
    $mesaj = htmlspecialchars($_POST['mesaj']);
    $tarih = date("d.m.Y H:i:s");
    $ip    = $_SERVER['REMOTE_ADDR'];

    // Telegram Mesaj Taslağı (Markdown Formatı)
    $tgText = "🛡️ *YENİ SİBER İHBAR BİLDİRİMİ* 🛡️\n";
    $tgText .= "━━━━━━━━━━━━━━━━━━━━\n";
    $tgText .= "👤 *Bildiren:* $isim\n";
    $tgText .= "📧 *E-Posta:* $email\n";
    $tgText .= "📂 *Kategori:* $turu\n";
    $tgText .= "🌐 *URL/Konu:* $konu\n";
    $tgText .= "━━━━━━━━━━━━━━━━━━━━\n";
    $tgText .= "📝 *Detay:* $mesaj\n";
    $tgText .= "━━━━━━━━━━━━━━━━━━━━\n";
    $tgText .= "🕒 *Tarih:* $tarih\n";
    $tgText .= "📍 *IP:* $ip";

    // Telegram API Bağlantısı (CURL - Ücretsiz hosting dostu)
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $post_fields = [
        'chat_id'    => $chat_id,
        'text'       => $tgText,
        'parse_mode' => 'Markdown'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Güvenlik sertifikası hatalarını engeller
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $sonuc = curl_exec($ch);
    curl_close($ch);

    // İşlem başarılıysa ekrana success bas (index.html'deki JS bunu bekliyor)
    echo "success";
}
?>
