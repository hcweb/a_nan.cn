<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleRequest extends FormRequest
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
        $id = trim($this->request->get('role_id'));
        if ($id) {
            $rules = [
                'name' => ['required', Rule::unique('roles')->ignore($id)],
                'alias' => ['required', Rule::unique('roles')->ignore($id)],
            ];
        } else {
            $rules = [
                'name' => 'required|unique:roles',
                'alias' => 'required|unique:roles',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '角色名称不能为空！',
            'name.unique' => '角色名称已经存在！',
            'alias.required' => '角色别名不能为空！',
            'alias.unique' => '角色名称已经存在！',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if (empty($this->input('permissions'))){
            $validator->errors()->add('permission','权限不能为空！');
        }
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
