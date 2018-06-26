<?php

namespace App\Http\Controllers\Frontend;

use App\Handlers\IpAddressHandler;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

class UserController extends Controller
{
    /**
     * 跳转到github
     * @return mixed
     */
    public function redirectToGithubProvider()
    {
        return Socialite::driver('github')->redirect();
    }


    public function handleGithubProviderCallback()
    {
		
        //获取用户信息
        $user = Socialite::driver('github')->user();
        if ($user) {
            $data = [
                'openid' => $user->id,
                'name' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'platform' => strtolower($user->provider),
                'city'=>IpAddressHandler::getAddress(request()->ip()),
                'visitor' => request()->ip()
            ];
            $member = Member::firstOrCreate(['openid' => $user->id], $data);
            auth()->guard('member')->login($member);
            return redirect()->route('frontend');
        }
    }


    public function redirectToQqbProvider()
    {
        return Socialite::driver('qq')->redirect();
    }


    public function handleQqProviderCallback()
    {

        //获取用户信息
        $user = Socialite::driver('qq')->user();
        if ($user) {
            $data = [
                'openid' => $user->id,
                'name' => $user->nickname,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'city'=>IpAddressHandler::getAddress(request()->ip()),
                'visitor' => request()->ip()
            ];
            $member = Member::firstOrCreate(['openid' => $user->id], $data);
            auth()->guard('member')->login($member);
            return redirect()->route('frontend');
        }
    }
	
	public function layout()
    {
        auth()->guard('member')->logout();
        return redirect()->route('frontend');
    }
}
