<!DOCTYPE html> 
<html lang="ru"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Хусаинов Ренат, Использование Get-параметров в ссылках. Виртуальная клавиатура</title> 

    <?php
        include 'script.php';
    ?>
</head> 
<body> 
    <header> 
        <img src="img/Mospolytech_logo.jpg" alt="Mospolytech"> 
    </header> 
    <main>
        <?php
        $CellsCount = 6; //Целое, больше 0
        
        if ($CellsCount<=0) echo 'Ошибка! Неправильное число колонок.';
        else initialize();
        ?>
    </main> 
    <footer> 
        <p><a href="//bouhartsev.top" target="_blank">Автор - Хусаинов Ренат</a></p>
    </footer>
</body> 
</html>