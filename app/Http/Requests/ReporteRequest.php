<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReporteRequest extends FormRequest
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
        $reporteId = $this->route('reporte') ?? null;
        return
        [
			// 'nombre' => 'required',
            // 'codigo' => 'required|unique:reportes,codigo,'.$reporteId,
            'fecha' => 'required',
            'hora_inicial' => 'required',
            'hora_final' => 'nullable',
            'centrotrabajo_id' => 'required',
            'ordentrabajo_id' => 'nullable',
            
            // 'material_id' => 'required',
            // 'pieza_id' => 'nullable',
            // 'cantidad' => 'nullable',
            
            'actividad_id' => 'nullable',
            'disponibilidad_id' => 'nullable',
            'reproceso_id' => 'nullable',
            'user_id' => 'nullable',
            'tipoReporte' => 'required',
        ];
    }
}
