<?php
	session_start();
   setcookie("message", "");

	if (isset($_SESSION['username'])) {
		header("location: dashboard.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css\style.css">
   <style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
   </style>
   <title>Toko Buku</title>
</head>
<body>
   <main id="login-main">
      <div class="login-container">
         <div class="login-header">
            <div class="login">
               <h2>Login</h2>
               <hr>
            </div>
         </div>
         <div class="login-content">
            <form action="login.php" method="post">
               <input type="text" name="username" id="username" placeholder="Username" required>
               <input type="password" name="password" id="password" placeholder="Password" required>
               <div class="warning">
                  <?php
							if (isset($_COOKIE['message'])) {
								echo $_COOKIE['message'];
							}
						?>
               </div>
               <input type="submit" value="Login">
            </form>
         </div>
      </div>
   </main>
</body>
</html>

<?php
	include 'connection.php';

?>