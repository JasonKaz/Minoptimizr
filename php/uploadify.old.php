<?php
require('jsmin.php');

function minifycss( $css ) {
	$css = preg_replace( '#\s+#', ' ', $css );
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );
	$css = str_replace( '; ', ';', $css );
	$css = str_replace( ': ', ':', $css );
	$css = str_replace( ' {', '{', $css );
	$css = str_replace( '{ ', '{', $css );
	$css = str_replace( ', ', ',', $css );
	$css = str_replace( '} ', '}', $css );
	$css = str_replace( ';}', '}', $css );

	return trim( $css );
}

function get_ext($Filename){
    return substr($Filename,strrpos($Filename,'.')+1);
}

function dfs($filesize){
   
    if(is_numeric($filesize)){
    $decr = 1024; $step = 0;
    $prefix = array('Bytes','KB','MB','GB','TB','PB');
       
    while(($filesize / $decr) > 0.9){
        $filesize = $filesize / $decr;
        $step++;
    }
    return round($filesize,2).' '.$prefix[$step];
    } else {

    return 'NaN';
    }
   
}

if (!empty($_FILES)) {
    $Filename=$_FILES['Filedata']['name'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $Filename;
    $FilesizeStart=$_FILES['Filedata']['size'];
    
    $File='../tmp_files/'.$Filename;
	
	$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	$fileTypes  = str_replace(';','|',$fileTypes);
	$typesArray = split('\|',$fileTypes);
	$fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
	move_uploaded_file($tempFile,$targetFile);
    $Content=file_get_contents($File);
    
    switch (get_ext($Filename)){
        case 'js':
        $Content=JSMIN::minify($Content);
        break;
        
        case 'css':
        $Content=minifycss($Content);
        break;
    }
    
    $FileHandle=gzopen($File.'.gz','w9');
    gzwrite($FileHandle,$Content);
    gzclose($FileHandle);
    
    unlink($File);
    
    $FilesizeEnd=filesize($File.'.gz');
    $FilesizePercent=round(100*(1-$FilesizeEnd/$FilesizeStart),2);
    
    echo '{"File":"tmp_files/'.$Filename.'.gz","Filename":"'.$Filename.'","SizeStart":"'.dfs($FilesizeStart).'","SizeEnd":"'.dfs($FilesizeEnd).'","SizeSaved":"'.$FilesizePercent.'"}';
    
	} else {
	   echo 'Invalid file type.';
	}
}
?>