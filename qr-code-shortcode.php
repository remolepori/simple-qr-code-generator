<?php
/**
 * Plugin Name: QR Code Shortcode
 * Description: Erstellt einen interaktiven QR-Code-Generator per Shortcode [qr-code].
 * Version: 1.0
 * Author: Remo Lepori
 */

if (!defined('ABSPATH')) exit;

function qr_code_shortcode() {
    ob_start(); ?>
    <div id="qrCode"></div>
    <input type="text" id="qrInput" placeholder="Webseite oder Text eingeben..." oninput="generateQRCode()">
<style>
 body {
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    input {
      width: 80%;
      max-width: 750px;
      padding: 10px;
      margin-top: 20px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    #qrCode {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    #qrCode > img {
      max-width: 100%;
      max-height: 100%;
      height: auto;
    }
  </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
      const qrCodeContainer = document.getElementById('qrCode');
      const input = document.getElementById('qrInput');
      let qrCode;

      function resizeQRCode() {
        const size = Math.min(window.innerWidth, window.innerHeight) * 0.8;
        qrCodeContainer.innerHTML = "";
        qrCode = new QRCode(qrCodeContainer, {
          text: input.value.trim(),
          width: size,
          height: size
        });
      }

      function generateQRCode() {
        resizeQRCode();
      }

      window.addEventListener("load", resizeQRCode);
      window.addEventListener("resize", resizeQRCode);
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('qr-code', 'qr_code_shortcode');
