<?php
namespace ExitPoll;

include __DIR__ . '/globals.php';

class Results{

    public static function insertResult($id,$form_data){

        $form_data= array(
            'choice'=> $form_data['choice']
        );

        $id = intval($id);

        $db = connect();

        //per il momento choice ha valore stringa,potrei settare il campo come tinyint ed avere un dato in
        //ma magari ho tempo per predisporre anche valori di risposta diversi settandoli in inserimento

        $query = $db->prepare("INSERT INTO results(id_polls,choice) VALUES (?,?) ");
        $query->bind_param('is',$id,$form_data['choice']);
        $query->execute();

        if ($query->affected_rows === 0) {
            error_log('Errore MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/exit-poll/show-polls.php?stato=ko');
            exit;
        }else{
            
            header('Location: http://localhost:8888/exit-poll/show-polls.php?stato=ok');
            exit;
        }

        $query->close();

    }
}