<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $id = trim($this->request->get('post_id'));
        if ($id) {
            $rules = [
                'title' => ['required', Rule::unique('categorys')->ignore($id)],
                'alias' => ['required', Rule::unique('categorys')->ignore($id)],
                'category_id' => 'required',
                'order' => 'numeric',
                'views' => 'numeric',
            ];
        } else {
            $rules = [
                'title' => 'required|unique:categorys',
                'alias' => 'required|unique:categorys',
                'category_id' => 'required',
                'order' => 'numeric',
                'views' => 'numeric',
            ];
        }
        if ($this->request->get('category_id') != 0){
            $rules=array_except($rules,'category_id');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.unique' => '标题名称已经存在',
            'title.between' => '标题长度在3~30之间',
            'category_id.required' => '分类不能为空',
            'order.numeric' => '排序必须为数字',
            'views.numeric' => '浏览次数必须为数字',
            'alias.required' => '调用名称不能为空',
            'alias.unique' => '调用名称已经存在',
        ];
    }
}
