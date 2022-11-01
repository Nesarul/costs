<?php
    class addDecode{
        private $_path,
                $_error;
        public function __construct($address){
            if(substr($address,-4) != ".php"){
                $this->_error = "Invalid Address.";
                die();
            }
            $this->_path = explode('/',substr($address,0,-4));

            // Delete the first item as it is reference the slug.
            array_splice($this->_path,0,2);
        }
        public function getPath(){
            return $this->_path[0];
        }
    }