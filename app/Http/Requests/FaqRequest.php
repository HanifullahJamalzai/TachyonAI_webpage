<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{

    public function store(){
        return [
            'question' => 'required|max:400',
            'answer' => 'required',
        ];
    }
    public function update(){
        return [
            'question' => 'required|max:400',
            'answer' => 'required',
        ];
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
        return match($this->method()){
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            default => $this->view()
        };
    }
}
