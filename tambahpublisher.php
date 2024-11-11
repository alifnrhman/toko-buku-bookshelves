<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'publisher';

   include ('connection.php');

   if (isset($_POST['submit'])) {
      $nama_publisher = $_POST["nama_publisher"];
      $alamat = $_POST["alamat"];
      $tahun_berdiri = $_POST["tahun_berdiri"];

      $error_message = '';

      if ($error_message === "") {
         $query = "INSERT INTO publisher (nama_publisher, alamat, tahun_berdiri) VALUES ";
         $query .= "('$nama_publisher', '$alamat', '$tahun_berdiri')";
         
         $result = mysqli_query($connection, $query); 

         if($result) {
            $message = "Publisher dengan nama \"<b>$nama_publisher</b>\" sudah berhasil ditambahkan.";
            $message = urlencode($message);
            header("Location: publisher.php?message={$message}");
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
         <a href="publisher.php">
            <button type="button">
               <i class="fa-solid fa-arrow-left"></i>
               &nbsp; Kembali
            </button>
         </a>
         <h2>Tambah Publisher</h2>
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
               <input type="reset" value="Reset">
               <input type="submit" value="Submit" name="submit">
            </div>
         </form>
      </div>
   </main>
</body>
</html>