<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-3-11
 * Time: 19:16
 */

namespace App\Handlers;


class ImageUploadHandler
{
    //允许上传的图片图片类型
    protected $allow_ext = ["png", "jpg", "gif", 'jpeg'];

    /**
     * @param $file 文件名
     * @param $folder 文件夹名称
     * @param $file_prefix 文件后缀
     * @return bool|string
     */
    public function save($file, $folder, $file_prefix)
    {
        //存储文件规则
        $folderName = "uploads/images/$folder/" . date("Ym", time()) . '/' . date("d", time()) . '/';
        //文件路径
        $filePath = public_path() . '/' . $folderName;

        //获取图片后缀
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //拼接文件名
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        //判断是不是允许上传的文件类型
        if (!in_array($extension, $this->allow_ext)) {
            return false;
        }

        //把文件移动到指定文件夹
        $file->move($filePath, $filename);

        //返回文件路径
        return $folderName . $filename;
    }

}