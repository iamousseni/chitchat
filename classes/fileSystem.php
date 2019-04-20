<?php
    class File{
        /* properties file */
        private $name;
        private $extension;
        private $path;
        private $size;
        private $dateCreated;
        private $lastModified;

        /* methods */
        public function __construct(){
            
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getName(){
            return $this->name;
        }

        public function setExtension($extension){
            $this->extension = $extension;
        }

        public function getExtension(){
            return $this->extension;
        }

        public function setPath($path){
            $this->path = $path;
        }

        public function getPath(){
            return $this->path;
        }

        public function setSize($size){
            $this->size = $size;
        }

        public function getSize(){
            return $this->size;
        }

        public function setDateCreated($dateCreated){
            $this->dateCreated = $dateCreated;
        }

        public function getDateCreated(){
            return $this->dateCreated;
        }

        public function setLastModified($lastModified){
            $this->lastModified = $lastModified;
        }

        public function getLastModified(){
            return $this->lastModified;
        }

        public function uploadFileFromForm($fileName){
            
        }

        

        
    }