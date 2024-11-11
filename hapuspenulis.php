<?php
   include("connection.php");
   
   if (isset($_POST["submit"])) {
      $id = $_POST["id"];

      $query = "SELECT nama FROM penulis WHERE id = '$id' ";
      $result = mysqli_query($connection, $query);
      $data = mysqli_fetch_assoc($result);

      $nama = $data["nama"];
      
      $query = "DELETE FROM penulis WHERE id='$id' ";
      $result = mysqli_query($connection, $query);

      if ($result) {
         $message = "Penulis dengan nama \"<b>$nama</b>\" sudah berhasil dihapus";
         $message = urlencode($message);
         header("Location: penulis.php?message={$message}");
      } else {
         die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
      }
   }
?>