<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'publisher';
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
      <header>
         <h2>Daftar Publisher</h2>
         <button type="submit">
            <i class="fa-solid fa-plus"></i>
            Tambah Publisher
         </button>
      </header>
      <div class="daftar-buku">
         <table>
            <thead>
               <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nama Publisher</th>
                  <th>Alamat</th>
                  <th>Tahun Berdiri</th>
                  <th style="width: 180px;">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  include("connection.php");
                  
                  $query = "SELECT * FROM publisher ORDER BY id ASC";
                  $result = mysqli_query($connection, $query);

                  if (!$result) {
                     die ("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                  }

                  $i = 1;
                  
                  while($data = mysqli_fetch_assoc($result)){
                     echo "<tr>";
                     echo "<th scope=\"row\">$i</th>";
                     echo "<td>$data[nama_publisher]</td>";
                     echo "<td>$data[alamat]</td>";
                     echo "<td>$data[tahun_berdiri]</td>";
                     echo "<th scope=\"row\" class=\"action-buttons\">
                              <form action=\"./update_mahasiswa.php\" method=\"post\">
                                 <input type=\"hidden\" name=\"id\" value=\"$data[id]\">
                                 <input type=\"submit\" name=\"submit\" value=\"Update\" class=\"update-button\">
                              </form>
                              <form action=\"./delete_mahasiswa.php\" method=\"post\">
                                 <input type=\"hidden\" name=\"id\" value=\"$data[id]\">
                                 <input type=\"submit\" name=\"submit\" value=\"Delete\" class=\"delete-button\">
                              </form>
                           </th>";
                     echo "</tr>";
                        $i++;
                  }
                     
                  mysqli_free_result($result);
                  mysqli_close($connection);
               ?>
            </tbody>
         </table>
      </div>
   </main>
</body>
</html>