<?php
class DB{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "project_soft";
    public $connection;


    public function openConnection(){
        if(!$this->connection){
            $this->connection = new mysqli($this->dbHost,$this->dbUser,$this->dbPassword,$this->dbName);
            if($this->connection->connect_error){
                echo "Error In Connection: ",$this->connection->connect_error;
                return false;
            }
            else
            {
                return true;
            }
        }
    }


    public function closeConnection(){
        if($this->connection){
            $this->connection->close();
        }else{
            echo "Connection Is Not Open";
        }
    }
    public function getConnection(){
        if(!$this->connection){
            echo "Connection Is Not Open";
            echo "Opening Connection";
            $this->openConnection();
        }
        return $this->connection;
    }
    public function select($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error : ".mysqli_error($this->connection);
            return NULL;
        }
        if($result->num_rows==0){
            return NULL;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function insert($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error : ".mysqli_error($this->connection);
            return NULL;
        }
        return $this->connection->insert_id;
    }
    public function update($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        return true;
    }
    public function delete($query){
        $result = $this->connection->query($query);
        if($result!==TRUE){
            echo "Error : ".mysqli_error($this->connection);
            return false;
        }
        return $result;
    }
}

// $db = new DB();
// $db->openConnection();
// return $db;
?>