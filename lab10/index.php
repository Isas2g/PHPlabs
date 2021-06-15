<?php
session_start();
if (!isset($_SESSION['history'])) {
    $_SESSION['history']=array();
    $_SESSION['iteration']=0;
} 
else $_SESSION['iteration']++;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Сортировка массивов</title>
</head>
<header>
    <img src="img\Mospolytech_logo.jpg">
</header>

<body>
    <main>
        <?php

        require 'form.html';

        if (isset($_POST['val'])) {
            $res = calculateSq($_POST['val']); // вычисляем результат выражения
            if (is_numeric($res)) // если полученный результат является числом
                echo '<div class="success">Значение выражения: ' . $_POST['val'] . ' = ' . $res . '</div>'; // вывод значения
            else // если результат не число – значит ошибка!
                echo '<div class="success">Ошибка вычисления выражения: ' . $_POST['val'] . '  ' . $res . '</div>'; // вывод ошибки
        }

        function is_calculate($x)
        {
            if (preg_match("/(\d+\.\d+|\d+)[+*\/\-:]/", $x)) return true;
            else return false;
        }

        function isnum($x)
        {
            if (@$x[0] == '.') return false;
            for ($i = 0, $point_count = false; $i < strlen($x); $i++) {
                if (@$x[$i] == '.') { // если в строке встретилась точка
                    if ($point_count) return false; // если точка уже встречалась то это не число
                    else $point_count = true; // если это первая точка в строке запоминаем это
                }
                if (preg_match("/[a-zA-Z_]/", $x))
                    return false;
                else return true;
            }
        }

        function SqValidator($v)
        {
            $open = 0; // создаем счетчик открывающихся скобок
            for ($i = 0; $i < strlen($v); $i++) // перебираем все символы строки
            {
                if ($v[$i] == '(') // если встретилась «(»
                    $open++; // увеличиваем счетчик
                else
            if ($v[$i] == ')') // если встретилась «)»
                {
                    $open--; // уменьшаем счетчик
                    if ($open < 0) // если найдена «)» без соответствующей «(»
                        return false; // возвращаем ошибку
                }
            }
            // если количество открывающихся и закрывающихся скобок разное
            if ($open !== 0) return false; // возвращаем ошибку
            if ($open === 0) return true; // количество скобок совпадает – все ОК
        }

        function calculateSq($val)
        {
            if (!SqValidator(($val))) echo 'Неправильное расположение скобок';
            $start = strpos($val, '(');
            if ($start === false) return calculate($val);
            for ($end = $start+1; $end<strlen($val); $end++) {
                if ($val[$end] == '(') $start=$end;
                if ($val[$end] == ')') break;
            }
            $new_val = substr($val, 0, $start);
            $new_val .= calculateSq(substr($val, $start+1, $end-$start-1));
            $new_val .=substr($val, $end+1);
            return calculateSq($new_val);
        }

        function calculate($val)
        {
            if (!$val) return 'Выражение не задано!';
            if (!is_calculate($val)) return $val;
            //сумма
            $args = explode('+', $val);
            if (count($args) > 1) {
                $sum = 0;
                for ($i = 0; $i < count($args); $i++) {
                    if (is_calculate($args[$i])) $sum += calculate($args[$i]);
                    elseif (is_numeric($args[$i])) $sum += $args[$i];
                    else echo "Операнд не числовой";
                }
                return $sum;
            }

            //разность
            $args = explode('-', $val);
            if (count($args) > 1) {

                if (is_calculate($args[0])) {
                    $sum = calculate($args[0]);
                } elseif (is_numeric($args[0])) $sum = $args[0];
                for ($i = 1; $i < count($args); $i++) {
                    if (is_calculate($args[$i])) $sum -= calculate($args[$i]);
                    elseif (is_numeric($args[$i])) $sum -= $args[$i];
                    else echo "Операнд не числовой";
                }
                return $sum;
            }

            //произведение
            $args = explode('*', $val);
            if (count($args) > 1) {
                $sum = 1;

                for ($i = 0; $i < count($args); $i++) {
                    if (is_calculate($args[$i])) $sum *= calculate($args[$i]);
                    elseif (is_numeric($args[$i])) $sum *= $args[$i];
                    else return "Операнд не числовой";
                }
                return $sum;
            }
            //деление
            $args = explode(':', $val);
            if (count($args) > 1) {

                if (is_calculate($args[0])) {
                    $sum = calculate($args[0]);
                } elseif (is_numeric($args[0])) {
                    $sum = $args[0];
                }

                for ($i = 1; $i < count($args); $i++) {
                    if (is_calculate($args[$i])) $sum /= calculate($args[$i]);
                    elseif (is_numeric($args[$i])) $sum /= $args[$i];
                    else return "Операнд не числовой";
                }
                return $sum;
            };
            $args = explode('/', $val);
            if (count($args) > 1) {

                if (is_calculate($args[0])) {
                    $sum = calculate($args[0]);
                } elseif (is_numeric($args[0])) {
                    $sum = $args[0];
                }

                for ($i = 1; $i < count($args); $i++) {
                    if (is_calculate($args[$i])) $sum /= calculate($args[$i]);
                    elseif (is_numeric($args[$i])) $sum /= $args[$i];
                    else return "Операнд не числовой";
                }
                return $sum;
            }
        }

        function div($arr)
        {
        }


        for ($i=0;$i<count($_SESSION['history']);$i++) {
            echo $_SESSION['history'][$i]. '<br/>';
        }
        if (isset($_POST['val']) && $_POST['iteration']+1 == $_SESSION['iteration']) {
            $_SESSION['history'][]=$_POST['val'].' = '.$res;
        }
        echo '</div>';
        ?>
    </main>
</body>

</html>