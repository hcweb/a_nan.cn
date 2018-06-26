<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' => 'required|between:3,30',
            'route' => 'required',
            'parent_id' => 'required',
            'order' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.between' => '标题长度在3~30之间',
            'route.required' => '路由名称不能为空',
            'parent_id.required' => '父类不能为空',
            'order.numeric' => '排序必须为数字'
        ];
    }
}
