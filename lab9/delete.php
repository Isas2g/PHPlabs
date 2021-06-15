<?php

function deleteValues($id=1, $lastname) {
    require 'secret.php';
    $mysqli = mysqli_connect($DB_host, $DB_login, $DB_password, $DB_name);

    if( mysqli_connect_errno() ) 
        echo 'Ошибка подключения к БД: '.mysqli_connect_error();

    $query_add = 'DELETE FROM '.$DB_table_name.' WHERE id='.$id;

    $sql_res=mysqli_query($mysqli, $query_add);

    $_SESSION['query_result_data'] = '('.$id.')';
    $_SESSION['LASTNAMESUKA'] = $lastname;
    $_SESSION['query_result'] = !mysqli_errno($mysqli);
    header("Location: ".explode('?',$_SERVER['REQUEST_URI'])[0]);
}

    require 'editing.php';
    require 'head.php';

    echo getList(true);

    if (isset($_GET['id'])) {
        deleteValues($_GET['id'], $_GET['lastname']);
    }
    else {
        if (isset($_SESSION['query_result'])) {
            if( $_SESSION['query_result']=='0' )
                echo '<div class="error">Запись не удалена</div>';
            else if ( $_SESSION['query_result']=='1' )
                echo '<div class="ok">Запись '.$_SESSION['query_result_data'].' ' .$_SESSION['LASTNAMESUKA']. ' удалена</div>';
        }
        $_SESSION['query_result']='-1';
    }

    require 'foot.php';
?>