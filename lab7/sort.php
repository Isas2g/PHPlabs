<?php include 'header.html' ?>
    <main>
        <?php
        
        function sort_bubble($arr){
            global $a;
            $size = sizeof($arr)-1;
            for ($i = $size; $i>=0; $i--) {
                for ($j = 0; $j<=($i-1); $j++){
                    if ($arr[$j]>$arr[$j+1]) {
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j+1];
                        $arr[$j+1] = $temp;
                    }
                    echo '<div class="main-div">Итерация №'.(++$a).'  ';
                    print_r($arr);
                    echo '</div>';
                }
            }
            return($arr);
        }

        function sort_choise($arr){
            global $a;
            for($i=0; $i<count($arr)-1; $i++){
                $min = $arr[$i];
                for($j=$i+1;$j<count($arr); $j++){
                    if ($arr[$i]>$arr[$j]){
                        $far=$arr[$j];
                        $arr[$i]=$arr[$j];
                        $arr[$j]=$min;
                        $min=$far;
                    }
                    echo '<div class="main-div">Итерация №'.(++$a).'  ';
                    print_r($arr);
                    echo '</div>';
                }
            }
            return($arr);
        }

        function sort_shell($arr){
                global $a;
                $length = count($arr);
                $k=0;
                $gap[0] = (int) ($length / 2);
           
                while($gap[$k] > 1) {
                    $k++;
                    $gap[$k]= (int)($gap[$k-1] / 2);
                }
           
                for($i = 0; $i <= $k; $i++){
                    $step=$gap[$i];
                    for($j = $step; $j < $length; $j++) {
                        $temp = $arr[$j];
                        $p = $j - $step;
                        while($p >= 0 && $temp < $arr[$p]) {
                            $arr[$p + $step] = $arr[$p];
                            $p = $p - $step;
                        }
                        $arr[$p + $step] = $temp;
                    }
                    echo '<div class="main-div">Итерация №'.(++$a).'  ';
                    print_r($arr);
                    echo '</div>';
                }
                return $arr;
        }

        function sort_gnome($arr) {
            global $a;
            $i = 1;
            $size = count($arr);
            while($i < $size) {
                if($arr[$i - 1] <= $arr[$i]) $i++;
                else {
                    list($arr[$i - 1], $arr[$i]) = array($arr[$i], $arr[$i - 1]);
                    if($i > 1) $i--;
                }
                echo '<div class="main-div">Итерация №'.(++$a).'  ';
                print_r($arr);
                echo '</div>';
            }
            return $arr;
        }

        function my_sort(&$arr, $left, $right) {
            global $a;
            $l = $left;
            $r = $right;
            $center = $arr[(int)($left + $right) / 2];
            do {
                while ($arr[$r] > $center) {
                    $r--;
                }
                while ($arr[$l] < $center) {
                    $l++;
                }
                if ($l <= $r) {
                    list($arr[$r], $arr[$l]) = array($arr[$l], $arr[$r]);
                    $l++;
                    $r--;
                }
                echo '<div class="main-div">Итерация №'.(++$a).'  ';
                print_r($arr);
                echo '</div>';
            } while ($l <= $r);

            if ($r > $left)
                my_sort($arr, $left, $r);
            if ($l < $right)
                my_sort($arr, $l, $right);
        }

        function qsort(&$arr) {
            $left = 0;
            $right = count($arr) - 1;
            my_sort($arr, $left, $right);
        }

        try {
            if (($_POST['arrLength']==1) && ($_POST['element0']=='')){
                echo 'Массив не задан';
                exit();
            }
            $out_text='<div class="main-div">Исходный массив<br>';
            $arr = array();
            for ($i=0; $i<$_POST['arrLength']; $i++){
                $arr[$i] = $_POST['element'.$i];

                if (!is_numeric($_POST['element'.$i])){
                    echo 'Элемент массива '.($i+1).' не число.';
                    exit();
                }

                $out_text.='<pre>    Элемент №'.($i+1).':&nbsp;'.$_POST['element'.$i].'<br></pre>';
            }
            $out_text.='<br>Массив проверен, сортировка возможна. <br></div>';

            echo $out_text;

            $a=0;

            switch($_POST['opt']){
                case 'Сортировка выбором':
                    echo '<h2>Сортировка выбором</h2>';
                    $time=microtime(true);
                    sort_choise($arr);
                    break;
                case 'Пузырьковый алгоритм':
                    echo '<h2>Сортировка пузырьком</h2>';
                    $time=microtime(true);
                    sort_bubble($arr);
                    break;
                case 'Алгоритм Шелла':
                    echo '<h2>Алгоритм Шелла</h2>';
                    $time=microtime(true);
                    sort_shell($arr);
                    break;
                case 'Алгоритм садового гнома':
                    echo '<h2>Алгоритм садового гнома</h2>';
                    $time=microtime(true);
                    sort_gnome($arr);
                    break;
                case 'Быстрая сортировка':
                    echo '<h2>Быстрая сортировка</h2>';
                    $time=microtime(true);
                    qsort($arr);
                    break;
                case 'Встроенная функция PHP для сортировки списков по значению':
                    echo '<h2>Встроенная функция PHP для сортировки списков по значению</h2>';
                    $time=microtime(true);
                    asort($arr);
                    foreach ($arr as $key) {
                        echo '<div class="main-div">'.$key.'</div>';
                    }
                    break;
            }
            echo '<div class="main-div">Сортировка завершена.<br>';
            echo 'Время выполнения: '.microtime(true)-$time.'&nbsp;мкс</div>';
            } catch (Exception $e) {
                echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
            }
        ?>
    </main>
</body>
</html>