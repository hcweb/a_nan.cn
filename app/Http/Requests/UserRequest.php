<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = trim($this->request->get('user_id'));
        if ($id) {
            $rules = [
                'name' => 'required|between:3,12',
                'tel' => 'required|regex:/^1[34578][0-9]{9}$/',
                'password' => 'required|between:6,18|confirmed',
                'email'=>['required', Rule::unique('users')->ignore($id)]
            ];
        } else {
            $rules = [
                'name' => 'required|between:3,12',
                'tel' => 'required|regex:/^1[34578][0-9]{9}$/',
                'password' => 'required|between:6,18|confirmed',
                'email'=>'required|email|unique:users'
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空！',
            'name.between' => '用户名大小在3到12个字符之间！',
            'tel.required' => '手机号不能为空！',
            'tel.regex' => '手机号不正确！',
            'email.required' => '邮箱不能为空！',
            'email.email' => '邮箱格式不正确！',
            'email.unique' => '邮箱已被使用,请换个邮箱试试！',
            'password.required' => '密码不能为空！',
            'password.between' => '密码长度在6到18个字符之间！',
            'password.confirmed' => '两次密码不一致！',
        ];
    }

//    protected function failedValidation(Validator $validator)
//    {
//        $data = [
//            'success' => false,
//            'message' => '参数没有通过验证',
//            'errors' => $validator->getMessageBag()->toArray()
//        ];
//        exit(
//        json_encode($data)
//        );
//    }
}
