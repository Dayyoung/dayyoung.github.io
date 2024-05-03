<?php


//파일의 확장자 알아오기
function getExt($file){
        $needle = strrpos($file, ".") + 1;
        $slice = substr($file, $needle);
        $ext = strtolower($slice);
        return $ext;
}

//파일 업로드
function fileSave($path,$filename,$savefile){
        copy($filename,$path.$savefile);
        return $savefile;
}

?> 
