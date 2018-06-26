<?php

namespace App\Http\Requests;

use App\Models\System;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SystemRequest extends FormRequest
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
        $id = trim($this->request->get('system_id'));
        if ($id) {
            $rules = [
                'name' => ['required','alpha', Rule::unique('systems')->ignore($id)],
                'title' => ['required', Rule::unique('systems')->ignore($id)],
                'order' => 'integer',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:systems|alpha',
                'title' => 'required|unique:systems',
                'order' => 'integer',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空！',
            'name.unique' => '名称已经存在！',
            'name.alpha' => '名称只能为字母！',
            'title.required' => '标题不能为空！',
            'title.unique' => '标题已经存在！',
            'order.integer' => '排序只能为正整数！'
        ];
    }
}
