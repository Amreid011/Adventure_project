<?php

include_once "utils.php";
require_once "db.php";

$db = new DB();
$db->openConnection();


abstract class PostAb
{
    abstract public function view($user_id);
    abstract public function create($data);
    abstract public function delete($id);
    abstract public function update($data,$id);
    
}




class Post extends PostAb{
    private $db =$db ,$id;
    public $name,$email,$password,$info,$type,$cash,$dob,$location;



    public function view($user_id){
        $states = $this->db->select("SELECT * FROM real_estate WHERE owner_id='$user_id'");
        return $states;
    }

    public function create($data){
        $state = $this->db->insert("INSERT INTO real_estate(`name`,`rent`,`location`,`type`,`image_path`,`description`,`owner_id`)
        VALUES($data,'$this->id')");
        return $state;
    }

    public function delete($id){
        $query = "DELETE FROM real_estate WHERE id='$id' AND owner_id='$this->id'";
        if($this->type=="admin"){
            $query = "DELETE FROM real_estate WHERE id='$id'";
        }
        $state = $this->db->delete($query);
        return $this->db->connection->affected_rows>0;
    }

    public function update($data,$id){
        $state = $this->db->update("UPDATE real_estate SET $data WHERE id='$id'");
        return $state;
    }
}

?>