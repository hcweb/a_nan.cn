<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-4-10
 * Time: 23:51
 */

namespace App\Api\Controllers;

use App\Api\Transformers\PostTransformer;
use App\Models\Post;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use Helpers;

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(){
        return $this->response->collection(Post::all(),new PostTransformer());
    }
}