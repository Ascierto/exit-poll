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

    protected static function sanitize($fields)
    {
        
        $fields['name_poll'] = self::cleanInput($fields['name_poll']);

        $fields['description'] = self::cleanInput($fields['description']);
     

        return $fields;
    }

    public static function insertPoll($form_data){

        $form_data= array(
            'name_poll'=>$form_data['name_poll'],
            'description'=>$form_data['description']
        );

        $form_data= self::sanitize($form_data);

        $db=connect();

        $query = $db->prepare("INSERT INTO polls(name_poll,description) VALUES (?,?) ");
        $query->bind_param('ss',$form_data['name_poll'],$form_data['description']);
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

    public static function showPoll($data=null){

        $db=connect();

        if (isset($data['id'])) {
            $data['id'] = intval($data['id']);
            $query      = $db->prepare('SELECT * FROM polls WHERE polls.id = ?');
            $query->bind_param('i', $data['id'],);
            $query->execute();
            $query = $query->get_result();
        } else {
            $query = $db->query('SELECT * FROM polls');
        }

        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;

    }
}