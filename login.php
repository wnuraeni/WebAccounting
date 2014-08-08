<?php
if (isset($_POST['submit_btn'])){
   echo $username = $_POST['username'];
    echo $password = ($_POST['password']);

    $sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
    $result = mysql_query($sql);
    echo $row = mysql_num_rows($result);

    if($row > 0){
        echo 'user ada';
        $_SESSION['isLogin'] = TRUE;
        $data = mysql_fetch_object($result);
        $_SESSION['username'] = $data->username;
        $_SESSION['hakakses'] = $data->hakakses;
         header('Location: index.php');
    }
}
if(isset($_GET['logout'])){
    session_destroy();
    header('Location: index.php');
}
?>
