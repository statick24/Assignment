<?php 
class DashboardModel 
{
    private $dbcon;
    public function __construct()
    {
        $this->dbcon = new mysqli('localhost', 'root', '', 'user_management_system');
        //If connection fails
        if ($this->dbcon->connect_error) {
            die("Connection failed: " . $this->dbcon->connect_error);
        }
    }

    public function getRole()
    {
        /* Make sure role is correct */
        $sql="SELECT role FROM users WHERE username='". $_SESSION['user']."';";
        $result = $this->dbcon->query($sql);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC))
            { 
               $_SESSION['role'] = $record['role'];
            }
        } 
        $sql = "SELECT role FROM roles WHERE id=" . $_SESSION['role'] . ";";
        /* Get role name */
        $result = $this->dbcon->query($sql);
        if ($result->num_rows > 0) {
            while ($record = $result->fetch_array(MYSQLI_ASSOC))
            { 
                $out[] = $record;
            }
        } 
        $this->dbcon->close();
        return $out;
    }
}
?>