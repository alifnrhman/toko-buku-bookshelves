<?php
   session_start();

   if(!isset($_SESSION['username'])) {
      header('location: index.php');
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
   <aside id="sidebar">
      <section id="sidebar-header">
         <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="81px" height="47.6px"
            viewBox="0 0 383.000000 283.000000" preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,283.000000) scale(0.100000,-0.100000)" fill="var(--accent-200)"
               stroke="none">
               <path
                  d="M3551 2763 c-27 -32 -60 -71 -73 -86 l-23 -28 -85 40 c-244 114 -543 148 -792 90 -180 -42 -308 -112 -441 -240 l-71 -68 -40 37 c-99 91 -258 174 -421 218 l-100 28 -743 3 -742 4 0 -46 0 -45 185 0 185 0 0 -1250 0 -1250 -185 0 -185 0 0 -45 0 -45 693 0 c803 0 880 6 1080 75 39 14 72 25 74 25 2 0 3 -28 3 -63 0 -69 10 -87 50 -87 33 0 49 15 139 133 73 95 84 106 95 88 10 -15 137 -96 206 -131 239 -121 551 -147 810 -68 261 80 506 301 593 536 62 169 78 399 37 557 -49 195 -163 339 -335 427 -110 55 -131 62 -569 183 -192 53 -374 106 -405 117 -167 62 -256 172 -268 331 -9 124 30 237 114 321 128 130 353 197 585 176 115 -11 169 -26 268 -73 70 -32 101 -55 171 -126 104 -104 157 -203 192 -359 24 -107 37 -132 71 -132 46 0 46 3 46 401 0 208 -3 384 -6 393 -4 9 -18 16 -34 16 -23 0 -40 -13 -79 -57z m-2151 -103 c168 -32 274 -138 315 -314 22 -94 21 -360 -1 -457 -37 -167 -108 -245 -264 -294 -75 -24 -610 -36 -610 -14 0 10 0 980 0 1077 0 15 479 17 560 2z m633 -985 c49 -76 158 -169 267 -224 113 -58 218 -95 519 -181 247 -71 483 -157 552 -201 105 -67 162 -162 181 -301 25 -189 -61 -390 -217 -506 -84 -63 -205 -117 -304 -138 -102 -20 -303 -15 -396 11 -141 39 -302 134 -411 241 l-55 55 25 42 c54 93 71 170 71 327 0 126 -3 155 -24 219 -72 220 -288 406 -572 492 -38 12 -69 22 -69 24 0 1 38 14 84 29 108 33 197 75 261 120 28 19 52 35 55 35 3 1 18 -19 33 -44z m-617 -206 c88 -16 191 -68 247 -124 58 -59 112 -164 134 -265 24 -106 24 -447 0 -541 -48 -194 -155 -307 -332 -349 -29 -7 -171 -14 -337 -17 l-288 -5 0 656 0 656 258 0 c144 0 285 -5 318 -11z" />
            </g>
         </svg>
         <h2>BookShelves</h2>
      </section>
      <hr>
      <section id="sidebar-content">
         <div class="item">
            <a href="" class="sidebar-link">
               <div class="icon">
                  <i class="fa-solid fa-book"></i>
               </div>
               Daftar Buku
            </a>
         </div>
         <div class="item">
            <a href="" class="sidebar-link">
               <div class="icon">
                  <i class="fa-solid fa-building"></i>
               </div>
               Daftar Publisher
            </a>
         </div>
         <div class="item">
            <a href="" class="sidebar-link">
               <div class="icon">
                  <i class="fa-solid fa-pen-clip"></i>
               </div>
               Daftar Penulis
            </a>
         </div>
      </section>
      <hr>
      <section id="sidebar-footer">
         <div class="item">
            <a href="" class="sidebar-link">
               <div class="icon">
                  <i class="fa-solid fa-user"></i>
               </div>
               <?= $_SESSION['nama'] ?>
            </a>
         </div>
         <div class="item">
            <a href="logout.php" class="sidebar-link">
               <div class="icon">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
               </div>
               Logout
            </a>
         </div>
      </section>
   </aside>
   <main>
   </main>
</body>
</html>