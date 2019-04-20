
<?php
function debug(array $array){
    echo '<pre>',var_dump($array),'</pre>';
}

function uploadPhotoToFolder($photoName, $pathFolder, $filename=''){
    if(file_exists($pathFolder)){
        if(isset($_FILES[$photoName]) && is_uploaded_file($_FILES[$photoName]['tmp_name'])){
            $fileTemporalyPath = $_FILES[$photoName]['tmp_name'];
            $fileTemporalyName = $_FILES[$photoName]['name'];

            if(move_uploaded_file($fileTemporalyPath, $pathFolder . $filename)){
                return true;
            }else{
                return [false, 'Error during move upload file'];
            }
        }else{
            return [false, 'Error file doesn\'t uploaded'];
        }
    }else{
        mkdir($pathFolder);
        uploadPhotoToFolder($photoName, $pathFolder, $filename);
    }   
}
?>
