<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.css"/>
        <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.js"></script>
        <style type="text/css">
            .blue{
            background-color: blue;
            width: 500px;
                height: 100px;
            }
            .yellow{
                background-color: yellow;
               margin: 10px;
}
        </style>
        <title>Laporan Keuangan</title>
    </head>
    <body>


        <?php
        echo '<h2>Aplikasi Laporan Keuangan</h2>';
        ?>
        <form action="index.php" method="POST">
            <label>Username</label><input type="text" name="username here" placeholder="type username here. . . "><br>
            <label>Password</label><input type="password" name="password" placeholder="type password here. . . "><br>
            <input type="checkbox" name="checkbox[]" value="remembered">Remember Me<br>
            <input type="submit" name="submit" value="login"><br>
            <button type="submit" name="submit_btn">Cancel</button>
            
        </form>
        <?php
        if(isset($_POST['submit'])){
            echo $_POST['submit'];
            echo $_POST['password'];
            print_r($_POST['checkbox']);

        }
        ?>
        <ul>
            <li>List 1</li>
            <li>List 2
            <ul>
            <li>Sublist 1</li>
            <li>Sublist 2</li>
            <li>Sublist 3</li></ul>
            </li>
            <li>List 3</li>
        </ul>

        <table border="1">
            <tr><th>No.</th><th>Kolom 1</th><th>Kolom 2</th></tr>
            <tr><td>1.</td><td>Nilai 1</td><td>Nilai 2</td></tr>

        </table>
        <div class="blue">
            <div class="yellow">
               <p>Tulisan highlight</p>
            </div>
        </div>
    </body>
</html>
