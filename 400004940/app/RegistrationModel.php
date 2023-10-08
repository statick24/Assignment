<?php

class RegistrationModel
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

    

    public function register(array $data): bool
    {
        $sql = "INSERT INTO USERS (email, username, password, role)VALUES ('" . $data["email"] . "', '" . $data['user'] . "', '" . password_hash($data['pwd'], PASSWORD_DEFAULT) . "', '" . '3' . "');";
        if ($this->dbcon->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->dbcon->error;
            return false;
        
        }
        $sql1 = "INSERT INTO user_access_levels (email, AccessLevel) VALUES ('" . $data["email"] . "', 'Researcher');";
        if ($this->dbcon->query($sql1) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql1 . "<br>" . $this->dbcon->error;
            return false;
        }
        $this->dbcon->close();

        return true;
    }

    public function checkUser(string $user):bool
    {
        if (empty($user)) {
            $this->errors['User'] = "Username cannot be empty";
        } else {
            $sql = "SELECT * FROM users WHERE username='" . $user . "';";
            $result = $this->dbcon->query($sql);
            if ($result->num_rows > 0) {
                return false;
            }
        }
        return true;
    }
}
