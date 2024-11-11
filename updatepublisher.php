<?php
   session_start();

   if (!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'publisher';

   include ('connection.php');

   if (isset($_POST['submit']) && $_POST['submit'] == "Update Data") {
      $id = $_POST["id"];
      
      $nama_publisher = $_POST["nama_publisher"];
      $alamat = $_POST["alamat"];
      $tahun_berdiri = $_POST["tahun_berdiri"];
      
      $error_message = '';
      
      $query = "SELECT * FROM publisher WHERE nama_publisher = '$nama_publisher' AND NOT id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if (mysqli_num_rows($result) >= 1) {
         $error_message .= "<li>Publisher sudah ada.</li>";
      }
      
      if ($error_message === "") {
         $query = "UPDATE publisher SET ";
         $query .= "nama_publisher = '$nama_publisher', alamat = '$alamat', tahun_berdiri = '$tahun_berdiri' ";
         $query .= "WHERE id = '$id'";
         
         $result = mysqli_query($connection, $query);
         
         if ($result) {
            $message = "Publisher dengan nama \"<b>$nama_publisher</b>\" sudah berhasil di-update";
            $message = urlencode($message);
            header("Location: publisher.php?message={$message}");
            exit;
         } else {
            die("Update gagal: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
         }
      } else {
         echo $error_message;
      }
   } else if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
      $id = $_POST["id"];
      $query = "SELECT * FROM publisher WHERE id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if ($result) {
         $data = mysqli_fetch_assoc($result);
         $nama_publisher = $data["nama_publisher"];
         $alamat = $data["alamat"];
         $tahun_berdiri = $data["tahun_berdiri"];

         mysqli_free_result($result);
      } else {
         die("Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
      }
   } else {
      header("Location: publisher.php");
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
         <a href="publisher.php">
            <button type="button">
               <i class="fa-solid fa-arrow-left"></i>
               &nbsp; Kembali
            </button>
         </a>
         <h2>Update Publisher</h2>
      </header>
      <div class="tambah-buku-container">
         <form action="" method="post">
            <table>
               <tr>
                  <td colspan="3">
                     <label for="nama_publisher">Nama Publisher</label>
                     <input type="text" name="nama_publisher" id="nama_publisher"
                        value="<?php echo (isset($nama_publisher)) ? $nama_publisher : ""; ?>"
                        placeholder="Nama Publisher" required>
                  </td>
                  <td colspan="1">
                     <label for="alamat">Alamat</label>
                     <input type="text" name="alamat" id="alamat" value="<?php echo (isset($alamat)) ? $alamat : ""; ?>"
                        placeholder="Alamat" required>
                  </td>
                  <td colspan="1">
                     <label for="tahun_berdiri">Tahun Berdiri</label>
                     <input type="number" name="tahun_berdiri" id="tahun_berdiri"
                        value="<?php echo (isset($tahun_berdiri)) ? $tahun_berdiri : ""; ?>" placeholder="Tahun Berdiri"
                        required>
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