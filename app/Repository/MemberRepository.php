<?php

/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-1-28
 * Time: 21:47
 */

namespace App\Repository;


use App\Models\Member;
use Prettus\Repository\Eloquent\BaseRepository;

class MemberRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Member::class;
    }
}