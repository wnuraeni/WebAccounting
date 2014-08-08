<?php
session_start();
ob_start();
include_once 'database.php';
include_once 'login.php'; ?>
<!DOCTYPE HTML>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
       <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
       <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/datetimepicker.js"></script>
       <script type="text/javascript">
   $(document).ready(function(){
       $('.dropdown-toggle').dropdown();
       $('.dropdown input, .dropdown label').click(function(e){
           e.stopPropagation();
       });
   });
   </script>
        <style>
            .footer {
    background-color: #F5F5F5;
    border-top: 1px solid #E5E5E5;
    margin-top: 70px;
    padding: 30px 0;
    text-align: center;
    height: 100%;
}
.footer p {
    color: #777777;
    margin-bottom: 0;
}
.footer-links {
    margin: 10px 0;
}
.footer-links li {
    display: inline;
    padding: 0 2px;
}
.footer-links li:first-child {
    padding-left: 0;
}
        </style>
       <title>Laporan Keuangan</title>
    </head>
    <body style="background-color: #EFEFEF">
        <div class="navbar navbar-fixed-top" style="background-color:#EaEaEa">
            <div class="navbar-inner">
                <a class="brand">Keuangan</a>
                <?php if(isset($_SESSION['isLogin'])== TRUE){?>
                <ul class="nav">  
                      <?php if(isset($_SESSION['hakakses']) && $_SESSION['hakakses']=="staff"){?>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="?menu=input_jurnal">Jurnal</a></li>
                    <li><a href="?menu=data">Data</a></li>
                    <li><a href="?menu=log">Log Aktifitas</a></li>
                    <li><a href="?menu=laporan">Laporan</a></li>
                     <?php }else if(isset($_SESSION['hakakses']) && $_SESSION['hakakses']=="direktur"){ ?>
                     <li><a href="?menu=laporan">Laporan</a></li>
                     <?php }?>
                </ul>
                <?php }else{
                    ?>
                <ul class="nav">
                  
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Jurnal</a></li>
                    <li><a href="#">Data</a></li>
                    <li><a href="#">Log Aktifitas</a></li>
                     <li><a href="#">Laporan</a></li>
                     
                </ul>
                <?php } ?>
                <ul class="nav pull-right">
                    <?php if(isset($_SESSION['isLogin']) !=TRUE){?>
                    <li class="dropdown"><a class="dropdown-toggle">Login <b class="caret" ></b></a>
                        <div class="dropdown-menu" style="padding: 15px;">
                            <form action="index.php?menu=data" method="POST">
                                <label>Username</label><input type="text" name="username" placeholder="Type Username. . . ">
                                 <label>Password</label><input type="password" name="password" placeholder="Type password. . . ">
                                 <button type="submit" class="btn btn-primary" name="submit_btn">Login</button>
                            </form>
                        </div>
                    </li>
                    <?php } else{?>
                    <li><a>Welcome, <?php echo $_SESSION['username'];?></a> </li>
                    <li><a href="?logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div><!-- navbar -->
        <div class="hero-unit" style="background-color: #fefefe">
      <img src="img/esfera.png" width="300" height="290">
         <p>Gedung E lantai 2 No. xxx
Jalan x, Bandung</p>

        </div>
        <br><br><br><br>
        <div class="container-fluid" >
            <div class="row-fluid" >
           <?php
           if(isset($_GET['menu'])){
               include_once $_GET['menu']. '.php';
           }else{
               include_once 'home.php';
           }
           ?>
                
            </div>
            
        </div>
        <footer class="footer">
             <div class="container">
                 <div class="span2">
                     &copy; Copyright 2012
                 </div>
             </div>
         </footer>
    </body>
</html>
