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
      <?php
            if (isset($_GET["message"])) {
               echo "<div>" . $_GET["message"] . "</div>";
            }
      ?>
      <header class="daftar-page">
         <h2>Daftar Publisher</h2>
         <a href="tambahpublisher.php">
            <button type="button">
               <i class="fa-solid fa-plus"></i>
               &nbsp; Tambah Publisher
            </button>
         </a>
      </header>
      <div>
         <table class="table-data">
            <thead>
               <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nama Publisher</th>
                  <th>Alamat</th>
                  <th>Tahun Berdiri</th>
                  <th style="width: 220px;">Action</th>
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
                              <form action=\"./updatepublisher.php\" method=\"post\">
                                 <input type=\"hidden\" name=\"id\" value=\"$data[id]\">
                                 <button type=\"submit\" name=\"submit\" class=\"update-button\" value=\"Update\">
                                    <i class=\"fa-solid fa-pen-to-square\"></i>
                                    &nbsp; Update
                                 </button>
                              </form>
                              <form action=\"./hapuspublisher.php\" method=\"post\">
                                 <input type=\"hidden\" name=\"id\" value=\"$data[id]\">
                                 <button type=\"submit\" name=\"submit\" class=\"delete-button\" value=\"Delete\">
                                    <i class=\"fa-solid fa-trash\"></i>
                                    &nbsp; Delete
                                 </button>
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