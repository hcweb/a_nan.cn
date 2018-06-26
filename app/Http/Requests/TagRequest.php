<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
        $id = trim($this->request->get('id'));
        if ($id) {
            $rules = [
                'name' => ['required', Rule::unique('tags')->ignore($id)],
            ];
        } else {
            $rules = [
                'name' => 'required|unique:tags',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '标签名称不能为空！',
            'name.unique' => '标签名称已经存在！'
        ];
    }
}
