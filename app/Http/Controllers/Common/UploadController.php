<?php

namespace App\Http\Controllers\Common;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function upload()
    {
        $folder =request()->get('folder') ? request()->get('folder') : 'picture';
        $path = (new ImageUploadHandler())->save(request()->file('file'), $folder, 'site_');
        if ($path) {
            return response()->json([
                'success' => true,
                'message' => '文件上传成功!',
                'data' => [
                    'path' => $path,
                    'fullPath'=>asset($path)
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => '文件上传失败!'
            ]);
        }
    }

    /**
     * 删除指定图片
     */
    public function remove()
    {
        if (file_exists(request()->get('path'))) {
            if (unlink(request()->get('path'))) {
                return response()->json([
                    'success' => true,
                    'message' => '文件删除成功!',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => '文件删除失败!',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => '文件不存在!',
            ]);
        }
    }
}
