<?php
   $db = new PDO('mysql:host=localhost:3307;dbname=fietsen', 'root', 'usbw');
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>