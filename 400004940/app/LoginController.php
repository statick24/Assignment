<?php
require_once "autoload.php";

class LoginController
{
    private $model;
    private $errors = [];

    public function __construct()
    {
        $this->model = new LoginModel();
    }
    private function checkPassword(string $pwd): bool
    {
        /* Check if its at least 10 char */
        if (strlen($pwd) < 10) {
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
         
            return false;
        }

        if ($num == 0) {
            return false;
        }

        return true;
    }

    public function handleRequest()
    {

        // Check if email and password is valid
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $this->checkPassword($_POST['pwd'])) {
            // return record with email
            $data = $this->model->login($_POST['email']);
            //check if record exists
            if (!isset($data['invalid'])) {
                // Check password against hash
                foreach ($data as $index => $rec) {
                    //echo var_dump($data);
                    if (password_verify($_POST['pwd'], $rec['password'])) {
                        //redirect
                        session_start();
                        $_SESSION['user'] = $rec['username'];
                        $_SESSION['email'] = $rec['email'];
                        $_SESSION['role'] = $rec['role'];

                        header('Location: ../app/Dashboard.php');
                    }
                }
            } else {
                $this->errors['Email/Password'] = "Invalid email/password";
                $_POST['errors'] = $this->getErrors();
            }
        } else {
            $this->errors['Email/Password'] = "Invalid email/password";
            $_POST['errors'] = $this->getErrors();
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
