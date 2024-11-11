<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
   }

   $currentpage = 'penulis';
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
         <h2>Daftar Penulis</h2>
         <a href="tambahpenulis.php">
            <button type="button">
               <i class="fa-solid fa-plus"></i>
               &nbsp; Tambah Penulis
            </button>
         </a>
      </header>
      <div>
         <table class="table-data">
            <thead>
               <tr>
                  <th style="width: 10px;">#</th>
                  <th>Nama Penulis</th>
                  <th>Usia</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th style="width: 220px;">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  include("connection.php");
                  
                  $query = "SELECT * FROM penulis ORDER BY id ASC";
                  $result = mysqli_query($connection, $query);

                  if (!$result) {
                     die ("Query Error: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
                  }

                  $i = 1;
                  
                  while($data = mysqli_fetch_assoc($result)){
                     echo "<tr>";
                     echo "<th scope=\"row\">$i</th>";
                     echo "<td>$data[nama]</td>";
                     echo "<td>$data[usia]</td>";
                     echo "<td>$data[phone]</td>";
                     echo "<td>$data[email]</td>" ;
                     echo "<th scope=\"row\" class=\"action-buttons\">
                              <form action=\"./updatepenulis.php\" method=\"post\">
                                 <input type=\"hidden\" name=\"id\" value=\"$data[id]\">
                                 <button type=\"submit\" name=\"submit\" class=\"update-button\" value=\"Update\">
                                    <i class=\"fa-solid fa-pen-to-square\"></i>
                                    &nbsp; Update
                                 </button>
                              </form>
                              <form action=\"./hapuspenulis.php\" method=\"post\">
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