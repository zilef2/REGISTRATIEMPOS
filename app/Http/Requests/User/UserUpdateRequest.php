<?php

namespace App\Http\Requests\User;

use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('user');
        return [
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:' . User::class,
            // 'identificacion' => 'required|Integer|unique:' . User::class, 
            Rule::unique('users','identificacion')->ignore($id),
            Rule::unique('users','email')->ignore($id),

            'email' => 'required|string|max:255',
            'identificacion' => 'required|Integer',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
        ];
    }
}
