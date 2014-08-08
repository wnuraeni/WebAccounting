<div class="span1">
</div>
<div class="span11">
<?php

/*----------------------------LIST TABEL LOG------------------------------*/
    $sql1 = "SELECT * FROM log";
    $result1 = mysql_query($sql1);
    $total = mysql_num_rows($result1);
    $limit = 10 ;
    $total_page = ceil($total/$limit);

    echo '<div  class="pagination pull-right">
        <ul>';
    for($i=1;$i<=$total_page;$i++){
        echo '<li><a href="index.php?menu=log&page='.$i.'">'.$i.'</a></li>';
    }
    echo '</ul></div>';

    if(isset($_GET['page'])){
        $offset = ($_GET['page'] - 1) * $limit;
    }
    else
    {
        $offset = 0;
    }
?>
<table class="table table-bordered">
    <thead>
    <th>Aktifitas Oleh</th>
    <th>Aktifitas Tanggal</th>
    <th>Aktifitas</th>
</thead>
    <tbody>
    <?php

    $sql = "SELECT * FROM log LIMIT $offset, $limit";
$result = mysql_query($sql);
    while($data=  mysql_fetch_assoc($result)){
        echo '<tr>
            <td>'.$data['activity_by'].'</td>
            <td>'.$data['date_activity'].'</td>
            <td>'.$data['activity'].'</td>
            </tr>';
    }
    ?>
    </tbody>
</table>
</div>
<?php  ?>
