<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
        $id = trim($this->request->get('permission_id'));
        if ($id) {
            $rules = [
                'name' => ['required', Rule::unique('permissions')->ignore($id)],
                'alias' => ['required', Rule::unique('permissions')->ignore($id)],
            ];
        } else {
            $rules = [
                'name' => 'required|unique:permissions',
                'alias' => 'required|unique:permissions',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '名称不能为空！',
            'name.unique' => '名称已经存在！',
            'alias.required' => '别名不能为空！',
            'alias.unique' => '名称已经存在！',
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
