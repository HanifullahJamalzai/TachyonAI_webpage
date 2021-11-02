<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function store()
    {
        return [
            'full_name' => 'required|max:50',
            'position' => 'required|max:50',
            'bio' => 'required|max:256',
            'photo' => 'required|max:100',
        ];
    }

    public function update()
    {
        return [
            'full_name' => 'required|max:50',
            'position' => 'required|max:50',
            'bio' => 'required|max:256',
        ];
    }

    public function destroy()
    {
        return [
            'id' => 'required|integer|exists:users,id'
        ];
    }

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
