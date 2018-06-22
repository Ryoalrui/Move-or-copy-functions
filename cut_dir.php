<?php
/*将某个目录下边的所有文件，连同文件夹本身剪切到相对应的新目录*/
//本质是文件夹的移动操作；

header('content-type:text/html;charset=UTF-8');
function cut_D(string $oldpath, string $newpath)
{
    if (!is_dir($oldpath)) {
        return false;
    }
    if (!is_dir($newpath)) {
        mkdir($newpath, 0777, true);
    }
    $checkspath=$newpath.DIRECTORY_SEPARATOR.basename($oldpath);
    if (is_dir($checkspath)) {
        return false;
    }
    if (rename($oldpath, $checkspath)) {//checkpath，不是newpath
        return true;
    }
    return false;
}
