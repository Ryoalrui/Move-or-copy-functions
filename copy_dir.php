<?php
/*遍历某个目录下边的文件，并复制到相对应的新目录*/

function copy_file($src, $dest)
{
    //检查源目录是否存在
    if (!is_dir($src)) {
        return false;
    }
    //检查目标目录是否存在，否则创建
    if (!is_dir($dest)) {
        mkdir($dest, 0777, true);
    }
    //打开目录
    $dh = opendir($src);

    while (($item = readdir($dh))!==false) {
        if ($item != '.' && $item != '..') {
            $srcPath = $src . DIRECTORY_SEPARATOR . $item;
            $destPath = $dest . DIRECTORY_SEPARATOR . $srcPath;
            //如果目录不存在，则创建目录
            //这段是个坑
            if (!is_dir(dirname($destPath))) {
                mkdir(dirname($destPath), 0777, true);
            }
            if (is_file($srcPath)) {
                if (!is_file($destPath)) {
                    if (!copy($srcPath, $destPath)) {
                        return false;
                    }
                }
                //如果是目录，则递归本函数
            } elseif (is_dir($srcPath)) {
                $func = __FUNCTION__;
                $func($srcPath, $dest);
            }
        }
    }

    //关闭目录资源
    closedir($dh);
    //返回
    return true;
}

// var_dump(copy_file('ONE', 'THREE'));
