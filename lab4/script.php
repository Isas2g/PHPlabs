<?php
    $structure = '';

    function getTR($structure){ 
        global $CellsCount; 
        $data = explode(',',$structure);
        $res = '<tr>'; 
        for ($i=0; $i<$CellsCount;$i++){ 
            if (isset($data[$i])) 
                $res .= '<td>'.$data[$i].'</td>'; 
            else 
                $res .= '<td>'.''.'</td>'; 
        } 
        $res .='</tr>'; 

        return $res; 
    }

    function outTable($string){ 
        $data = explode("\r\n", $string);
        $res = '';
        for ($i = 0; $i<count($data); $i++){ 
            if ($data[$i]!='') $res .= getTR($data[$i]); 
        }
        if (count($data)==0 or (count($data)==1 and strlen($data[0])==0)) echo 'Ошибка! В таблице нет строк.';
        else if ($res=='') echo 'Ошибка! В таблице нет строк с ячейками.';
        else echo '<table>'.$res.'</table>';
    }

    function initialize() {
        $files = scandir("src");
        for ($i=2; $i<count($files); $i++) {
            echo '<h2>Таблица №'.($i-1).' ("'.$files[$i].'")</h2>';
            $structure = file_get_contents('src/'.$files[$i]);
            outTable($structure);
        }
        if (count($files)==2) echo 'Ошибка! Отсутсвуют таблицы.';
    }
?>