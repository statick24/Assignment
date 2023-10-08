<?php
require_once "autoload.php";

class CreateUserController
{
    private $model;
    private $errors = [];

    public function __construct()
    {
        $this->model = new CreateUserModel;
    }

    private function checkPassword(string $pwd): bool
    {
        /* Check if its at least 10 char */
        if (strlen($pwd) < 10) {
            $this->errors["Password"] = "Password should be at least be 10 characters long";
            return false;
        }

        $num = 0;
        $upper = 0;
        for ($i = 0; $i < strlen($pwd); $i++) {
            $char = substr($pwd, $i, 1);
            /* Check for number */
            if (ctype_digit($char)) {
                $num++;
            }
            /* Check for uppercase */
            if (ctype_upper($char)) {
                $upper++;
            }
        }

        if ($upper == 0) {
            $this->errors["Password"] = "Password must contain at least one upper case character";
            return false;
        }

        if ($num == 0) {
            $this->errors["Password"] = "Password must contain at least one digit";
            return false;
        }

        return true;
    }

    public function handleRequest()
    {
        if(!$this->validate($_POST)){
            $_POST['errors'] = $this->getErrors();
        }else
        {
            $this->model->register($_POST);
            $_POST['success'] = true;
        }
    }

    private function validate(array $data):bool
    {
        $err = 0;
        /* Make sure username is not empty */
        if (empty($data['user'])) {
            $this->errors['Username'] = "Username cannot be empty";
            $err++;
        }
        /* Make sure username is unique*/
        if (!$this->model->checkUser($data['user'])){
            $this->errors['Username'] = "This username is already taken";
            $err++;
        }
        
        /* validate email*/
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = "Email must be in format: name@domain.com";
            $err++;
        }

        /* Validate password */
        if (!($this->checkPassword($data['pwd']))) {
            $err++;
        }

        if ($err != 0) {
            return false;
        }

        return true;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
