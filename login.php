<?php
   include ('connection.php');
   session_start();

   $username = $_POST['username'];
   $password = $_POST['password'];

   if ($username != '' && $password != '') {
      $sql = "SELECT * FROM users WHERE username = '$username'";

      $query = mysqli_query($connection, $sql);
      $data = mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1) {
         setcookie("message", "Username yang anda masukkan salah.");
         header('location: index.php');
      } else {
         $sql = "SELECT * FROM users WHERE password = '$password'";

         $query = mysqli_query($connection, $sql);
         $data = mysqli_fetch_assoc($query);

         if (mysqli_num_rows($query) < 1) {
            setcookie("message", "Password yang anda masukkan salah.");
            header('location: index.php');
         } else {
            echo $data['username'] . $data['password'];

            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];

            setcookie('message', '', time() - 60);
            header('location: dashboard.php');
         }
      }
   }

?>