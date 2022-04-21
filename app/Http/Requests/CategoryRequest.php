<?php

namespace App\Http\Requests;

use App\Services\Category\CategoryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    protected  CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = App::make(CategoryService::class);
    }
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
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:category,slug',
        ];
        if (in_array($this->method(), ['PUT', 'POST']) && $this->route()->parameter('category')) {
            $rules['slug'] = [
                'required',
                Rule::unique('category')->ignore($this->route()->parameter('category')->id),
            ];
        }
        return $rules;
    }
}
