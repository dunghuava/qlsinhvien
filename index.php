<?php
    include ('config.php');
    include ('models/database.php');
    $d = new database($config);
    $page = 'index';
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    include ('sources/header.php');
        echo('<div class="container" style="width:100%;">');
        echo('<div class="row" style="background:#EFEFEF">');
            echo('<div class="col-md-2 pd0">');
                include ('sources/menu.php');
            echo('</div>');
            echo('<div class="col-md-10 md9">');
            if (file_exists('sources/'.$page.'.php')){
                include ('sources/'.$page.'.php');
            }else{
                include ('sources/404.php');
            }
            echo('</div>');
        echo('</div>');
        echo('</div>');
    include ('sources/footer.php');
    $d->disconnect();
?>