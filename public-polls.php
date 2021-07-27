<?php

include __DIR__ . '/includes/globals.php';

if (isset($_GET['stato'])) {
    \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
}

$polls= \ExitPoll\Poll::showPublicPoll();


?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2>Votazioni Pubbliche:</h2>
        </div>
        <div class="col-12">
            <?php foreach($polls as $poll) : ?>
                <div class="card my-5">

                  
                    <div class="card-body">
                        
                        <p> <?php echo $poll['description'] ?> </p>
                        <h3> <?php echo $poll['name_poll'] ?> </h3>
                        <?php if($poll['is_closed'] == 1) : ?>
                        <h3 class="text-danger">Votazione chiusa</h3>
                        <a href="./register.php?stato=errore&messages=Registrati per vedere i risultati" class="btn btn-outline-warning">Guarda i risultati!</a>
                        <?php else :?>
                        <h5 class="text-secondary">La votazione chiuderà il 
                            <span class="text-italic text-dark">
                                 <?php echo implode('-', array_reverse(explode('-',$poll['closing_day']))) ?>
                            </span>
                        </h5>
                        <form action="./includes/choice-poll.php?id=<?php echo $poll['id'] ?>" method="POST" class="p-4">
                            <div class="form-check form-check-inline">
                                <input type="radio" id="no" name="choice" value="0">
                                <label for="no">No</label><br>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="yes" name="choice" value="1">
                                <label for="yes">Si</label><br>
                            </div>
                            <button type="submit" class="btn btn-outline-dark"> VOTA</button>
                        </form>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>    
        </div>
    </div>
</div>