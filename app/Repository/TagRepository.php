<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-4-22
 * Time: 16:26
 */

namespace App\Repository;


use App\Handlers\IpAddressHandler;
use App\Models\Category;
use App\Models\Tag;
use Prettus\Repository\Eloquent\BaseRepository;

class TagRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }
}