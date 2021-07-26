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
        $query->bind_param('ii',$id,$form_data['choice']);
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

    public static function getCountVoters($id){

        $id = intval($id);

        $db=connect();

        if($id){
            
            $query = $db->query("SELECT count(*) as tot_voters FROM results WHERE id_polls = " . $id);
        }
        


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;


    }

    public static function getSumVoters($id){

        $id = intval($id);

        $db=connect();

        if($id){
            
            $query = $db->query("SELECT sum(choice = 1) as somma_si, sum(choice = 0) as somma_no from results where id_polls= " . $id);
        }
        


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;

    }

    //SELECT sum(choice = 1) as somma_si, sum(choice = 0) as somma_no from results where id_polls=2;

    // -- provo una query di count dove id_pool e choice è qualcosa, con count posso fare report votanti

    // SELECT count(choice = 0) from results where id_polls=2;

    // -- con sum posso fare grafico delle scelte

    // SELECT sum(choice = 0) from results where id_polls=2;
}