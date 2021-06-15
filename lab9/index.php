<?php
    require 'head.php';

    include 'viewer.php';
    if(!isset($_SESSION['sort']) || ($_SESSION['sort']!='byid' && $_SESSION['sort']!='fam' && $_SESSION['sort']!='born'))
            $_SESSION['sort']='byid';
    session_from_get();
    echo getTable($_SESSION['sort'], $_SESSION['pg']);

    require 'foot.php';
?>