 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
       <!-- <a href="index3.html" class="nav-link">Home</a> -->
     </li>
     <li class="nav-item d-none d-sm-inline-block">
       <!-- <a href="#" class="nav-link">Contact</a> -->
     </li>
   </ul>

   <ul class="navbar-nav ml-auto">
     <li class="nav-item d-none d-sm-inline-block">
       <b> <a href="#" id="time" style="color:#17a5db" class="nav-link">loading..</a></b>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-widget="navbar-search" href="#" role="button">
         <i class="fas fa-solid fa-lg fa-info fa-clock"></i>
       </a>
     </li>
   </ul>
   </ul>
   <script>
     var timeDisplay = document.getElementById("time");

     function refreshTime() {
       var dateString = new Date().toLocaleString("th-TH", {
         timeZone: "Asia/Bangkok",
       });
       var formattedString = dateString.replace(", ", " - ");
       timeDisplay.innerHTML = formattedString;
     }
     setInterval(refreshTime, 1000);
   </script>
   <!-- SEARCH FORM -->
 </nav>
 <!-- /.navbar -->