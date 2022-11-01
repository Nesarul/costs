<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/admin/addDecode.php";
    class getSlug{
        private $_slug = null,
                $_address = null,
                $_results = null;

        public function __construct(){
            $add = new addDecode($_SERVER['REQUEST_URI']);
            $this->_address = $add->getPath();
            $this::generateResults();
        }
    
        public function getResults(){
            return $this->_results; 
        }

        private function generateResults(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://51.68.206.144:8002/nftpage/" . $this->_address,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),));

            $this->_results = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
    };