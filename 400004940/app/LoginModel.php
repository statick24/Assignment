<?php

class LoginModel
{
    private $dbcon;
    private $errors = [];
    public function __construct()
    {
        $this->dbcon = new mysqli('localhost', 'root', '', 'user_management_system');
        //If connection fails
        if ($this->dbcon->connect_error) {
            die("Connection failed: " . $this->dbcon->connect_error);
        }
    }

    public function login(string $email):array
    {
        $sql = "SELECT * FROM users WHERE email='" . $email . "';";
        $result = $this->dbcon->query($sql);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC))
            { 
                $output[] = $record;
            }
            
        } else {
           $output['invalid'] = 1;
        }
        $this->dbcon->close();
        return $output;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
