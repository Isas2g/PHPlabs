<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>PHP 8, Хусаинов Ренат</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<header>
    <img src = "img\Mospolytech_logo.jpg">
    <h1>php 8, Хусаинов</h1>
</header>
<body>
    <main>
    <form name="result" action="index.html"> 
     <div class="main-div"><b>Исходный текст</b><textarea style="font-style: italic; resize:none;" readonly><?php 
            if (!$_POST['text']) echo 'Нет текста для анализа.';
            else echo $_POST['text'];
        ?></textarea>
    </div>
    <div class="div-break"><p>Информация о тексте.</p></div>
    <div class="div-result">
    <?php
        $d_count=0;
        $text_encode=iconv('utf-8','cp1251', $_POST['text']);
        $arr=array();
        for ($i=0; $i<strlen($text_encode); $i++){
            $arr[$i]=iconv('cp1251', 'utf-8', $text_encode[$i]);
            if (is_numeric($arr[$i])) $d_count++;
        }

        $mark=preg_grep('/[\p{P}]/u', $arr);
        $upru=preg_grep('/[А-ЯЁ]/u', $arr);
        $upen=preg_grep('/[A-Z]/', $arr);
        $ru=preg_grep('/[а-яё]/u', $arr);
        $en=preg_grep('/[a-z]/', $arr);

        print_r($mark);

        $symbs=array();
        $uppercase=0;
        for ($i=0; $i<count($arr);$i++){
            if (isset($symbs[$arr[$i]])) $symbs[$arr[$i]]++;
            else $symbs[$arr[$i]]=1;
        }

        $rep=preg_replace('/[\p{P}|0-9]/','',$text_encode);
        $words=preg_split('/[\s]/', $rep);
        $word=array();
        $word_arr=array();
        for ($i=0; $i<count($words); $i++){
            $word[$i]=iconv('cp1251', 'utf-8', $words[$i]);
            if(isset($word_arr[$word[$i]])) $word_arr[$word[$i]]++;
            else $word_arr[$word[$i]]=1;
        }

        echo '<table><tr><td>';
        echo 'Количество символов в тексте (включая пробелы): </td><td>'.strlen($text_encode).'</td></tr>';
        echo '<tr><td>Количество букв</td><td>'.(count($ru)+count($en)+count($upen)+count($upru)).'</td></tr>';
        echo '<tr><td>Количество заглавных букв</td><td>'.(count($upru)+count($upen)).'</td></tr>';
        echo '<tr><td>Количество строчных букв</td><td>'.(count($ru)+count($en)).'</td></tr>';
        echo '<tr><td>Количество знаков препинания</td><td>'.count($mark).'</td></tr>';
        echo '<tr><td>Количество цифр</td><td>'.$d_count.'</td></tr>';
        echo '<tr><td>Количество слов</td><td>'.count($word).'</td></tr></table>';
        
        echo '<pre>Символы: ';
        print_r($symbs);
        echo 'Слова: ';
        print_r($word_arr);
        echo'</pre>';
    ?>
    <button class="form-btn" type="submit">Другой анализ</button>
    </div>
</form>
</main>
</body>
</html>
