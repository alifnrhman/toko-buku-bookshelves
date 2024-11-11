<?php
   include("connection.php");
   
   if (isset($_POST["submit"])) {
      $id = $_POST["id"];

      $query = "SELECT nama_publisher FROM publisher WHERE id = '$id' ";
      $result = mysqli_query($connection, $query);
      $data = mysqli_fetch_assoc($result);

      $nama_publisher = $data["nama_publisher"];
      
      $query = "DELETE FROM publisher WHERE id='$id' ";
      $result = mysqli_query($connection, $query);

      if ($result) {
         $message = "Publisher dengan nama \"<b>$nama_publisher</b>\" sudah berhasil dihapus";
         $message = urlencode($message);
         header("Location: publisher.php?message={$message}");
      } else {
         die ("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
      }
   }
?>