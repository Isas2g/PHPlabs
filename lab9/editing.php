<?php
function getList($isDelete=false) {
        session_from_get();
        $page=$_SESSION['pg'];

        require 'secret.php';
        $mysqli = mysqli_connect($DB_host, $DB_login, $DB_password, $DB_name);
        
        if( mysqli_connect_errno() )
            return 'Ошибка подключения к БД: '.mysqli_connect_error();
        
        $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM '.$DB_table_name);
        if( !mysqli_errno($mysqli) && $row=mysqli_fetch_row($sql_res) )
        {
            if( !$TOTAL=$row[0] )
                return 'В таблице нет данных';
            $PAGES = ceil($TOTAL/10); 
            if( $page>=$TOTAL )
                $page=$TOTAL-1; 

            $sql='SELECT id, '.$DB_fields['surname'].', LEFT('.$DB_fields['name'].',1) AS name, LEFT('.$DB_fields['secondname'].',1) AS secondname FROM '.$DB_table_name.' ORDER BY id LIMIT '.($page*10).', 10'; 
            $sql_res=mysqli_query($mysqli, $sql);

            $ret = '<div class="div-edit">';
            while( $row=mysqli_fetch_assoc($sql_res) )
            {
                $isSelected = (isset($_GET['id'])&&$_GET['id']==$row['id']) ? ' class="currentRow"' : '';
                $onclick = ($isDelete) ? "onclick='(function(e){ if (!confirm(`Удалить данные?`)) e.preventDefault(); })(event)'" : '';
                $ret .= '<a href="?id='.$row['id'].'&lastname='.$row['LastName'].'"'.$isSelected.' '.$onclick.'>('.$row['id'].') '.$row[$DB_fields['surname']].' '.$row['name'].'. '.$row['secondname'].'.</a><br>';
            }
            $ret .= '</div>';
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
        }
        return $ret;
    }
    
    ?>