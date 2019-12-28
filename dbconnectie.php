<?php
// note: while pass is usbw on my local machine, usbwebserver as an application supports php 5 while the hashing function used here is of a later version
   $db = new PDO('mysql:host=localhost:3306;dbname=fietsen', 'root', 'usbw');
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>