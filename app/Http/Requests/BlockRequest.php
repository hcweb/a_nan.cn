<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockRequest extends FormRequest
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
        switch ($this->request->get('type')) {
            case 'E':
                $rule = [
                    'title' => 'required|between:3,100',
                    'body.E' => 'required',
                ];
                break;
            case 'I':
                $rule = [
                    'title' => 'required|between:3,100',
                    'body.I' => 'required',
                ];
                break;
            case 'F':
                $rule = [
                    'title' => 'required|between:3,100',
                    'body.F' => 'required',
                ];
                break;
        }
        return $rule;
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空!',
            'body.E.required' => '内容不能为空!',
            'body.I.required' => '内容不能为空!',
            'body.F.required' => '内容不能为空!',
            'title.between' => '标题长度在3~100之间!'
        ];
    }
}
