<?php
    session_start();
    include __DIR__ . '/includes/globals.php';

    if (isset($_GET['stato'])) {
        \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
    }
?>


<section class="container my-5">
    <div class="row">
        <div class="col-12 col-md-6 p-5">
            <h1 class="fw-bold">Benvenuti in Exit-poll</h1>
            <p>registrati per scoprire le Votazioni private e consulta i risultati</p>
            <p>...altrimenti dai uno sguardo alle nostre Votazioni pubbliche</p>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>