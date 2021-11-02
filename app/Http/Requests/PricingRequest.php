<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PricingRequest extends FormRequest
{
    public function store()
    {
        return [
            'title' => 'required|max:100',
            'price' => 'required',
            'duration' => 'required|max:100',
            'description'=> 'required'
        ];
    }
    public function update()
    {
        return [
            'title'       => 'required|max:100',
            'price'       => 'required',
            'duration'    => 'required',
            'description' => 'required'
        ];

    }
    public function destroy(){
        return [
            'slug' =>'required|slug'
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
            'POST' =>$this->store(),
            'PUT', 'PATCH' =>$this->update(),
            default => $this->view()
        };
            
        
    }
}
