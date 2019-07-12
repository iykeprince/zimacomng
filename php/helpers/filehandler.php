<?php
class filehandler {
    private $filenames = array();
    private $success = array();
    private $name;
    private $size;
    private $type;
    private $file;
    private $tempFile;
    private $maxFileSize;
    private $minFileSize;
    private $directory;
    private $errors = []; 
    private $error;
    private $numFiles;
    private $customName;
    
    public function __construct($file, $numFiles){
        $this->file = $file;
        $this->numFiles = $numFiles;
    }
    public function uploadMultipleFile(){
        $this->createPath($this->directory);
        for ($i=0; $i < $this->numFiles; $i++) {
            if($this->getTempFile()[$i] != ""){
                $this->setFilenames($this->directory.time().'_'.$this->getName()[$i] );         
                if(move_uploaded_file($this->getTempFile()[$i], $this->getFilenames()[$i] )){
                   return true;
                }else{
                    return $this->getFileError()[$i];
                }
            }
        }
    }
    public function uploadFile(){
        if($this->numFiles > 1){
            $this->uploadMultipleFile();
        }else{
            $this->createPath($this->directory);
            $extension = pathinfo($this->getName(), PATHINFO_EXTENSION);
            $this->setFilenames($this->directory.'_'.$this->getCustomName().".$extension" );
          
            if(move_uploaded_file($this->getTempFile(), $this->getFilenames()[0] )){
                return "success";
            }else{
                return "fail";
            }
        }

    }

    // created compressed JPEG file from source file
    public static function compressImage($source_image, $compress_image) {
        $image_info = getimagesize($source_image);
        if ($image_info['mime'] == 'image/jpeg') {
            $source_image = imagecreatefromjpeg($source_image);
            imagejpeg($source_image, $compress_image, 75);
        } elseif ($image_info['mime'] == 'image/gif') {
            $source_image = imagecreatefromgif($source_image);
            imagegif($source_image, $compress_image, 75);
        } elseif ($image_info['mime'] == 'image/png') {
            $source_image = imagecreatefrompng($source_image);
            imagepng($source_image, $compress_image, 6);
        }
        return $compress_image;
    }
    public function createPath(){
        if(!file_exists($this->directory)){
            mkdir($this->directory, 0777,true);
        }
    }
    public function deleteFile(){

    }

    public function setMaxFileSize($size = 5000000){//about 50MB Default
        $this->maxFileSize = $size;
    }
    public function setMinFileSize($size){
        $this->minFileSize = $size;
    }
    public function setDirectory($directory){
        $this->directory = $directory;
    }
    public function getMaxFileSize(){
        return $this->maxFileSize;
    }
    
    public function validateImageWithAllowedExt( $allowedExt = []){
        if($this->numFiles > 1){
            for ($i=0; $i < $this->numFiles; $i++) { 
                # code...
                $extension = pathinfo($this->getName()[$i], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                if(in_array($extension, $allowedExt)){
                    return true;
                }else{
                    return false;
                }
            }
        }else{
            $extension = pathinfo($this->getName(), PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if(in_array($extension, $allowedExt)){
                return true;
            }else{
                return false;
            }
        }
        
    }
    
    public function setCustomName($name){
        $this->customName = $name;
    }
    public function setFilenames($filename){

       array_push($this->filenames, $filename);
    }
    public function getCustomName(){
        return $this->customName;
    }
    public function getFilenames(){
        return $this->filenames;
    }
    public function getName(){
        return $this->file['name'];
    }
    public function getSize(){
        return $this->file['size'];
    }
    public function getType(){
        return $this->file['type'];
    }
    public function getTempFile(){
        return $this->file['tmp_name'];
    }
    public function getDirectory(){
        return $this->directory;
    }
    public function getErrors(){
        return $this->errors;
    }
    public function getFileError(){
        return $this->file['error'];
    }

}