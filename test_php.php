<?php
$var = 10;
$txt = 'string';
$boolean = 'TRUE';

echo $var.'<br>';
echo $txt.'<br>';
echo $boolean.'<br>';

$connect = mysql_connect('localhost','root','') or die (mysql_error());
mysql_select_db('keuangan',$connect) or die (mysql_error());
$sql = "SELECT * FROM `user`";
$result = mysql_query($sql);
while($data = mysql_fetch_array($result)){
    echo $data['id'];
    echo ' '.$data['username'];
    echo ' '.$data['password'];
    echo '<br>';
}

include_once 'test2.php';
?>
