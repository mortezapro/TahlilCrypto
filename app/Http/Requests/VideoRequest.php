<?php

namespace App\Http\Requests;

use App\Services\Video\VideoService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class VideoRequest extends FormRequest
{

    protected  VideoService $videoService;

    public function __construct()
    {
        $this->videoService = App::make(VideoService::class);
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
            'slug' => 'required|unique:videos,slug',
//            'mobile'=>new MobileRule
        ];
        if (in_array($this->method(), ['PUT', 'POST']) && $this->route()->parameter('video')) {
            $rules['slug'] = [
                'required',
                Rule::unique('videos')->ignore($this->route()->parameter('video')->id),
            ];
        }
        return $rules;
    }
}
