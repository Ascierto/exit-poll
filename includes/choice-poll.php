<?php
    include __DIR__ . '/globals.php';
    
    \ExitPoll\Results::insertResult($_GET['id'],$_POST);

?>