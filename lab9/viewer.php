<?php
    function getTable($sort_type, $page)
    {
        echo '<div class="submenu">'; // выводим подменю
        echo '<a href="?sort=byid"'; // первый пункт подменю
        if( $sort_type == 'byid' )
        echo ' class="selected"';
        echo '>По-умолчанию</a>';
        echo '<a href="?sort=fam"'; // второй пункт подменю
        if( $sort_type == 'fam' )
        echo ' class="selected"';
        echo '>По фамилии</a>';
        echo '<a href="?sort=born"'; // третий пункт подменю
        if( $sort_type == 'born' )
        echo ' class="selected"';
        echo '>По дате рождения</a>';
        echo '</div>'; // конец подменю

        require 'secret.php';
        $mysqli = mysqli_connect($DB_host, $DB_login, $DB_password, $DB_name);
        
        if( mysqli_connect_errno() ) // проверяем корректность подключения
            return 'Ошибка подключения к БД: '.mysqli_connect_error();
        
        // формируем и выполняем SQL-запрос для определения числа записей
        $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM '.$DB_table_name);
        // проверяем корректность выполнения запроса и определяем его результат
        if( !mysqli_errno($mysqli) && $row=mysqli_fetch_row($sql_res) )
        {
            if( !$TOTAL=$row[0] ) 
                return 'В таблице нет данных';
            $PAGES = ceil($TOTAL/10); 
            if( $page>=$PAGES ) 
                $page=$PAGES-1; 
            $sort_type_db = 'id';
            if ($sort_type == 'fam') $sort_type_db = $DB_fields['surname'];
            else if ($sort_type == 'born') $sort_type_db =  $DB_fields['birthday'];
            $sql='SELECT * FROM '.$DB_table_name.' ORDER BY '.$sort_type_db.' LIMIT '.($page*10).', 10'; 
            $sql_res=mysqli_query($mysqli, $sql);

            $ret='<table>'; 
            $ret.='<tr>';
            $ret.='<th>ID</th>';
            $ret.='<th>Фамилия</th>';
            $ret.='<th>Имя</th>';
            $ret.='<th>Отчество</th>';
            $ret.='<th>Пол</th>';
            $ret.='<th>Дата рождения</th>';
            $ret.='<th>Телефон</th>';
            $ret.='<th>Адрес</th>';
            $ret.='<th>Email</th>';
            $ret.='<th>Комментарий</th>';
            $ret.='</tr>';

            while( $row=mysqli_fetch_assoc($sql_res) ) 
            {
                
                $ret.='<tr>';
                $ret .= '<td>'.$row['id'].'</td>';
                foreach($DB_fields as $key => $value) {
                    $ret .= '<td>'.$row[$value].'</td>';
                }
                $ret.='</tr>';
            }
            $ret.='</table>'; 
            if( $PAGES>1 ) 
            {
                $ret.='<div class="pages">'; 
                for($i=0; $i<$PAGES; $i++) 
                if( $i != $page ) 
                $ret.='<a href="?pg='.$i.'">'.($i+1).'</a>';
                else 
                $ret.='<span>'.($i+1).'</span>';
                $ret.='</div>';
            }
        return $ret; 
        }
        
        else return 'Неизвестная ошибка';
    }
?>