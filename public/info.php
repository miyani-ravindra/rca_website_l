<?php

try{
define("APP_ROUTES", "images/service/");
if ($handle = opendir(APP_ROUTES)) {
    while (false !== ($entry = readdir($handle))) {
        
        if(pathinfo($entry,PATHINFO_EXTENSION) == "jpeg"){

        	$fileBaseName = str_replace("jpeg", "jpg", pathinfo($entry,PATHINFO_BASENAME));
			if(!rename(APP_ROUTES.$entry, APP_ROUTES.$fileBaseName)){
				echo '<br>Error While Renaming the files';
			}
        }
    }
    closedir($handle);
}else{
	echo 'Path issues';
}

}catch(Exception $e){
	echo $e->getMessage();

}


?>