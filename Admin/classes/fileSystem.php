<?php
class Directorys{
    /* properties */
    private $nameDirectory;
    private $pathDirectory;

    /* methods */
    public function __construct($nameDirectory, $pathDirectory){
        $this->setNameDirectory($nameDirectory);
        $this->setPathDirectory($pathDirectory);
    }

    public function setNameDirectory($nameDirectory){
        $this->nameDirectory = $nameDirectory;
    }

    public function getNameDirectory(){
        return $this->nameDirectory;
    }

    public function setPathDirectory($pathDirectory){
        $this->pathDirectory = $pathDirectory;
    }

    public function getPathDirectory(){
        return $this->pathDirectory;
    }
}

class File extends Directorys{
    /* properties */
    private $nameFile;
    private $pathFile;

    /* methods */
    public function __construct($nameFile, $pathFile){
        $this->setNameFile($nameFile);
        $this->setPathFile($pathFile);
    }

    public function setNameFile($nameFile){
        $this->nameFile = $nameFile;
    }

    public function getNameFile(){
        return $this->nameFile;
    }

    public function setPathFile($pathFile){
        $this->pathFile = $pathFile;
    }

    public function getPathFile($pathFile){
        return $this->pathFile;
    }
}

class FileSystem extends File{

    public function __construct(){

    }
    
    public function createFile($name, $path, $content=''){
        $this->setNameFile($name);
        $this->setPathFile($path);
        
        $file = fopen($this->getNameFile(), 'w', $this->getPathFile());
        if(fwrite($file, $content)){
            fclose($file);
            return true;
        }else{
            return false;
        }
    }

    public function writeIntoFile($name, $path, $content, $mode='a'){
        $file = fopen($this->getNameFile(), $mode, $this->getPathFile());
        if(fwrite($file, $content)){
            fclose($file);
            return true;
        }else{
            return false;
        }

    }

    public function removeFile($name, $path){
        if(unlink($this->getPathFile())){
            return true;
        }else{
            return false;
        }
    }

    public function createDirectory($name, $path){
        $this->setNameDirectory($name);
        $this->setPathDirectory($path);
        
        if(!file_exists($this->getPathDirectory()) && mkdir($this->getPathDirectory())){
            return true;
        }else{
            return false;
        }
    }

    function removeDirectory($dirPath) {
        if(is_dir($dirPath)) {
            //get list of file and directory into $dirPath
          $objects = scandir($dirPath);
          foreach ($objects as $object) {
            if($object != "." && $object != "..") {
              if(filetype($dirPath."/".$object) == "dir") 
                removeDirectory($dirPath."/".$object);
            else 
                unlink($dirPath."/".$object);
            }
          }
          //return to the first element of array
          reset($objects);
          return rmdir($dirPath) ? true : false;
        }
     } 

    public function uploadFileFromForm($inputFileName, $pathUploadDirectory, $fileName=null, $isImage = true){
        // verifico che il file sia stato effettivamente caricato
        if (!isset($_FILES[$inputFileName]) || !is_uploaded_file($_FILES[$inputFileName]['tmp_name'])) {
            return [false, 'Non hai inviato nessun file.'];
        }

        //Recupero il percorso temporaneo del file
        $userfile_tmp = $_FILES[$inputFileName]['tmp_name'];

        //verifico che sia un immagine
        if($isImage === true){
            if(!getimagesize($userfile_tmp)){
                return [false, 'IL file che si desidera caricare non è un immagine'];
            }else{
                $extensionAllowed = ['gif','jpg','jpe','jpeg','png'];
                $tmpExtension = explode('.', $_FILES[$inputFileName]['name']);
                $tmpExtension = end($tmpExtension);
                if(!in_array($tmpExtension, $extensionAllowed)){
                    return [false, 'Estensione non ammessa'];
                }else{
                    //limito la dimensione dell'immagine a 4MB per questioni di gestione
                    if($_FILES[$inputFileName]['size'] > 4194304){
                        return [false, 'Dimensione immagine superiore a 4MB'];
                    }
                }
            }
        }
        
        //recupero il nome originale del file caricato
        if($fileName === null)
            $userfile_name = $_FILES[$inputFileName]['name'];
        else
            $userfile_name = $fileName.'.'.$tmpExtension;

        //copio il file dalla sua posizione temporanea alla mia cartella upload
        if (move_uploaded_file($userfile_tmp, $pathUploadDirectory . '/' . $userfile_name)) {
            return [true, $pathUploadDirectory . '/' . $userfile_name];
        }else{
            return [false, 'Operazione fallita'];
        }
    }
}
?>