<?php
$_REQUEST['folders_to_include']=['app/functions/','tests/controllers/'];
function getAll(bool $find=true){
	require_once('vendor/autoload.php');
	foreach($_REQUEST['folders_to_include'] as $folder){scanFolderRequires($folder,$find);}
}
function scanFolderRequires(string $folder,bool $find=false){
	$scan=scandir($folder);
	unset($scan[0],$scan[1]);
	if(count($scan)>0){
		foreach ($scan as $value){
			$info= pathinfo($folder.$value);
			$dir= is_dir($folder.$value);
			if($dir==true and $info['basename']!='..' and $info['basename']!='.'){
				ScanFolderRequires($folder.$info['basename'].'/',$find);
			}
			else{
				if($info['extension']=='php'){
					$add=true;
					if($find!=false){$add=($info['basename']==$find)?true:false;}
					($add==true)?require_once($folder.$info['basename']):'';
					if($add==true and $find!=false){break;}
				}
			}
		}
	}
}
function autoloadConversor(string $find){
	scanFolderRequires($find);
}
getAll();
