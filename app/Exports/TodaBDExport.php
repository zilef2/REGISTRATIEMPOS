<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TodaBDExport implements FromQuery, WithTitle, WithHeadings, ShouldAutoSize {

    // private $month;
    private $NombreTabla;
    private $User,$Empresa,$Videoc,$Operacion,$Tiempo;

    public function __construct(String $NombreTabla) {
        $this->NombreTabla = $NombreTabla;

        $modelInstance = resolve('App\\Models\\' . $this->NombreTabla);
        $NewTemporal = new $modelInstance;
        $this->{$NombreTabla} = $NewTemporal->getFillable();
        if(isset($this->User)){
            unset($this->{$NombreTabla}['password']);
            unset($this->{$NombreTabla}[2]);
        }
    }

    public function headings(): array {
        $nom = $this->NombreTabla;
        //name	fecha_nacimiento

        return $this->{$nom};
    }

    /**
     * @return Builder
     */
    public function query() {
        // if($this->NombreTabla == 'User') return User::all();
        $modelInstance = resolve('App\\Models\\' . $this->NombreTabla);
        $Result = $modelInstance::Query()
            ->select($this->{$this->NombreTabla})
            ->where('id','>',0);
        // dd($Result->get());
        return $Result;
    }

    /**
     * @return string
     */
    public function title(): string {
        return $this->NombreTabla;

    }
}
