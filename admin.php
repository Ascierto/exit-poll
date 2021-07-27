<?php
session_start();


  include __DIR__ . '/includes/globals.php';

  $polls = \ExitPoll\Poll::showPoll();


?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Votazione</th>
                  <th scope="col">Visibilità</th>
                  <th scope="col">Stato</th> 
                  <th scope="col">Creata il</th>
                  <th scope="col">Da chiudere il</th>
                  <th scope="col">Vedi risultati live</th>
                  <th scope="col">Chiudi Votazione</th>
                  <th scope="col">Elimina Votazione</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($polls as $poll): ?>
                <tr>
                  <th scope="row"><?php echo $poll['id'] ?></th>
                  <td><?php echo $poll['name_poll'] ?></td>
                  <td><?php $poll['is_private']== 0 ? printf('Pubblica'):printf('Privata') ?></td>
                  <td><?php $poll['is_closed']== 0 ? printf('🔴'):printf('🟢') ?></td>
                  <td><?php $date =new DateTime($poll['created_at']); echo $date->format('d-m-y H:i:s'); ?></td>
                  <td><?php echo implode('-', array_reverse(explode('-',$poll['closing_day']))) ?></td>  
                  <td><a href="./live-results.php?id=<?php echo $poll['id'] ?>" class="btn btn-outline-warning">GO!</a></td>
                  <td><a href="./includes/close-poll.php?id=<?php echo $poll['id'] ?>" class="btn btn-outline-danger">✔️</a></td>
                  <td><a href="./includes/delete-poll.php?id=<?php echo $poll['id'] ?>" class="btn btn-danger">❌</a></td>
                </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
        </div>
    </div>
</div>