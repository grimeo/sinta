<?php

class NewUser{

    private $userData;
    private $errs = [];
    private static $fields = ['firstname', 'lastname', 'age', 'username', 'email', 'password', "confirmPassword"];

    public function __construct($postData){
        $this->userData = $postData;
    }

    public function validateCreateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->userData)){
                trigger_error("'$field' does not exists.");
                return;
            }
        }
        $this->validateFirstname();
        $this->validateLastname();
        $this->validateAge();
        $this->validateUsername();
        $this->validateEmail();
        return array($this->userData, $this->errs);
    }

    private function validateInput($input){
        $input = trim($input);
        $input = htmlspecialchars($input);
        $input = stripslashes($input);
        return  $input;
    }

    private function validateFirstName(){
        $this->userData['firstname'] = $fname = $this->validateInput($this->userData['firstname']);
        if(empty($fname)){
            $this->pushError('firstname', 'Firstname cannot be empty');
        } 
        if(!preg_match('/^[a-zA-Z ]{2,20}$/', $fname)){
            $this->pushError('firstname', 'Firstname should contain any letters from A-Z or a-z with 2-20 characters');
        }
    }

    private function validateLastName(){
        $this->userData['lastname'] = $lname = $this->validateInput($this->userData['lastname']);
        if(empty($lname)){
            $this->pushError('lastname', 'Lastname cannot be empty');
        }
        if(!preg_match('/^[a-zA-Z ]{2,20}$/', $lname)){
            $this->pushError('lastname', 'Lastname should contain any letters from A-Z or a-z with 2-20 characters');
        }
    }

    private function validateUsername(){

        $this->userData['username'] = $username = $this->validateInput($this->userData['username']);
        if(empty($username)){
            $this->pushError('username', 'Username cannot be empty');
        } 

        if(!preg_match('/^[a-zA-Z0-9]{6,20}$/', $username)){
            $this->pushError('username', 'Username must be alphanumeric with 6-20 characters.');
        }
        // if(){
        //     // user exists sa db
        // }
        
    }

    private function validateEmail(){
        $email = trim($this->userData['email']);
        if(empty($email)){
            $this->pushError('email','Email cannot be empty');
        } 
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->pushError('email', 'Invalid email address');
        }
    }

    private function validateAge(){

        $age = trim($this->userData['age']);
        if(empty($age)){
            $this->pushError('age', 'Age cannot be empty');
        }
        if(!preg_match('/^[0-9]{1,2}$/', $age)){
            $this->pushError('age', 'Age must be 1 or 2 digit/s and must be 12 years old or above');
        }
        if($age<=11){
            $this->pushError('age', 'User must be 12 years old or above');
            
        }
    }

    private function validatePassword(){
        $this->userData['password'] = $this->validateInput($this->userData['password']);
        $this->userData['confirmPassword'] = $this->validateInput($this->userData['confirmPassword']);
    }

    private function pushError($key, $err){
        $this->errs[$key] = $err;
    }
}

?>