<?php
class FileData {
    private $File, $FileAttributes=array(
        'name',
        'type',
        'size',
        'tmp_name',
        'error',
        'errno'
    );

    /**
     * load - Loads a file given a file input name
     * @param string $FileInputName
     * @return bool
     */
    function load($FileInputName){
        if ($this->check($FileInputName)){
            $this->File=$FileInputName;
            return true;
        }

        return false;
    }

    public function check($FileInputName){
        return isset($_FILES[$FileInputName]) && $_FILES[$FileInputName]['name']!="";
    }

    /**
     * get() - Gets an uploaded file attribute
     * @param string $AttributeName
     * @return bool|string
     */
    function get($AttributeName){
        if ($this->check($this->File)){
            if (isset($_FILES[$this->File][$AttributeName])){
                if (in_array($AttributeName, $this->FileAttributes)){
                    if ($AttributeName=='error'){
                        return $this->getError($_FILES[$this->File]['error']);
                    }elseif ($AttributeName=='errno'){
                        return $_FILES[$this->File]['error'];
                    }else{
                        return $_FILES[$this->File][$AttributeName];
                    }
                }
            }
        }

        return false;
    }

    /**
     * getError() - Returns info associated with an error number
     * @param int $ErrorNum
     * @return string
     */
    private function getError($ErrorNum){
        switch($ErrorNum){
            case 0:
                return 'There is no error, the file uploaded with success. ';

            case 1:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini. ';

            case 2:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form. ';

            case 3:
                return 'The uploaded file was only partially uploaded. ';

            case 4:
                return 'No file was uploaded. ';

            case 6:
                return 'Missing a temporary folder.';

            case 7:
                return 'Failed to write file to disk.';
                break;

            case 8:
                return 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help. Introduced in PHP 5.2.0. ';
                break;

            default:
                return 'Unknown error';
        }
    }
}
?>