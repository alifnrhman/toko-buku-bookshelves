<?php
   session_start();

   if (!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'dashboard';

   include ('connection.php');

   if (isset($_POST['submit']) && $_POST['submit'] == "Update Data") {
      $id = $_POST["id"];
      
      $judul_buku = $_POST["judul_buku"];
      $isbn = $_POST["isbn"];
      $tahun_terbit = $_POST["tahun_terbit"];
      $harga = $_POST["harga"];
      $stok_buku = $_POST["stok_buku"];
      $publisher = $_POST["publisher"];
      $author = $_POST["author"];
      
      $error_message = '';
      
      $query = "SELECT * FROM buku WHERE isbn = '$isbn' AND NOT id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if (mysqli_num_rows($result) >= 1) {
         $error_message .= "<li>ISBN sudah ada.</li>";
      }
      
      if ($error_message === "") {
         $query = "UPDATE buku SET ";
         $query .= "judul_buku = '$judul_buku', isbn = '$isbn', tahun_terbit = '$tahun_terbit', ";
         $query .= "harga = '$harga', stok_buku='$stok_buku',";
         $query .= "publisher='$publisher', author = '$author' ";
         $query .= "WHERE id = '$id'";
         
         $result = mysqli_query($connection, $query);
         
         if ($result) {
            $message = "Buku dengan judul \"<b>$judul_buku</b>\" dan isbn \"<b>$isbn</b>\" sudah berhasil di-update";
            $message = urlencode($message);
            header("Location: dashboard.php?message={$message}");
            exit;
         } else {
            die("Update gagal: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
         }
      } else {
         echo $error_message;
      }
   } else if (isset($_POST['submit']) && $_POST['submit'] == "Update") {
      $id = $_POST["id"];
      $query = "SELECT * FROM buku WHERE id = '$id'";
      $result = mysqli_query($connection, $query);
      
      if ($result) {
         $data = mysqli_fetch_assoc($result);
         $judul_buku = $data["judul_buku"];
         $isbn = $data["isbn"];
         $tahun_terbit = $data["tahun_terbit"];
         $harga = $data["harga"];
         $stok_buku = $data["stok_buku"];
         $publisher = $data["publisher"];
         $author = $data["author"];
         mysqli_free_result($result);
      } else {
         die("Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
      }
   } else {
      header("Location: dashboard.php");
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
                        $selected_publisher_query = "SELECT publisher FROM buku WHERE id = '$id'";
                        $selected_publisher_result = mysqli_query($connection, $selected_publisher_query);
                        
                        if (!$selected_publisher_result) {
                           die("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                        
                        $selected_publisher_data = mysqli_fetch_assoc($selected_publisher_result);
                        $selected_publisher = $selected_publisher_data ? $selected_publisher_data['publisher'] : '';
                        
                        $query = "SELECT * FROM publisher ORDER BY nama_publisher ASC";
                        $result = mysqli_query($connection, $query);
                        
                        if (!$result) {
                           die("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                        
                     ?>
                     <select name="publisher" required>
                        <option value="" disabled selected>Pilih Publisher</option>
                        <?php
                           while ($data = mysqli_fetch_array($result)) {
                              $selected = ($data['nama_publisher'] === $selected_publisher) ? "selected" : "";
                              echo "<option value='" . $data['nama_publisher'] . "' $selected>" . $data['nama_publisher'] . "</option>";
                           }
                        ?>
                     </select>
                  </td>
                  <td>
                     <label for="author">Author</label>
                     <br>
                     <?php
                        $selected_author_query = "SELECT author FROM buku WHERE id = '$id'";
                        $selected_author_result = mysqli_query($connection, $selected_author_query);
                        
                        if (!$selected_author_result) {
                           die("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                        
                        $selected_author_data = mysqli_fetch_assoc($selected_author_result);
                        $selected_author = $selected_author_data ? $selected_author_data['author'] : '';
                        
                        $query = "SELECT * FROM penulis ORDER BY nama ASC";
                        $result = mysqli_query($connection, $query);
                        
                        if (!$result) {
                           die("Query error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                        }
                        
                     ?>
                     <select name="author" required>
                        <option value="" disabled selected>Pilih Author</option>
                        <?php
                           while ($data = mysqli_fetch_array($result)) {
                              $selected = ($data['nama'] === $selected_author) ? "selected" : "";
                              echo "<option value='" . $data['nama'] . "' $selected>" . $data['nama'] . "</option>";
                           }
                        ?>
                     </select>
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