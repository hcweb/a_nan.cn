<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;

class UserController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        //dd();
        // $this->middleware(['role:admin','permission:user_index|user_create|user_edit|user_destroy|user_update'])->except('login','layout','loginForm');
    }

    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(15);
        return view('backend.user.index', compact('users'));
    }

    /**
     * @des 用户登录界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
//        User::create([
//            'name'=>'hcweb',
//            'email'=>'871328529@qq.com',
//            'password'=>bcrypt('xtn123')
//        ]);
        return view('backend.user.login');
    }


    /**
     * @des 用户登录表单验证信息
     * @param UserLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function loginForm(UserLoginRequest $request)
    {
        //是否是记住密码
        if ($request->rember_me) {
            $is_rember = true;
        } else {
            $is_rember = false;
        }
        if (\Auth::attempt(['email' => trim($request->email), 'password' => trim($request->password)], $is_rember)) {
            if (\Auth::user()->is_enabled != 1) {
                return back()->withErrors('尊敬的' . \Auth::user()->name . '您的账户目前处理禁用状态,请联系管理员开启！')->withInput();
            }
            //把信息存入session中
            session([
                'userInfo' => \Auth::user()
            ]);
            alert()->success(\Auth::user()->name . '欢迎回来！', '提示信息');
            return redirect()->route('home');
        } else {
            return back()->withErrors("用户名或密码错误")->withInput();
        }
    }

    /**
     * @des 退出系统
     * @return \Illuminate\Http\RedirectResponse
     */
    public function layout()
    {
        \Auth::logout();
        return redirect()->route('login');
    }


    /**
     * 创建页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->getRoles();
        return view('backend.user.create', compact('roles'));
    }

    /**
     * 保存用户信息
     * @param UserRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        try {
            \DB::transaction(function () use ($request) {
                $request->merge(['password' => bcrypt($request->get('password'))]);
                //保存用户
                $user = User::create($request->except('role'));
                //给用户赋予角色
                $user->assignRole($request->get('role'));
            });
            alert()->success('用户添加成功！');
            return redirect()->route('user.index');
        } catch (QueryException $exception) {
            alert()->error('用户添加失败！');
            return back()->withInput();
        }
    }

    /**
     * 用户详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->getUserById($id);
        $user->getAliasByRoleName('admin');
        return view('backend.user.show', compact('user'));
    }

    /**
     * 编辑用户
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = $this->getRoles();
        return view('backend.user.edit', compact('user', 'roles'));
    }


    /**
     * 更新用户
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->getUserById($id);

        if ($request->get('password') != '0|0|0|0') {
            $request->merge(['password' => bcrypt($request->get('password'))]);
            $data = $request->except('imgUrl', 'role');
        } else {
            $data = $request->except('imgUrl', 'role', 'password');
        }

        //更新用户
        if ($user->update($data)) {
            //先撤销当前的权限
            foreach ($user->getRoleNames() as $v) {
                $user->removeRole($v);
            }
            //给用户赋予角色
            $user->assignRole($request->get('role'));
            alert()->success('用户更新成功！');
            return redirect()->route('user.index');
        } else {
            alert()->error('用户更新失败！');
            return redirect()->back();
        }
    }

    /**
     * 删除用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (str_contains($id, ',')) {
            $id = explode(',', $id);
        }
        $result = User::destroy($id);
        if ($result) {
            $data = [
                'msg' => '删除成功!',
                'success' => true
            ];
        } else {
            $data = [
                'msg' => '删除失败!',
                'success' => false
            ];
        }
        return response()->json($data);
    }

    /**
     * 获去所有角色
     * @return mixed
     */
    private function getRoles()
    {
        $roles=Role::orderBy('id', 'asc')->pluck('alias', 'name');
        $result=collect($roles)->put('choseRole','请选择角色')->all();
        return $result;
    }


    /**
     * ajax上传文件
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar()
    {
        //构建存储的文件夹规则，值如：uploads/images/avatars/20170921/
        $targetFolder = 'uploads/images/avatars/' . date("Ymd", time()) . '/';
        if (!empty($_FILES)) {
            $tempFile = $_FILES['imgUrl']['tmp_name'];
            //构建文件路径
            $targetPath = public_path() . '/' . $targetFolder;
            //可以上传的文件类型
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png');
            $fileParts = pathinfo($_FILES['imgUrl']['name']);
            //重新命名文件名
            $targetFile = time() . '_' . str_random(10) . '.' . $fileParts['extension'];
            if (in_array($fileParts['extension'], $fileTypes)) {
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
                $result = move_uploaded_file($tempFile, $targetPath . $targetFile);
                if ($result) {
                    return response()->json([
                        'success' => 1,
                        'path' => asset($targetFolder . $targetFile),
                        'imgPath' => $targetFolder . $targetFile
                    ]);
                }
            } else {
                return response()->json([
                    'success' => 0,
                    'error' => '不支持的文件类型！'
                ]);
            }
        } else {
            return response()->json([
                'success' => 0,
                'error' => '文件不能为空！'
            ]);
        }
    }


    /**
     * 保存裁剪后图片
     * @return \Illuminate\Http\JsonResponse
     */
    public function cropAvatar()
    {
        //获取到剪裁数据
        $avatar = Input::get('path');
        $width = (int)Input::get('cropw');
        $height = (int)Input::get('croph');
        $x = (int)Input::get('cropx');
        $y = (int)Input::get('cropy');

        //用img对图像进行裁剪并保存
        $result = \Image::make($avatar)->crop($width, $height, $x, $y)->save();

        if ($result) {
            return response()->json([
                'success' => 1,
                'path' => $avatar,
                'fullPath' => asset($avatar)
            ]);
        } else {
            return response()->json([
                'success' => 0,
                'error' => '图像剪裁失败！',
            ]);
        }
    }

    /**
     * 根据id获取用户信息
     * @param $id
     * @return mixed
     */
    private function getUserById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * 搜索
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $users = User::where('name', 'like', '%' . trim($request->input('keywords')) . '%')
            ->get();
        return view('backend.user.index', compact('users'));
    }
}
