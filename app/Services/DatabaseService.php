<?php
namespace App\Services;

use App\Models\Database;

/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018-6-9
 * Time: 17:32
 */
class DatabaseService
{
    /**
     * 获取导入的文件列表
     * @return array
     */
    public function import_index()
    {
        $lists = array();
        //列出备份文件列表
        $path_tmp = config('app-config.data_backup_path');
        is_dir($path_tmp) || mkdir($path_tmp);
        $path = realpath($path_tmp);
        $flag = \FilesystemIterator::KEY_AS_FILENAME;
        $glob = new \FilesystemIterator($path, $flag);

        foreach ($glob as $name => $file) {
            if (preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)) {
                $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
                $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                $part = $name[6];
                if (isset($lists["{$date} {$time}"])) {
                    $info = $lists["{$date} {$time}"];
                    $info['part'] = max($info['part'], $part);
                    $info['size'] = $info['size'] + $file->getSize();
                } else {
                    $info['part'] = $part;
                    $info['size'] = $file->getSize();
                }
                $extension = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                $info['time'] = strtotime("{$date} {$time}");
                $lists["{$date} {$time}"] = $info;
            }
        }
        return $lists;
    }


    /**
     *获取表列表数据
     * @return static
     */
    public function export_index()
    {
        $list = \DB::select('SHOW TABLE STATUS');
        $result = collect($list);
        $lists = $result->map(function ($items) {
            $item = collect($items)->toArray();
            return array_change_key_case($item);
        });
        return $lists;
    }

    /**
     * 备份数据库
     * @param null $tables
     * @param null $id
     * @param null $start
     * @return \Illuminate\Http\JsonResponse
     */
    public function export($tables, $id, $start)
    {
        if (request()->isMethod('POST') && !empty($tables) && is_array($tables)) { //初始化
            $path = config('app-config.data_backup_path');
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            //读取备份配置
            $config = array(
                'path' => realpath($path) . DIRECTORY_SEPARATOR,
                'part' => config('app-config.data_backup_part_size'),
                'compress' => config('app-config.data_backup_compress'),
                'level' => config('app-config.data_backup_compress_level'),
            );

            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if (is_file($lock)) {
                return response()->json([
                    'code' => -1,
                    'success' => false,
                    'msg' => '检测到有一个备份任务正在执行，请稍后再试！'
                ]);
            } else {
                //创建锁文件
                file_put_contents($lock, request()->server('REQUEST_TIME'));
            }

            //检查备份目录是否可写
            is_writeable($config['path']) || $this->failed('备份目录不存在或不可写，请检查后重试！');
            session(['backup_config' => $config]);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', request()->server('REQUEST_TIME')),
                'part' => 1,
            );
            session(['backup_file' => $file]);

            //缓存要备份的表
            session(['backup_tables' => $tables]);

            //创建备份文件
            $Database = new Database($file, $config);
            if (false !== $Database->create()) {
                $tab = array('id' => 0, 'start' => 0);
                return response()->json([
                    'code' => 1,
                    'success' => true,
                    'msg' => '初始化成功！',
                    'tables' => $tables,
                    'tab' => $tab
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'success' => false,
                    'msg' => '初始化失败，备份文件创建失败！'
                ]);
                //$this->failed('初始化失败，备份文件创建失败！');
            }
        } elseif (request()->isMethod('GET') && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Database = new Database(session('backup_file'), session('backup_config'));
            $start = $Database->backup($tables[$id], $start);
            if (false === $start) { //出错
                //$this->failed('备份出错！');
                return response()->json([
                    'code' => -1,
                    'success' => false,
                    'msg' => '备份出错！'
                ]);
            } elseif (0 === $start) { //下一表
                if (isset($tables[++$id])) {
                    $tab = array('id' => $id, 'start' => 0);
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => '备份完成！',
                        'tab' => $tab
                    ]);
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    //$this->message('备份完成！');
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => '备份完成！'
                    ]);
                }
            } else {
                $tab = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
                return response()->json([
                    'code' => 1,
                    'success' => true,
                    'msg' => "正在备份...({$rate}%)",
                    'tab' => $tab
                ]);
            }

        } else { //出错
            //$this->failed('参数错误！');
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => '参数错误！'
            ]);
        }
    }

    /**
     * 删除备份文件
     * @param int $time
     * @return \Illuminate\Http\JsonResponse
     */
    public function delFile($time = 0)
    {
        if (empty($time)) {
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => '参数错误！'
            ]);
        }
        $name = date('Ymd-His', $time) . '-*.sql*';
        $path = realpath(config('app-config.data_backup_path')) . DIRECTORY_SEPARATOR . $name;
        array_map("unlink", glob($path));
        if (count(glob($path))) {
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => '备份文件删除失败，请检查权限！'
            ]);
        } else {
            return response()->json([
                'code' => 1,
                'success' => true,
                'msg' => '备份文件删除成功！'
            ]);
        }
    }


    /**
     * 优化表
     * @param null $tables
     * @return \Illuminate\Http\JsonResponse
     */
    public function optimize($tables = null)
    {
        if ($tables) {
            if (is_array($tables)) {
                $tables = implode('`,`', $tables);
                $list = \DB::select("OPTIMIZE TABLE `{$tables}`");
                if ($list) {
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "数据表优化完成！"
                    ]);
                } else {
                    return response()->json([
                        'code' => -1,
                        'success' => false,
                        'msg' => "数据表优化出错请重试！"
                    ]);
                }
            } else {
                $list = \DB::select("OPTIMIZE TABLE `{$tables}`");
                if ($list) {
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "数据表'{$tables}'优化完成！"
                    ]);
                } else {
                    return response()->json([
                        'code' => -1,
                        'success' => false,
                        'msg' => "数据表'{$tables}'优化出错请重试！"
                    ]);
                }
            }
        } else {
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => "请指定要优化的表！"
            ]);
        }
    }

    /**
     * 修复表
     * @param null $tables
     * @return \Illuminate\Http\JsonResponse
     */
    public function repair($tables = null)
    {
        if ($tables) {
            if (is_array($tables)) {
                $tables = implode('`,`', $tables);
                $list = \DB::select("REPAIR TABLE `{$tables}`");
                if ($list) {
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "数据表修复完成！"
                    ]);
                } else {
                    return response()->json([
                        'code' => -1,
                        'success' => false,
                        'msg' => "数据表修复出错请重试！"
                    ]);
                }
            } else {
                $list = \DB::select("REPAIR TABLE `{$tables}`");
                if ($list) {
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "数据表'{$tables}'修复完成！"
                    ]);
                } else {
                    return response()->json([
                        'code' => -1,
                        'success' => false,
                        'msg' => "数据表'{$tables}'修复出错请重试！"
                    ]);
                }
            }
        } else {
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => "请指定要修复的表！"
            ]);
        }
    }


    /**
     * 还原数据库
     * @param int $time
     * @param null $part
     * @param null $start
     * @return \Illuminate\Http\JsonResponse
     */
    public function import($time, $part, $start)
    {
        if (is_numeric($time) && is_null($part) && is_null($start)) { //初始化
            //获取备份文件信息
            $name = date('Ymd-His', $time) . '-*.sql*';
            $path = realpath(config('app-config.data_backup_path')) . DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list = array();
            foreach ($files as $name) {
                $basename = basename($name);
                $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);
            //检测文件正确性
            $last = end($list);
            if (count($list) === $last[0]) {
                session(['backup_list' => $list]); //缓存备份列表
                return response()->json([
                    'code' => 1,
                    'success' => true,
                    'msg' => '初始化完成！',
                    'part' => 1,
                    'start' => 0
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'success' => false,
                    'msg' => '备份文件可能已经损坏，请检查！'
                ]);
            }
        } elseif (is_numeric($part) && is_numeric($start)) {
            $list = session('backup_list');
            $db = new Database($list[$part], array(
                'path' => realpath(config('app-config.data_backup_path')) . DIRECTORY_SEPARATOR,
                'compress' => $list[$part][2]));
            $start = $db->import($start);
            if (false === $start) {
                return response()->json([
                    'code' => -1,
                    'success' => false,
                    'msg' => '还原数据出错！'
                ]);
            } elseif (0 === $start) { //下一卷
                if (isset($list[++$part])) {
                    //$data = array('part' => $part, 'start' => 0);
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "正在还原...#{$part}",
                        'part' => $part,
                        'start' => 0
                    ]);
                } else {
                    session('backup_list', null);
                    //$this->success('还原完成！');
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => '还原完成！'
                    ]);
                }
            } else {
                $data = array('part' => $part, 'start' => $start[0]);
                if ($start[1]) {
                    $rate = floor(100 * ($start[0] / $start[1]));
                    //$this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "正在还原...#{$part} ({$rate}%)",
                        'part' => $part,
                        'start' => $start[0]
                    ]);
                } else {
                    //$data['gz'] = 1;
                    //$this->success("正在还原...#{$part}", '', $data);
                    return response()->json([
                        'code' => 1,
                        'success' => true,
                        'msg' => "正在还原...#{$part}",
                        'part' => $part,
                        'start' => $start[0],
                        'gz' => 1
                    ]);
                }
            }
        } else {
            // $this->error('参数错误！');
            return response()->json([
                'code' => -1,
                'success' => false,
                'msg' => '参数错误！'
            ]);
        }
    }
}