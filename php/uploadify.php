<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

$Options=json_decode(get_magic_quotes_gpc()?stripslashes($_POST['options']):$_POST['options'], true);

//Set values for options for CSS minifier
$CSSFilters=array();
$CSSFilters['RemoveComments']           = $Options['css_comments'];
$CSSFilters['RemoveEmptyRulesets']      = $Options['css_emptyrulesets'];
$CSSFilters['RemoveEmptyAtBlocks']      = $Options['css_emptyats'];
$CSSFilters['ConvertLevel3Properties']  = $Options['css_browserconvert'];

$CSSPlugins=array();
$CSSPlugins['ConvertFontWeight']        = $Options['css_font'];
$CSSPlugins['ConvertHslColors']         = $Options['css_convertcolors'];
$CSSPlugins['ConvertRgbColors']         = $Options['css_convertcolors'];
$CSSPlugins['ConvertNamedColors']       = $Options['css_convertcolors'];
$CSSPlugins['CompressColorValues']      = $Options['css_compresscolors'];

// Define a destination
$targetFolder = '/apps/minoptimizr/tmp_files/'; // Relative to the root

//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$ReturnData=array('error'=>false);
if (!empty($_FILES)/* && $_POST['token'] == $verifyToken*/) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('js', 'css'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		if (move_uploaded_file($tempFile, $targetFile)){
            clearstatcache();
            $ReturnData['filename']=$fileParts['basename'];
            $ReturnData['start_size']=filesize($targetFile);
            $Content=file_get_contents($targetFile);

            if ($fileParts['extension']=='js'){
                require_once('JSMin.php');
                file_put_contents($targetFile, JSMin::minify($Content));
            }elseif($fileParts['extension']=='css'){
                require_once('CSSMin.php');
                file_put_contents($targetFile, CssMin::minify($Content, $CSSFilters, $CSSPlugins));
            }

            clearstatcache();
            $ReturnData['end_size']=filesize($targetFile);
        }else{
            $ReturnData['error']=true;
            $ReturnData['error_msg']='Could not move uploaded file';
        }
	} else {
		$ReturnData['error']=true;
        $ReturnData['error_msg']='Invalid file type';
	}
}else{
    $ReturnData['error']=true;
    $ReturnData['error_msg']='No file uploaded';
}

echo json_encode($ReturnData);
?>