<?php

namespace App\Exports;

use App\Exports\TodaBDExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleExport implements WithMultipleSheets,ShouldAutoSize
{
    use Exportable;

    protected $year;

    public function __construct()
    {
//        $this->year = $year;
    }


    public function sheets(): array
    {

        $nombresModelos = $this->listarModelos();
        foreach ($nombresModelos as $sheet) {
            $sheets[] = new TodaBDExport($sheet);
        }
        return $sheets;
    }

    protected function listarModelos()
    {
        $directorioModelos = app_path('Models'); // Ruta al directorio de modelos

        // Obtener todos los archivos en el directorio de modelos
        $archivos = File::files($directorioModelos);

        $ListaNegra = [
            "GuardarGoogleSheetsComercial",
            "Parametro",
            "Permission",
            "Pieza",
            "Role",
            "Ordentrabajo"
        ];

        // Filtrar los nombres de clase que sean modelos
        $nombresModelos = collect($archivos)
            ->map(function ($archivo) use ($ListaNegra) {

                $nombre = pathinfo($archivo, PATHINFO_FILENAME);
                if(!in_array($nombre,$ListaNegra)) return $nombre;
            })->filter();
//            ->filter(function ($clase) {
//                return class_exists($clase) && is_subclass_of($clase, 'Illuminate\Database\Eloquent\Model');
//            });

        return $nombresModelos;
    }
}
