<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>lab9</title>
</head>
<body>
    <header>
        <nav id="menu">
            <?php
            function session_from_get() {
                if( !isset($_SESSION['pg'])) $_SESSION['pg']=0;
                if (isset($_GET['pg'])) $_SESSION['pg'] = $_GET['pg'];
                if (isset($_GET['sort'])) $_SESSION['sort'] = $_GET['sort'];
            }

            $links = [
                'Просмотр' => 'index.php',
                'Добавление записи' => 'add.php',
                'Редактирование записи' => 'edit.php',
                'Удаление записи' => 'delete.php',
            ];
            $path = explode('?',''.basename($_SERVER['REQUEST_URI']))[0];
            foreach($links as $key => $value) {
                echo '<a href="./'.$value.'"';
                if (strpos($path,$value)!==false || ($path=='' || $path=='lab1_9')&&$value=='index.php') echo ' class="selected"';
                echo '>'.$key;
                echo '</a>';
            };
            session_start();
            ?>
        </nav>
    </header>
    <main>