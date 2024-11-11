<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'penulis';

   include ('connection.php');

   if (isset($_POST['submit'])) {
      $nama = $_POST["nama"];
      $usia = $_POST["usia"];
      $phone = $_POST["phone"];
      $email = $_POST["email"];

      $error_message = '';

      if ($error_message === "") {
         $query = "INSERT INTO penulis (nama, usia, phone, email) VALUES ";
         $query .= "('$nama', '$usia', '$phone', '$email')";
         
         $result = mysqli_query($connection, $query); 

         if($result) {
            $message = "Penulis dengan nama \"<b>$nama</b>\" sudah berhasil ditambahkan.";
            $message = urlencode($message);
            header("Location: penulis.php?message={$message}");
         } else {
            die ("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
         }
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="css\style.css">
   <script src="https://kit.fontawesome.com/6188934eaf.js" crossorigin="anonymous"></script>
</head>
<body>
   <?php
      include('sidebar.php');
   ?>
   <main id="dashboard-main">
      <header class="tambah-page">
         <a href="penulis.php">
            <button type="button">
               <i class="fa-solid fa-arrow-left"></i>
               &nbsp; Kembali
            </button>
         </a>
         <h2>Tambah Penulis</h2>
      </header>
      <div class="tambah-buku-container">
         <form action="" method="post">
            <table>
               <tr>
                  <td colspan="3">
                     <label for="nama">Nama Penulis</label>
                     <input type="text" name="nama" id="nama" value="<?php echo (isset($nama)) ? $nama : ""; ?>"
                        placeholder="Nama Penulis" required>
                  </td>
                  <td colspan="1">
                     <label for="usia">Usia</label>
                     <input type="number" name="usia" id="usia" value="<?php echo (isset($usia)) ? $usia : ""; ?>"
                        placeholder="Usia" required>
                  </td>
                  <td colspan="1">
                     <label for="phone">Nomor Telepon</label>
                     <input type="text" name="phone" id="phone" value="<?php echo (isset($phone)) ? $phone : ""; ?>"
                        placeholder="Contoh: 0812-3456-7890" required>
                  </td>
                  <td colspan="1">
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email" value="<?php echo (isset($email)) ? $email : ""; ?>"
                        placeholder="Email" required>
                  </td>
               </tr>
            </table>
            <div class="buttons">
               <input type="reset" value="Reset">
               <input type="submit" value="Submit" name="submit">
            </div>
         </form>
      </div>
   </main>
</body>
</html>