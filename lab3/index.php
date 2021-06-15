<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Хусаинов Ренат, Использование Get-параметров в ссылках. Виртуальная клавиатура</title>
</head>
<body>
    <header>
        <img src="./img/Mospolytech_logo.jpg" alt="Mospolytech">
    </header>
    <main>
        <?php 
                $counter=0;
                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if (isset($_GET['count']) && isset($_GET['string'])) {
                    $counter = $_GET['count'] + strlen($_GET['string']);
                }
                else {
                    ob_start();

                    $url .= '?count=0&string=';

                    while (ob_get_status()) 
                    {
                        ob_end_clean();
                    }

                    header( "Location: $url" );
                }
            ?>  
        <div class = "calculator">

            <div class = "result">
                <?= $_GET['string'] ?>
            </div> 
            
            <div class = "keyboard">
                <?php 
                    for($i=1; $i<=9; $i++)
                        echo '<a href = "'.$url.$i.'">'.$i.'</a>';
                ?>
                <a href = '<?= $url ?>0'>0</a>
                <a class = "reset" href = './?count=<?= ($counter+1)?>&string='>СБРОС</a>
            </div>
        </div>
	
    </main>
    <footer>
    <p><?= $counter ?></P>
    </footer>
</body>
</html>