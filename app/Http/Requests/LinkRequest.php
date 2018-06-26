<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
        return [
            'title' => 'required',
            'url' => 'required|url',
            'user_phone' => 'regex:/^1[34578][0-9]{9}$/',
            'user_email' => 'email',
            'order' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空!',
            'url.required' => '链接地址不能为空!',
            'url.url' => '链接地址不正确!',
            'user_phone.regex' => '手机号码不正确!',
            'user_email.email' => '邮箱格式不正确!',
            'order.integer' => '排序只能书整数!',
        ];
    }
}
