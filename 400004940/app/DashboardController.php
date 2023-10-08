<?php
require_once "autoload.php";

class DashboardController
{
    private $model;

    public function __construct()
    {
        $this->model = new DashboardModel();
    }

    public function handleRequest()
    {
        $data = $this->model->getRole();
        foreach ($data as $index => $rec) {
            $_SESSION['role_name'] = $rec['role'];
        }
    } 

}
