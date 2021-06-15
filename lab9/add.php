<?php
    require 'head.php';

    if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')
    {
        require 'secret.php';
        $mysqli = mysqli_connect($DB_host, $DB_login, $DB_password, $DB_name);

        if( mysqli_connect_errno() )
            echo 'Ошибка подключения к БД: '.mysqli_connect_error();
        
        $query_add = 'INSERT INTO '.$DB_table_name.' (';
        foreach($DB_fields as $key => $value) {
            $query_add .= $value;
            if ($key!='comment') $query_add .= ', ';
        }
        $query_add .= ') VALUES (';
        foreach($DB_fields as $key => $value) {
            $query_add .= '"'.htmlspecialchars($_POST[$key]).'"';
            if ($key!='comment') $query_add .= ', ';
        }
        $query_add .= ');';

        $sql_res=mysqli_query($mysqli, $query_add);

        $_SESSION['query_result_data'] = '('.mysqli_insert_id($mysqli).') '.htmlspecialchars($_POST['surname']);
        $_SESSION['query_result'] = !mysqli_errno($mysqli);
        header("Location: ".$_SERVER['REQUEST_URI']);
    }
    else {
        if (isset($_SESSION['query_result'])) {
            if( $_SESSION['query_result']=='0' )
                echo '<div class="error">Запись не добавлена</div>';
            else if ( $_SESSION['query_result']=='1' )
                echo '<div class="ok">Запись "'.$_SESSION['query_result_data'].'" добавлена</div>';
        }
        $_SESSION['query_result']='-1';
    }

    $controlVar = false;
    require 'add.html';
    require 'foot.php';
?>