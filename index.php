<?php
    session_start();
    include __DIR__ . '/includes/globals.php';

    if (isset($_GET['stato'])) {
        \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
    }
?>


<h1>Homepage</h1>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>