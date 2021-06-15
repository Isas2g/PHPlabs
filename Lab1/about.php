<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lemonada&display=swap" rel="stylesheet">
    <title><?php $title = 'About';
            echo $title; ?></title>
</head>

<body>
    <header>
        <nav>
            <a href="<?php
                        $name = 'Home';
                        $link = 'index.php';
                        $current_page = true;
                        echo $link;
                        ?>" <?php

                            if ($current_page)
                                echo ' class="menu_item">';
                            echo $name;
                            ?></a>

                <a href="<?php
                            $name = 'About';
                            $link = 'about.php';
                            $current_page = true;
                            echo $link;
                            ?>" <?php

                                if ($current_page)
                                    echo ' class="menu_item active">';
                                echo $name;
                                ?></a>

                    <a href="<?php
                                $name = 'Contact';
                                $link = 'contact.php';
                                $current_page = true;
                                echo $link;
                                ?>" <?php

                                    if ($current_page)
                                        echo ' class="menu_item">';
                                    echo $name;
                                    ?></a>
        </nav>
    </header>
    <section class="about">
        <div class="image_wrapper">
            <img class="porter" src="img/moving-boxes-3174791_1920.jpg" alt="">
            <?php
            // echo '<img src="moving-boxes.png" alt="Меняющаяся фотография">';
            ?>
        </div>
        <div class="text_wrapper">
            <h1 class="title">About our company</h1>
            <p class="text">Eco Movers was founded with the goal of reducing wasteful practices that plague the moving industry. The Eco-Box, our reusable moving containers, is one of many ways for you to get involved in that effort. We’ve saved more than 45,000 cardboard boxes since 2015 thanks to our incredible customers! The Eco-Box is a waste-free alternative to cardboard boxes, as well as being safer for your items and easier to pack and move. We deliver to your door and pick up when you’ve finished unpacking — the easiest way to find packing materials.</p>
        </div>
    </section>
    <footer>
        <p>Copyright <?php echo date('d.m.Y в H-i:s') ?></p>
    </footer>
</body>

</html>