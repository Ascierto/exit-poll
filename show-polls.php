<?php

session_start();

    include __DIR__ . '/includes/globals.php';

    if (isset($_GET['stato'])) {
        \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
    }elseif(isset($_GET['statocanc'])){
        \ExitPoll\Utils\show_alert('cancellazione', $_GET['statocanc']);
    }

    $polls = \ExitPoll\Poll::showPoll();

?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2>Votazioni:</h2>
        </div>
        <div class="col-12">
            <?php foreach($polls as $poll) : ?>
                <div class="card my-5">

                  
                    <div class="card-body">
                        
                        <h3> <?php echo $poll['name_poll'] ?> </h3>
                        <p> <?php echo $poll['description'] ?> </p>
                        <p> Id di debug # <?php echo $poll['id'] ?> </p>
                        <?php if($poll['is_closed'] == 1) : ?>
                        <h3 class="text-danger">Votazione chiusa</h3>
                        <a href="./live-results.php?id=<?php echo $poll['id'] ?>" class="btn btn-outline-warning">Guarda i risultati!</a>
                        <?php else :?>
                        <h4>La votazione chiuderà il <span class="text-italic"> <?php echo implode('-', array_reverse(explode('-',$poll['closing_day']))) ?></span></h4>
                        <form action="./includes/choice-poll.php?id=<?php echo $poll['id'] ?>" method="POST">
                            <input type="radio" id="no" name="choice" value="0">
                            <label for="no">No</label><br>
                            <input type="radio" id="yes" name="choice" value="1">
                            <label for="yes">Si</label><br>
                            <button type="submit" class="btn btn-outline-dark"> VOTA</button>
                        </form>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>    
        </div>
    </div>
</div>