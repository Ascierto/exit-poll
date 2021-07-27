<?php
namespace ExitPoll;

include __DIR__ . '/globals.php';

class Poll{

    public static function cleanInput($input)
    {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_ADD_SLASHES);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        return $input;
    }

    public static function validDate($input){
        return  implode('-', array_reverse(explode('/',$input)));
    }

    protected static function sanitize($fields)
    {
        
        $fields['name_poll'] = self::cleanInput($fields['name_poll']);

        $fields['description'] = self::cleanInput($fields['description']);

     

        return $fields;
    }

    public static function insertPoll($form_data){

        $form_data= array(
            'name_poll'=>$form_data['name_poll'],
            'description'=>$form_data['description'],
            'closing_day'=>$form_data['closing_day'],
            'is_private'=>$form_data['is_private']
        );

        $form_data['closing_day']= self::validDate($form_data['closing_day']);

        $form_data= self::sanitize($form_data);

        $db=connect();

        $query = $db->prepare("INSERT INTO polls(name_poll,description,closing_day,is_private) VALUES (?,?,?,?) ");
        $query->bind_param('sssi',$form_data['name_poll'],$form_data['description'],$form_data['closing_day'],$form_data['is_private']);
        $query->execute();

        if ($query->affected_rows === 0) {
            error_log('Errore MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/exit-poll/create-poll.php?stato=ko');
            exit;
        }else{
            
            header('Location: http://localhost:8888/exit-poll/create-poll.php?stato=ok');
            exit;
        }

        $query->close();
    }

    public static function showPoll($id=null){

        

        $db=connect();

        if ($id) {
           
            $query      = $db->prepare('SELECT * FROM polls WHERE polls.id = ? AND is_deleted =0');
            $query->bind_param('i', $id);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $db->query('SELECT * FROM polls where is_deleted =0');
        }

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;

    }

    public static function closePoll($id){

        $db = connect();

        $query= $db->prepare("UPDATE polls SET is_closed =1 WHERE id=?");
        $query->bind_param('s',$id);
        $query->execute();

        if ($query->affected_rows > 0) {
            header('Location: http://localhost:8888/exit-poll/show-polls.php?stato=ok');
            exit;
        } else {
            header('Location: http://localhost:8888/exit-poll/show-polls.php?stato=ko');
            exit;
        }
    }

    public static function softdeletePoll($id){

        $db= connect();


      if ( $id ) {

        $id = intval($id);

    
        $query = $db->prepare("UPDATE polls SET is_deleted =1 WHERE id=?");
        $query->bind_param('i', $id);
        $query->execute();


        if ($query->affected_rows > 0) {
            header('Location: http://localhost:8888/exit-poll/show-polls.php?statocanc=ok');
            exit;
        } else {
            header('Location: http://localhost:8888/exit-poll/show-polls.php?statocanc=ko');
            exit;
        }
       
    }   
        
    }
}