<?php
 include __DIR__ . '/includes/globals.php';

 if (isset($_GET['stato'])) {
    \ExitPoll\Utils\show_alert('inserimento', $_GET['stato']);
}
 ?>

 <div class="container my-5">
     <div class="row">
         <div class="col-12">
                <form method="POST" action="./includes/insert-poll.php">
                    <div class="mb-3">
                        <label for="name_poll" class="form-label">Inserisci il nome della votazione</label>
                        <input name="name_poll" type="text" class="form-control" id="name_poll">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
         </div>
     </div>
 </div>