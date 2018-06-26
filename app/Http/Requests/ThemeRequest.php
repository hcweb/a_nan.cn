<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ThemeRequest extends FormRequest
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
        if (!is_null($this->getThemePath())) {
            return [
                'title' => 'required|between:2,12',
                'theme' => ['required', Rule::in(['blog', 'shop'])],
            ];
        } else {
            return [
                'title' => 'required|between:2,12',
                'theme' => 'required',
            ];
        }

    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空!',
            'theme.in' => '请选择模板主题!',
            'theme.required' => '请选择模板主题,如果没有请先创建!',
            'title.between' => '标题长度在2~12个字符之间!'
        ];
    }

    private function getThemePath()
    {
        $path = resource_path() . '/views/themes';
        if (is_dir($path)) {
            $folders = array_diff(scandir($path), array('.', '..'));
            if (count($folders) > 0) {
                return $folders;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
