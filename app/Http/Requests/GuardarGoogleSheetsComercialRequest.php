<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarGoogleSheetsComercialRequest extends FormRequest
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
        return
        [
			'Nombre tablero' => 'required',
			'OT+Item' => 'required',
			'avance' => 'required',
			'Tiempo estimado Ing. mecanica' => 'required',
			'Tiempo estimado Ing. electrica' => 'required',
			'Tiempo estimado corte' => 'required',
			'Tiempo estimado doblez' => 'required',
			'Tiempo estimado soldadura' => 'required',
			'Tiempo estimado pulida' => 'required',
			'Tiempo estimado ensamble' => 'required',
			'Tiempo estimado cableado' => 'required',
			'Tiempo estimado cobre' => 'required',
        ];
    }
}
