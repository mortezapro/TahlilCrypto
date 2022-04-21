<?php

namespace App\Http\Requests;

use App\Services\Event\EventService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{

    protected  EventService $eventService;

    public function __construct()
    {
        $this->eventService = App::make(EventService::class);
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
            'slug' => 'required|unique:events,slug',
//            'mobile'=>new MobileRule
        ];
        if (in_array($this->method(), ['PUT', 'POST']) && $this->route()->parameter('event')) {
            $rules['slug'] = [
                'required',
                Rule::unique('events')->ignore($this->route()->parameter('event')->id),
            ];
        }
        return $rules;
    }
}
