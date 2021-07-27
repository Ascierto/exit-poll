<?php
namespace ExitPoll;

include __DIR__ . '/globals.php';


use Mysqli;

class Users
{
    public static function cleanInput($input)
    {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_ADD_SLASHES);
        $input = filter_var($input, FILTER_SANITIZE_SPECIAL_CHARS);
        return $input;
    }

    public static function isEmailAddressValid($email_address)
    {
        return filter_var($email_address, FILTER_VALIDATE_EMAIL);
    }
    
    protected static function sanitize($fields)
    {
        if (isset($fields['email']) && $fields['email'] !== '') {
            $fields['email'] = self::cleanInput($fields['email']);
            if (! self::isEmailAddressValid($fields['email'])) {
                $errors[] = new \Exception('Indirizzo email non valido.');
            }
        }
    
        return $fields;
    }
    
    public static function registerUser($form_data)
    {

        $fields = array(
        'name'        => $form_data['name'],
        'surname'        => $form_data['surname'],
        'email'        => $form_data['email'],
        'password'        => $form_data['password'],
        'password-check'  => $form_data['password-check']
        );


        $fields = self::sanitize($fields);
        
        if ($fields['password'] !== $fields['password-check']) {
            
            header('Location: http://localhost:8888/exit-poll/register.php?stato=errore&messages=Le password non corrispondono');
            exit;
            
        }
        
        $db=connect();
        
        $query_user = $db->query("SELECT email FROM users WHERE email = '" . $fields['email'] . "'");
        
        if ($query_user->num_rows > 0) {
            header('Location: http://localhost:8888/exit-poll/register.php?stato=errore&messages=Email già presente');
            exit;
        }
        
        $query_user->close();
        
        $query = $db->prepare('INSERT INTO users(name,surname,email, password) VALUES (?,?,?, MD5(?))');
        $query->bind_param('ssss', $fields['name'], $fields['surname'], $fields['email'], $fields['password']);
        $query->execute();
        
        if ($query->affected_rows === 0) {
            error_log('Error MySQL: ' . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/exit-poll/register.php?stato=ko');
            exit;
        }
        
        header('Location: http://localhost:8888/exit-poll/login.php?stato=ok');
        exit;
    }

    public static function loginUser($form_data)
    {
        $fields = array(
            'email'  => $form_data['email'],
            'password'  => $form_data['password']
            );
    
            $fields=self::sanitize($fields);
    
            $db=connect();
    
            $query_user = $db->query("SELECT * FROM users WHERE email = '" . $fields['email'] . "'");
    
            if ($query_user->num_rows === 0) {
                header('Location: http://localhost:8888/exit-poll/login.php?stato=errore&messages=Utente non presente');
                exit;
            }
    
            $user = $query_user->fetch_assoc();
    
            if ($user['password'] !== md5($fields['password'])) {
                header('Location: http://localhost:8888/exit-poll/login.php?stato=errore&messages=Password errata');
                exit;
            }
    
            return array(
            'id'  => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'surname'=>$user['surname'],
            'is_admin'=>$user['is_admin']
            );

    }
    

}