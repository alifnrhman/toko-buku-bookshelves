<?php
   session_start();

   if (!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'penulis';

   include ('connection.php');

   if (isset($_POST['submit']) && $_POST['submit'] == "Update Data") {
      $id = $_POST["id"];
      
      $nama = $_POST["nama"];
      $usia = $_POST["usia"];
      $phone = $_POST["phone"];
      $email = $_POST["email"];
      
      $error_message = '';
      
      $query = "SELECT * FROM penulis WHERE nama = '$nama' AND NOT id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if (mysqli_num_rows($result) >= 1) {
         $error_message .= "<li>Penulis sudah ada.</li>";
      }
      
      if ($error_message === "") {
         $query = "UPDATE penulis SET ";
         $query .= "nama = '$nama', usia = '$usia', phone = '$phone', email = '$email' ";
         $query .= "WHERE id = '$id'";
         
         $result = mysqli_query($connection, $query);
         
         if ($result) {
            $message = "Penulis dengan nama \"<b>$nama</b>\" sudah berhasil di-update";
            $message = urlencode($message);
            header("Location: penulis.php?message={$message}");
            exit;
         } else {
            die("Update gagal: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
         }
      } else {
         echo $error_message;
      }
   } else if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
      $id = $_POST["id"];
      $query = "SELECT * FROM penulis WHERE id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if ($result) {
         $data = mysqli_fetch_assoc($result);
         $nama = $data["nama"];
         $usia = $data["usia"];
         $phone = $data["phone"];
         $email = $data["email"];

         mysqli_free_result($result);
      } else {
         die("Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
      }
   } else {
      header("Location: penulis.php");
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
      <?php
         if (isset($_GET["message"])) {
            echo "<div>" . $_GET["message"] . "</div>";
         }
      ?>
      <header class="tambah-page">
         <a href="penulis.php">
            <button type="button">
               <i class="fa-solid fa-arrow-left"></i>
               &nbsp; Kembali
            </button>
         </a>
         <h2>Update Penulis</h2>
      </header>
      <div class="tambah-buku-container">
         <form action="" method="post">
            <table>
               <tr>
                  <td colspan="2">
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
                     <input type="number" name="phone" id="phone" value="<?php echo (isset($phone)) ? $phone : ""; ?>"
                        placeholder="Nomor Telepon" required>
                  </td>
                  <td colspan="1">
                     <label for="email">Email</label>
                     <input type="email" name="email" id="email" value="<?php echo (isset($email)) ? $email : ""; ?>"
                        placeholder="Email" required>
                  </td>
               </tr>
            </table>
            <div class="buttons">
               <input type="hidden" name="id" value="<?= (isset($id)) ? $id : ""; ?>">
               <input type="reset" value="Reset">
               <input type="submit" value="Update Data" name="submit">
            </div>
         </form>
      </div>
   </main>
</body>
</html>