<?php

include __DIR__ . '/globals.php';

// var_dump($_GET['id']);
// exit;

\ExitPoll\Poll::deletePoll($_GET['id']);

?>