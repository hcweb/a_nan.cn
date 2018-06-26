<?php

namespace App\Http\Controllers\Common;

use App\Handlers\TranslateHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslateController extends Controller
{
    public function translate($text)
    {
        $result = (new TranslateHandler())->translate($text);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => '翻译成功!',
                'data' => $result
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => '翻译失败!'
            ]);
        }
    }
}
