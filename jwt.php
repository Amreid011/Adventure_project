<?php
    // only use HS256
    // but can be edited to use other algorithms like HS384,HS512
    class JWT{
        /**
         * @param array $payload
         * @param string $key
         */
        public static function encode($payload){
            $header = array("typ"=>"JWT","alg"=>"HS256");
            $payload["exp"] = time() + 12 * 60 * 60;
            $segments = array();
            $segments[] = JWT::base64encode(json_encode($header));
            $segments[] = JWT::base64encode(json_encode($payload));
            $toSign = implode(".",$segments);
            $signed = JWT::sign($toSign,getenv("SECERT_TOKEN"));
            $segments[] = JWT::base64encode($signed);
            return implode(".",$segments);
        }
        public static function decode($jwt){
            $tks = explode(".",$jwt);
            if (count($tks)!=3){
                throw new UnexpectedValueException("Invalid jwt");
            }
            list($head,$payload,$signature) = $tks;
            if (false === ($head = json_decode(JWT::base64decode($head)))) {
                throw new UnexpectedValueException('Invalid segment encoding');
            }
            if (false === $payload = json_decode(JWT::base64decode($payload))) {
                throw new UnexpectedValueException('Invalid segment encoding');
            }
            $sig = JWT::base64decode($signature);
            if(empty($head->alg)){
                throw new DomainException("invalid algo");
            }
            if($sig!=JWT::sign(implode(".",array_slice($tks,0,2)),getenv("SECERT_TOKEN"))){
                throw new UnexpectedValueException("invalid signature");
            }
            // time
            return $payload;
        }
        
        private static function sign($data,$key){
            return hash_hmac("sha256",$data,$key,true);
        }
        private static function base64encode($input){
            return str_replace("=","",strtr(base64_encode($input),"+/","-_"));
        }
        private static function base64decode($input){
            $reminder = strlen($input)%4;
            if ($reminder){
                $input .= str_repeat("=",4-$reminder);
            }
            return base64_decode(strtr($input,"-_","+/"));
        }
        private static function hasTimePassed($timestamp) {
            $dateFromTimestamp = date('Y-m-d H:i:s', $timestamp);
            $currentDate = date('Y-m-d H:i:s');
            return $dateFromTimestamp < $currentDate;
        }
    }

?>