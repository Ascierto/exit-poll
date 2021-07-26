<?php
    include __DIR__ . '/includes/globals.php';

    if (isset($_GET['stato'])) {
        \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
    }

    $polls = \ExitPoll\Poll::showPoll();

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Votazioni aperte :</h2>
        </div>
        <div class="col-12">
            <?php foreach($polls as $poll) : ?>
                <h3> <?php echo $poll['name_poll'] ?> </h3>
                <p> <?php echo $poll['description'] ?> </p>
                <p> Id di debug # <?php echo $poll['id'] ?> </p>
                <form action="./includes/choice-poll.php?id=<?php echo $poll['id'] ?>" method="POST">
                    <input type="radio" id="no" name="choice" value="0">
                    <label for="no">No</label><br>
                    <input type="radio" id="yes" name="choice" value="1">
                    <label for="yes">Si</label><br>
                    <button type="submit" class="btn btn-outline-dark"> VOTA</button>
                </form>
            <?php endforeach; ?>    
        </div>
    </div>
</div>