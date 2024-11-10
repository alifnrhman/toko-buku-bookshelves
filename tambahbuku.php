<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'dashboard';

   include ('connection.php');

   if (isset($_POST['submit'])) {
      $judul_buku = $_POST["judul_buku"];
      $isbn = $_POST["isbn"];
      $tahun_terbit = $_POST["tahun_terbit"];
      $harga = $_POST["harga"];
      $stok_buku = $_POST["stok_buku"];
      $publisher = $_POST["publisher"];
      $author = $_POST["author"];

      $error_message = '';

      if ($error_message === "") {
         $query = "INSERT INTO buku (judul_buku, isbn, tahun_terbit, harga, stok_buku, publisher, author) VALUES ";
         $query .= "('$judul_buku', '$isbn', '$tahun_terbit', '$harga', ";
         $query .= "'$stok_buku', '$publisher', '$author')";
         
         $result = mysqli_query($connection, $query); 

         if($result) {
            $message = "Buku dengan judul \"<b>$judul_buku</b>\" dan ISBN \"<b>$isbn</b>\" sudah berhasil ditambahkan.";
            $message = urlencode($message);
            header("Location: dashboard.php?message={$message}");
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
         <a href="dashboard.php">
            <button type="button">
               <i class="fa-solid fa-arrow-left"></i>
               &nbsp; Kembali
            </button>
         </a>
         <h2>Tambah Buku</h2>
      </header>
      <div class="tambah-buku-container">
         <form action="" method="post">
            <table>
               <tr>
                  <td colspan="3">
                     <label for="judul_buku">Judul Buku</label>
                     <input type="text" name="judul_buku" id="judul_buku"
                        value="<?php echo (isset($judul_buku)) ? $judul_buku : ""; ?>" placeholder="Judul Buku"
                        required>
                  </td>
                  <td colspan="2">
                     <label for="isbn">ISBN</label>
                     <input type="text" name="isbn" id="isbn" value="<?php echo (isset($isbn)) ? $isbn : ""; ?>"
                        placeholder="Contoh: 978-979-7801-09-3" required>
                  </td>
               </tr>
               <tr>
                  <td>
                     <label for="tahun_terbit">Tahun Terbit</label>
                     <input type="number" name="tahun_terbit" id="tahun_terbit"
                        value="<?php echo (isset($tahun_terbit)) ? $tahun_terbit : ""; ?>" placeholder="Tahun Terbit"
                        required>
                  </td>
                  <td>
                     <label for="harga">Harga</label>
                     <input type="number" name="harga" id="harga" value="<?php echo (isset($harga)) ? $harga : ""; ?>"
                        placeholder="Contoh: 75000" required>
                  </td>
                  <td>
                     <label for="stok_buku">Stok Buku</label>
                     <input type="number" name="stok_buku" id="stok_buku"
                        value="<?php echo (isset($stok_buku)) ? $stok_buku : ""; ?>" placeholder="Stok Buku" required>
                  </td>
                  <td>
                     <label for="publisher">Publisher</label>
                     <br>
                     <?php                     
                        $query = "SELECT * FROM publisher ORDER BY nama_publisher ASC";
                        $result = mysqli_query($connection, $query);
      
                        if (!$result) {
                           die ("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                     ?>
                     <select name="publisher" required>
                        <option value="" disabled selected>Pilih Publisher</option>
                        <?php
                           while ($data = mysqli_fetch_array($result)) {
                              echo "<option value='" . $data['nama_publisher'] . "'>" . $data['nama_publisher'] . "</option>";
                           }
                        ?>
                     </select>
                  </td>
                  <td>
                     <label for="author">Author</label>
                     <br>
                     <?php
                        $query = "SELECT * FROM penulis ORDER BY nama ASC";
                        $result = mysqli_query($connection, $query);
      
                        if (!$result) {
                           die ("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                     ?>
                     <select name="author" required>
                        <option value="" disabled selected>Pilih Author</option>
                        <?php
                           while ($data = mysqli_fetch_array($result)) {
                              echo "<option value='" . $data['nama'] . "'>" . $data['nama'] . "</option>";
                           }
                        ?>
                     </select>
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