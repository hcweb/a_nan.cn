<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/2/1
 * Time: 9:50
 */
if (!function_exists('getTree')) {
    /**
     * 递归获取分类树
     * @param $data
     * @param int $parent_id
     * @param int $level
     * @return array
     */
    function getTree($data, $parent_id = 0, $level = 0)
    {
        static $newData = array();
        foreach ($data as $k => $v) {
            if ($v['parent_id'] === $parent_id) {
                $v['level'] = $level;
                $newData[] = $v;
                getTree($data, $v['id'], $level + 1);
            }
        }
        return $newData;
    }
}

if (!function_exists('getSelectData')) {
    /**
     * 获取select下拉数据
     * @param $data
     * @return array
     */
    function getSelectData($data)
    {
        static $newItemKey = array('0');
        static $newItemValue = array('顶级栏目');
        foreach ($data as $key => $value) {
            array_push($newItemKey, $data[$key]->id);
            array_push($newItemValue, str_repeat('-', $data[$key]->level * 5) . str_repeat('-', $data[$key]->level * 5) . $data[$key]->title);
        }
        return array_combine($newItemKey, $newItemValue);
    }
}

if (!function_exists('make_tree_menu')) {
    /**
     * 树形菜单
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    function make_tree_menu($list, $pk = 'id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        $tree = array();
        $packData = array();
        foreach ($list as $data) {
            $packData[$data[$pk]] = $data;
        }
        foreach ($packData as $key => $val) {
            if ($val[$pid] == $root) {   //代表跟节点
                $tree[] =& $packData[$key];
            } else {
                //找到其父类
                $packData[$val[$pid]][$child][] =& $packData[$key];
            }
        }
        return $tree;
    }
}

if (!function_exists('getMenuNameById')) {
    /**
     * 根据id获取后台菜单名称
     * @param $id
     * @return mixed
     */
    function getMenuNameById($id)
    {
        return \App\Models\Menu::where('id', $id)->value('title');
    }
}

if (!function_exists('getBreadcrumbs')) {
    /**
     * @param $cid
     * @param array $result
     * @return array
     */
    function getBreadcrumbs($cid, &$result = array())
    {
        $data = \App\Models\Menu::where('id', $cid)->get()->toArray();
        if ($data) {
            $result[] = $data[0];
            getBreadcrumbs($data[0]['parent_id'], $result);
        }
        krsort($result);
        return $result;
    }
}

if (!function_exists('displayBreadcrumbs')) {
    /**
     * 显示面包屑导航
     * @return array
     */
    function displayBreadcrumbs()
    {
        //获取数据

        $URL = $currentUrl = request()->getRequestUri();
        $rouName = explode('/', substr($currentUrl,1));
        if (!str_contains($currentUrl, "index")) {
            $URL = $rouName[0] . '.' . 'index';
        }
        if ($URL) {
            $breadcrumb = \App\Models\Menu::where('route', $URL)->get()->toArray();
            //重新赋值
            static $result = array();
            if ($breadcrumb) {
                foreach ($breadcrumb as $value) {
                    $result[] = getBreadcrumbs($value['id']);
                }
            }
            switch (end($rouName)) {
                case 'edit':
                    array_push($result[0], ['title' => '编辑', 'route' => 'javascript:;']);
                    break;
                case 'create':
                    array_push($result[0], ['title' => '创建', 'route' => 'javascript:;']);
                    break;
                case 'show':
                    array_push($result[0], ['title' => '详情', 'route' => 'javascript:;']);
                    break;
                case 'search':
                    array_push($result[0], ['title' => '搜索结果', 'route' => 'javascript:;']);
                    break;
            }
            return $result[0];
        } else {
            die('路由信息错误,请检查您所配置的信息!');
        }

    }
}

if (!function_exists('getNowRequestUrl')) {
    /**
     * @param $route
     * @return string
     * @throws Exception
     */
    function getNowRequestUrl($route)
    {
        if (str_contains($route, '.')) {
            $routeName = explode('.', $route);
            $routeResult = $routeName[0];
        } else {
            $routeResult = $route;
        }
        return str_replace('/', '', Route::getCurrentRoute()->getPrefix()) . '/' . $routeResult . '*';
    }
}

if (!function_exists('getRequestRouteNames')) {

    /**
     * 获取所有数组的路由名称
     * @param array $array
     * @return bool
     */
    function getRequestRouteNames($array = [])
    {
        if (is_array($array) && count($array) > 0) {
            $collect = collect($array);
            $pluck = $collect->pluck('route');
            $routeName = Route::currentRouteName();
            $routePrefix = Route::getCurrentRoute()->getPrefix();
            $requestUrls = [];
            foreach ($pluck->all() as $v) {
                $rName = explode('.', $v);
                array_push($requestUrls, str_replace('/', '', $routePrefix) . '/' . $rName[0] . '*');
            }
            if (in_array(getNowRequestUrl($routeName), $requestUrls)) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('block')) {

    /**
     * 获取资料信息
     * @param $id
     * @return mixed
     */
    function block($id)
    {
        $result=\App\Models\Block::where('id',$id)->value('body');
        if (!empty($result)){
            return $result;
        }
        return null;
    }
}

if (!function_exists('format_bytes')) {
    /**
     * 格式化字节大小
     * @param $size
     * @param string $delimiter
     * @return string
     */
    function format_bytes($size, $delimiter = '') {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
}



