<?php

namespace App\Http\Requests;

use App\Services\Post\PostService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    protected  PostService $postService;

    public function __construct()
    {
        $this->postService = App::make(PostService::class);
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
            'content' => 'required',
            'slug' => 'required|unique:posts,slug',
//            'mobile'=>new MobileRule
        ];
        if (in_array($this->method(), ['PUT', 'POST']) && $this->route()->parameter('post')) {
            $rules['slug'] = [
                'required',
                Rule::unique('posts')->ignore($this->route()->parameter('post')->id),
            ];
        }
        return $rules;
    }
}
