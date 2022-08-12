<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            // 'statusPost' => 'required',
        ];
    }
    public function messages()
    {
        return [
        'name.required' => 'Tên danh mục không thể để trống!',
        // 'statusPost.required' => 'Trạng thái không thể để trống!',
        ];
    }
}