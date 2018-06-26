<?php

namespace App\Http\Controllers\Backend;

use App\Models\Data;
use App\Models\Database;
use App\Services\DatabaseService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DatabaseController extends CommonController
{
    protected $databaseService;

    function __construct(DatabaseService $databaseService)
    {
        parent::__construct();
        $this->databaseService = $databaseService;
    }

    /**
     * 数据库备份/还原列表
     * @param null $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($type = null)
    {
        switch ($type) {
            case 'import':
                $lists = $this->databaseService->import_index();
                break;
            case 'export':
                $lists = $this->databaseService->export_index();
                break;
        }
        return view('backend.database.' . $type, compact('lists'));
    }

    /**
     * 备份数据库
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function export(Request $request)
    {
        $tables = $request->get('tables');
        $id = $request->get('id');
        $start = $request->get('start');
        return $this->databaseService->export($tables,$id,$start);
    }

    /**
     * 删除文件
     * @param int $time
     * @return mixed
     */
    public function delFile($time=0)
    {
        return $this->databaseService->delFile($time);
    }

    /**
     * 还原数据库
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request){
        $time = $request->get('time');
        $part = $request->get('part');
        $start = $request->get('start');
        return $this->databaseService->import($time,$part,$start);
    }
}
