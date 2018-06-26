<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $id = trim($this->request->get('cate_id'));
        if ($id) {
            $rules = [
                'title' => ['required', Rule::unique('categorys')->ignore($id)],
                'alias' => ['required', Rule::unique('categorys')->ignore($id)],
                'route' => 'required',
                'parent_id' => 'required',
                'order' => 'numeric',
            ];
        } else {
            $rules = [
                'title' => 'required|unique:categorys',
                'alias' => 'required|unique:categorys',
                'route' => 'required',
                'parent_id' => 'required',
                'order' => 'numeric',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.unique' => '标题名称已经存在',
            'title.between' => '标题长度在3~30之间',
            'route.required' => '路由名称不能为空',
            'parent_id.required' => '父类不能为空',
            'order.numeric' => '排序必须为数字',
            'alias.required' => '调用名称不能为空',
            'alias.unique' => '调用名称已经存在',
        ];
    }
}
