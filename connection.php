<?php
   $db_host = "localhost";
   $db_user = "root";
   $db_password = "";
   $db_name = "toko_buku";

   $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

   if (!$connection) {
      echo "Gagal koneksi database";
   }
?>