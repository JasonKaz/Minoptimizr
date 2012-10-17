<?php
$targetFolder = 'Minoptimizr/tmp_files/'; // Relative to the root
$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
$targetFile = rtrim($targetPath,'/') . '/thefilename';

echo $targetFile;
?>