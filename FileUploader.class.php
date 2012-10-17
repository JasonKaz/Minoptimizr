<?php
/**
 * Created By: Jason Kaczmarsky
 * Date: 2:08 PM 12/13/11
 */

class FileUploader {
    private $Debug, $File, $Data;

    /**
     * FileUploader() - Create an uploader object with debug settings
     * @param bool $Debug
     */
    function __construct($Debug=false){
        $this->Debug=$Debug;

        if ($Debug){
            error_reporting(-1);
            ini_set("display_errors", 1);
        }
    }

    /**
     * upload() - Uploads a file to a destination
     * @param FileData $FileData
     * @param string $Destination
     * @param string|array $AllowedTypes
     * @internal param string $FileInputName
     * @return bool
     */
    function upload(FileData $FileData, $Destination, $AllowedTypes='*'){
        $this->Data=$FileData;

        if ($AllowedTypes!='*'){
            if (!in_array(strtolower(pathinfo($this->Data->get('name'),PATHINFO_EXTENSION)),$AllowedTypes)){
                $this->setError("Cannot use that file type, only ".implode(', ',$AllowedTypes));
                return false;
            }
        }

        if ($this->File['error']==0){
            if (is_uploaded_file($this->Data->get('tmp_name'))){
                if (move_uploaded_file($this->Data->get('tmp_name'),$Destination)){
                    return $this->Data;
                }else{
                    $this->debug($Destination);

                    if (!is_dir(pathinfo($Destination,PATHINFO_DIRNAME))){
                        $Error="Destination folder does not exist";
                        if ($this->Debug)
                            $Error.=' ('.$Destination.')';
                        //$this->setError($Error);
                        echo $Error;
                    }else{
                        echo "Unknown upload error";
                    }

                    return false;
                }
            }else{
                echo "Could not upload file";
                $this->debug($Destination);
                return false;
            }
        }else{
            echo "Error while uploading file";
            $this->debug($Destination);
            return false;
        }
    }

    /**
     * debug() - Prints debug info if needed
     * @param string $Destination
     */
    private function debug($Destination){
        if ($this->Debug){
            var_dump($this->Data);
            echo 'Error uploading file ('.$this->Data->get('name').') to '.$Destination.'<br />'.$this->Data->get('errno').':'.$this->Data->get('error');
        }
    }
}
?>