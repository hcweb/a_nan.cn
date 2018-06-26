<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-4-22
 * Time: 16:26
 */

namespace App\Repository;


use App\Handlers\IpAddressHandler;
use App\Models\Comment;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    public function all($columns = ['*'])
    {
        return parent::all($columns);
    }

    public function create(array $attributes)
    {
        $data = array();
        $comment = parent::create([
            'content' => $attributes['content'],
            'visitor' => request()->ip(),
            'city' => IpAddressHandler::getAddress(request()->ip()),
            'member_id' => auth()->guard('member')->user()->id,
            'post_id' => $attributes['cPostId'],
            'parent_id' => !empty($attributes['parentId']) ? $attributes['parentId'] : null
        ]);
        if ($comment) {
            $data = [
                'msg' => '恭喜您评论成功!',
                'success' => true,
                'data' => $comment
            ];
        } else {
            $data = [
                'msg' => '评论失败!',
                'success' => false,
            ];
        }
        return $data;
    }
}