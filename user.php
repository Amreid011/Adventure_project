<?php
include_once "utils.php";
require_once "db.php";

$db = new DB();
$db->openConnection();

class User {
    private $id,$db;
    public $name,$email,$password,$info,$type,$cash,$dob,$location;
    
    function __construct($userInfo){
        global $db;
        $this->id = isset($userInfo["id"])?$userInfo["id"]:0;
        $this->name = $userInfo["name"];
        $this->email = $userInfo["email"];
        $this->password = $userInfo["password"];
        $this->location = $userInfo["location"];
        $this->info = isset($userInfo["info"])?$userInfo["info"]:"";
        $this->type = $userInfo["type"];
        $this->dob = $userInfo["dob"];
        $this->cash = $userInfo["cash"];
        $this->db =$db;
        $this->iv = substr(hash('sha256', 'your_iv_secret'), 0, 16); // Ensure IV is 16 bytes
    }
    function getId(){
        return $this->id;
    }
    function print_r(){
        echo "'$this->id'";
    }
    function save(){
        if($this->id==0){
            return $this->db->insert("INSERT INTO user(name,email,password,location,info,dob,cash,type) 
            VALUES ('$this->name','$this->email','$this->password','$this->location','$this->info','$this->dob','$this->cash','$this->type')");
        }// '' return string
        return $this->update();
    }
    function update(){
        if($this->id!=0){
            return $this->db->update("UPDATE user SET name = '$this->name',email='$this->email',password='$this->password',
            location='$this->location',info='$this->info',dob='$this->dob',cash='$this->cash'
            WHERE id='$this->id'");
        }
        return $this->save();
    }
    function delete(){
        if($this->id!=0){
            return $this->db->delete("DELETE * FROM user WHERE id='$this->id'");
        }
        return false;
    }
    function hash_password(){
        $this->password = password_hash($this->password,null);
    }

    // function encode_email(){
    //     $this->email = user::base64encode(json_encode($this->email));
    // }
    // function dencode_email(){
    //     $this->email = user::base64decode(json_decode($this->email));
    // }
    // function email_verify($email,$encode){
    //     // $this->email = user::base64decode(json_decode($this->email));
    //     if(user::encode_email($email)==$encode){
    //         return true;
    //     }
    //     return false;
    // }
    // private static function base64encode($input){
    //     return str_replace("=","",strtr(base64_encode($input),"+/","-_"));
    // }
    // private static function base64decode($input){
    //     $reminder = strlen($input)%4;
    //     if ($reminder){
    //         $input .= str_repeat("=",4-$reminder);
    //     }
    //     return base64_decode(strtr($input,"-_","+/"));
    // }
        private $encryptionMethod = 'AES-256-CBC';
        private $secretKey = 'your_secret_key'; // Use a secure key
        private $iv; // Initialization Vector
        public function encode_user() {
            $this->name = $this->encrypt($this->name);
        }
    
        public function decode_user() {
            $this->name = $this->decrypt($this->name);
        }
    
        private function encrypt($input) {
            $encrypted = openssl_encrypt(
                $input,
                $this->encryptionMethod,
                $this->secretKey,
                0,
                $this->iv
            );
            return str_replace("=", "", strtr($encrypted, "+/", "-_")); // Base64 encode the encrypted data for safe storage/transmission
        }
    
        private function decrypt($input) {
            // Undo Base64 replacement to get back to a valid base64 encoded string
            $decodedInput = strtr($input, "-_", "+/") . str_repeat("=", (4 - strlen($input) % 4) % 4); // Add padding for valid base64
            return openssl_decrypt(
                $decodedInput,
                $this->encryptionMethod,
                $this->secretKey,
                0,
                $this->iv
            );
        }
    
        
    
    // // Example usage
    // $user = new User("user@example.com");
    // $user->encode_email(); // Encrypt email
    // echo "Encoded Email: " . $user->getEmail() . "\n";
    
    // $user->decode_email(); // Decrypt email
    // echo "Decoded Email: " . $user->getEmail() . "\n";
    



    function search($search){
        // $search = $this->db->mysqli_escape_string($_GET["search1"]);
        $query = $this->db->select("SELECT * FROM `user` WHERE `user`.`name` LIKE '%".$search."%' OR `user`.`email` LIKE '%".$search."%' ");
        return $query;        

    }
    
    function adminStats(){
        if($this->type=="admin"){
            $admin_count = $this->db->select("SELECT COUNT(*) FROM user WHERE type='admin'");
            $host_count = $this->db->select("SELECT COUNT(*) FROM user WHERE type='host'");
            $traveller_count = $this->db->select("SELECT COUNT(*) FROM user WHERE type='traveller'");
            $user_count = $this->db->select("SELECT COUNT(*) FROM user");
            $hotel_count = $this->db->select("SELECT COUNT(*) FROM real_estate WHERE type='hotel'");
            $competition_count = $this->db->select("SELECT COUNT(*) FROM real_estate WHERE type='competition'");
            $volunter_count = $this->db->select("SELECT COUNT(*) FROM real_estate WHERE type='volunteering'");
            $money_spent = $this->db->select("SELECT SUM(amount) AS total FROM transaction");
            return array($admin_count,$host_count,$traveller_count,$user_count,$hotel_count,$competition_count,$volunter_count,$money_spent);
        }
    }

    // *-*****************Booking Section********************-*
    function viewMyBookings(){
        $bookings = $this->db->select("SELECT b.id,b.enter_date,b.exit_date,r.name,r.rent,b.estate_id,b.status FROM booking b JOIN real_estate r ON r.id=b.estate_id WHERE b.user_id='$this->id' AND status!='Canceled'");
        return $bookings;
    }
    function viewMyEstatesBookings(){
        $bookings = $this->db->select("SELECT b.id,b.status,b.enter_date,b.exit_date,r.id AS estate_id,r.name AS estate_name,r.rent,u.id AS user_id,u.name AS user_name FROM booking b JOIN real_estate r ON r.id=b.estate_id JOIN user u ON u.id=b.user_id WHERE r.owner_id='$this->id'");
        return $bookings;
    }
    function cancelBooking(){
        if($this->id!=0){
            return $this->db->delete("DELETE * FROM user WHERE id='$this->id'");
        }
        return false; 
    }
    function checkBookingValid($estate_id,$user_id,$amount){
        $user =  $this->db->select("SELECT * FROM user WHERE id='$user_id'")[0];
        if($user["cash"]<$amount){
            return false;
        }
        $new_book = $this->db->select("SELECT enter_date FROM booking WHERE estate_id='$estate_id' AND user_id='$user_id'");
        $old_booking = $this->db->select("SELECT exit_date FROM booking WHERE estate_id='$estate_id' AND status='Accepted' ORDER BY createdAt DESC limit 1");
        if(!$old_booking){
            return true;
        }
        if($new_book[0]["enter_date"]>$old_booking[0]["exit_date"]){
            return true;
        }
        return false;
    }
    function handleBookingRequest($booking_id,$user_id,$status,$amount=0){
        $booking = $this->db->update("UPDATE booking SET status='{$status}' WHERE id='$booking_id'");
        if($status=='Accepted'){
            $this->cash -=$amount;
            $this->db->insert("INSERT INTO transaction(booking_id,user_id,amount) VALUES('$booking','$user_id','$amount')");
            $this->save();
        }
        return $booking;
    }
    function createBookingRequest($estate_id,$enter_date,$exit_date){
        $booking = $this->db->insert("INSERT INTO booking(user_id,estate_id,enter_date,exit_date) VALUES('$this->id','$estate_id','$enter_date','$exit_date')");
        return $booking;
    }
    // *-*****************Real Estate Section********************-*
    function explore($type="all"){
        $query = $type==="all"?"SELECT * FROM real_estate ORDER BY RAND()":"SELECT * FROM real_estate WHERE type='{$type}' ORDER BY RAND()";
        $states = $this->db->select($query);
        return $states;
    }
    function viewUserRealEstates($user_id){
        $states = $this->db->select("SELECT * FROM real_estate WHERE owner_id='$user_id'");
        return $states;
    }
    function viewMyRealEstates(){
        $states = $this->db->select("SELECT * FROM real_estate WHERE owner_id='$this->id'");
        return $states;
    }
    function getRealEstate($id){
        $state = $this->db->select("SELECT * FROM real_estate WHERE id='$id'");
        return $state;
    }
    function createRealEstate($data){
        $state = $this->db->insert("INSERT INTO real_estate(`name`,`rent`,`location`,`type`,`image_path`,`description`,`owner_id`)
        VALUES($data,'$this->id')");
        return $state;
    }
    function updateRealEstate($data,$id){
        $state = $this->db->update("UPDATE real_estate SET $data WHERE id='$id'");
        return $state;
    }
    function deleteRealEstate($id){
        $query = "DELETE FROM real_estate WHERE id='$id' AND owner_id='$this->id'";
        if($this->type=="admin"){
            $query = "DELETE FROM real_estate WHERE id='$id'";
        }
        $state = $this->db->delete($query);
        return $this->db->connection->affected_rows>0;
    }
    // *-*****************Review Section******************-*
    function getEstateReviews($id){
        $reviews = $this->db->select("SELECT r.id,r.rate,r.feedback,u.name,r.user_id FROM review r JOIN user u ON u.id=r.user_id WHERE r.estate_id='$id'");
        return $reviews;
    }
    function getReview($id){
        $review = $this->db->select("SELECT * FROM review WHERE id='$id'");
        return $review;
    }
    function createReview($data){
        $review = $this->db->insert("INSERT INTO review(rate,feedback,estate_id,user_id) VALUES($data,'$this->id')");
        return $review;
    }
    function updateReview($data,$id){
        $review = $this->db->update("UPDATE review SET $data WHERE id='$id'");
        return $review;
    }
    function deleteReview($id){
        $query="DELETE FROM review WHERE id='$id' AND user_id='$this->id'";
        if($this->type="admin"){
            $query="DELETE FROM review WHERE id='$id'";
        }
        $review = $this->db->delete($query);
        return $review;
    }
    function calcReviewAvg($id){
        $avg = $this->db->select("SELECT ROUND(AVG(rate),2) AS avg FROM review WHERE estate_id='$id'");
        return $avg[0];
    }
    // *-*****************Favorite Section********************-*
    function getFavorites(){
        $favorites = $this->db->select("SELECT * FROM favorite f JOIN real_estate r ON r.id=f.estate_id WHERE user_id='$this->id'");
        return $favorites;
    }
    function addFavorite($id){
        $favorite = $this->db->insert("INSERT INTO favorite(user_id,estate_id) VALUES('$this->id','$id')");
        return $favorite;
    }
    function deleteFavorite($id){
        $favorite = $this->db->delete("DELETE FROM favorite WHERE estate_id='$id' AND user_id='$this->id'");
        return $favorite;
    }
    function checkFavorite($id){
        $favorite = $this->db->select("SELECT * FROM favorite WHERE estate_id='$id' AND user_id='$this->id'");
        return $favorite;
    }
    // *-*****************Chat Section********************-*
    function getMyChats(){
        $chats = $this->db->select("SELECT id,name FROM user WHERE id!='$this->id'");
        return $chats;
    }
    // function getMyChats(){
    //     $chats = $this->db->select("SELECT ch.id as `chat_id`, u1.id as `user1Id`,u1.name as `user1Name` ,u2.id as `user2Id`,u2.name as `user2Name` FROM chat ch
    //     JOIN user u1 ON u1.id=ch.user_1 JOIN user u2 ON u2.id=ch.user_2 WHERE user_1=$this->id OR user_2=$this->id");
    //     return $chats;
    // }
    function getChatWithUser($user_id){
        $chat = $this->db->select("SELECT * FROM chat WHERE user_1 IN ($user_id,$this->id) AND user_2 IN ($user_id,$this->id)");
        return $chat;
    }
    function getChatMSG($chat_id){
        $messages = $this->db->select("SELECT * FROM message WHERE chat_id={$chat_id}");
        return $messages;
    }

    function createChat($user_2){
        $chat = $this->db->insert("INSERT INTO chat(user_1,user_2) VALUES({$this->id},{$user_2})");
        return $chat;
    }
    function deleteChat($friend_id){
        $chat = $this->db->delete("DELETE FROM chat WHERE user_1={$this->id} AND user_2={$friend_id} OR user_1={$friend_id} AND user_2={$this->id}");
        return $chat;
    }

    function sendMessage($chat_id,$body){
        $msg = $this->db->insert("INSERT INTO message(msg,sender_id,chat_id) VALUES('{$body}',{$this->id},{$chat_id})");
        return $msg;
    }

    static function authenticate($email,$password){
        $user  = User::findByEmail($email);
        if(!$user || !password_verify($password,$user->password) ){
            return false;
        }
        return $user;
    }

    static function findByEmail($email){
        global $db;
        // $db = $db;
        // $db = getDBConnection();
        $user = $db->select("SELECT * FROM `user` WHERE email='{$email}'");
        if($user){
            return new User($user[0]);
        }
        return NULL;
    }

    static function findByID($id){
        global $db;
        // $db = $db;
        // getDBConnection();
        $user = $db->select("SELECT * FROM `user` WHERE id={$id}");
        if($user){
            return new User($user[0]);
        }else{
            return NULL;
        }
    }
    static function deleteByID($id){
        global $db;
        // $db = $db;
        // $db = getDBConnection();
        $deleted = $db->delete("DELETE FROM `user` WHERE id='$id'");
        return $deleted;
    }

}

?>