<?php
   include("connection.php");
   
   if (isset($_POST["submit"])) {
      $id = $_POST["id"];

      $query = "SELECT judul_buku, isbn FROM buku WHERE id='$id' ";
      $result = mysqli_query($connection, $query);
      $data = mysqli_fetch_assoc($result);
      $judul_buku = $data["judul_buku"];
      $isbn = $data["isbn"];
      $query = "DELETE FROM buku WHERE id='$id' ";
      $result = mysqli_query($connection, $query);

      if($result) {
         $message = "Buku dengan judul \"<b>$judul_buku</b>\" dan ISBN \"<b>$isbn</b>\" sudah berhasil dihapus";
         $message = urlencode($message);
         header("Location: dashboard.php?message={$message}");
      } else {
         die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
      }
   }
?>