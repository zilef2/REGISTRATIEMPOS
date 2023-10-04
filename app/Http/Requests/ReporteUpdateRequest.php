<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReporteUpdateRequest extends FormRequest {
    public function authorize() { return true; }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        // $reporteId = $this->route('reporte') ?? null;
        return [
			// 'nombre' => 'required',
            // 'codigo' => 'nullable|unique:reportes,codigo,'.$reporteId,
            'codigo' => 'nullable',
            'fecha' => 'nullable',
            'hora_inicial' => 'nullable',
            'hora_final' => 'nullable',

            'actividad_id' => 'nullable',
            'centrotrabajo_id' => 'nullable',
            'material_id' => 'nullable',
            'ordentrabajo_id' => 'nullable',

            'pieza_id' => 'nullable',
            'cantidad' => 'nullable',
            
            'disponibilidad_id' => 'nullable',
            'reproceso_id' => 'nullable',
            'tipoReporte' => 'nullable',

            'nombreTablero' => 'nullable',
            'OTItem' => 'nullable',
            'TiempoEstimado' => 'nullable',
        ];
    }
}
