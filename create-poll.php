<?php

session_start();

if (!isset($_SESSION['is_admin'])) {
    header('Location: http://localhost:8888/exit-poll/login.php');
  }elseif ($_SESSION['is_admin'] == 0){
    header('Location: http://localhost:8888/exit-poll/?stato=errore&messages=Impossibile accedere');
  }

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
                        <input name="name_poll" type="text" class="form-control" id="name_poll" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" id="description" cols="30" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="closing_day" class="form-label">Imposta data chiusura votazione</label>
                        <input name="closing_day" type="date" class="form-control" id="closing_day" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imposta tipo di votazione</label>
                        <select name="is_private" class="form-select" required>
                        <option value="1">Privata</option>
                        <option value="0">Pubblica</option>        
                        </select> 
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
         </div>
     </div>
 </div>